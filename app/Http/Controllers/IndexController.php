<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Rules\Recaptcha;
use App\Models\PartnersCategory;
use App\Models\ServiceCategory;
use App\Models\GalleryCategory;
use App\Models\JobApplication;
use App\Models\Opportunities;
use App\Models\Career;
use App\Models\News;
use App\Models\SiteSetting;
use App\Models\LinkedinPost;
use App\Models\Aboutpage;
use App\Models\Industry;
use App\Models\Category;
use App\Models\Services;
use App\Models\Whykpca;
use App\Models\Gallery;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\DesignUpload;
use App\Models\Banner;
use App\Models\Spread;
use App\Models\Vision;
use App\Models\Blogs;
use App\Models\Stats;
use App\Models\About;
use App\Models\Story;
use App\Models\Core;
use App\Models\Achievement;
use App\Support\EnquiryMailer;
use Mail;
use Log;
use DB;
use Illuminate\Support\Facades\Schema;

class IndexController extends Controller
{
    public function index(){
        $achievements = $this->resolveHomepageAchievements();
        // $banners = Banner::where('status',1)->get();
        // $blogs = Blogs::orderBy('id','DESC')->where('status',1)->get()->take(4);
        // $stats = Stats::get();
        // $whykpca = Whykpca::get();
        // $about = About::first();
        // $services = ServiceCategory::with('services')->where('status',1)->get();
        // $reports = Industry::orderBy('report_date','DESC')->take(4)->get();
        // $summerProducts = Services::where('season', 'LIKE', '%summer%')->get();
        // $rabiProducts = Services::where('season', 'LIKE', '%rabi%')->get();
        // $kharifProducts = Services::where('season', 'LIKE', '%kharif%')->get();
        $meta_title = 'AutoDynamics | Automotive Lightweighting, Certifications & IPR';
        $meta_keywords = 'AutoDynamics, IATF 16949, automotive certifications, design registration, patents, IPR, supplier awards, lightweight manufacturing, Pune';
        $meta_description = 'AutoDynamics — IATF-certified automotive lightweighting partner. Explore our awards, quality certifications, patents, and registered designs including Battery Hold Down Tray (Design No. 492630-001).';
        return view('index', compact('meta_title', 'meta_keywords', 'meta_description', 'achievements'));
    }

    private function resolveHomepageAchievements(): array
    {
        if (Schema::hasTable('achievements')) {
            $items = Achievement::publishedForHomepage();
            if (!empty($items)) {
                return $items;
            }
        }

        return Achievement::fallbackDisplayItems();
    }

    public function contact(Request $request){
        if ($request->isMethod('post')) {

            $validatedData = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'phone'   => 'nullable|string|max:40',
                'company' => 'nullable|string|max:255',
                'subject' => 'required|string|max:255',
                'comment' => 'required|string',
                'g-recaptcha-response' => 'required',
            ], [
                'name.required'    => 'Name is required.',
                'email.required'   => 'Email is required.',
                'email.email'      => 'Please enter a valid email address.',
                'phone.required' => 'Phone Number is required.',
                'company.required' => 'Company is required.',
                'subject.required' => 'Subject is required.',
                'comment.required' => 'Message is required.',
                'g-recaptcha-response.required' => 'Captcha verification is required.',
            ]);

            $recaptchaSecret = config('app.google_recaptcha_secret') ?: '6Lc-G5orAAAAABINJ6u9YJTt3_Ctklg8hztTGKj_';
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $recaptchaSecret, 
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $recaptchaData = $response->json();

            if (!isset($recaptchaData['success']) || $recaptchaData['success'] != true) {
                return redirect()->back()
                    ->withErrors(['captcha' => 'reCAPTCHA verification failed. Please try again.'])
                    ->withInput();
            }

            $phone = trim((string) ($validatedData['phone'] ?? ''));
            if ($phone === '') {
                $phone = '—';
            }

            $commentBody = $validatedData['comment'];
            $company = trim((string) ($validatedData['company'] ?? ''));
            if ($company !== '') {
                $commentBody = $commentBody;
            }

            $now = now();

            DB::table('enquiry')->insert([
                'name'    => $validatedData['name'],
                'email'   => $validatedData['email'],
                'phone'   => $phone,
                'company'   => $company,
                'service' => $validatedData['subject'],
                'comment' => $commentBody,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $to = EnquiryMailer::adminEmail();
            $subject1 = 'Website contact: ' . str_replace(["\r", "\n"], '', $validatedData['subject']);

            EnquiryMailer::sendView('emails.contact_admin', [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $phone,
                'company' => $company,
                'subject' => $validatedData['subject'],
                'body' => $commentBody,
            ], $to, $subject1, [
                'reply_to' => $validatedData['email'],
            ]);

            EnquiryMailer::sendView('emails.contact_user', [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'company' => $company,
                'subject' => $validatedData['subject'],
                'body' => $commentBody,
                'support_email' => EnquiryMailer::adminEmail(),
            ], $validatedData['email'], 'Thank you for contacting Auto Dynamics');

            return redirect()->back()->with('success', 'Your message has been sent. We will get back to you soon.');
        }

        $meta_title = 'Contact Us | AutoDynamics';
        $meta_keywords = 'contact AutoDynamics, composite solutions, Pune, automotive lightweighting';
        return view('contact', compact('meta_title','meta_keywords'));
    }

    public function uploadDesign(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->merge([
                'part_description' => ($v = trim((string) $request->input('part_description', ''))) !== '' ? $v : null,
                'program_name'     => ($v = trim((string) $request->input('program_name', ''))) !== '' ? $v : null,
                'sop_timeline'     => ($v = trim((string) $request->input('sop_timeline', ''))) !== '' ? $v : null,
            ]);

            $validatedData = $request->validate([
                'name'               => 'required|string|max:255',
                'email'              => 'required|email|max:255',
                'company'            => 'required|string|max:255',
                'looking_for'        => 'required|string|max:255',
                'preferred_material' => 'required|string|max:255',
                'annual_volume'      => 'required|string|max:255',
                'part_description'   => 'nullable|max:2000',
                'program_name'       => 'nullable|max:255',
                'sop_timeline'       => 'nullable|max:255',
                'design_files'       => 'required|array|min:1|max:5',
                'design_files.*'     => 'file|max:51200',
                'g-recaptcha-response' => 'required',
            ], [
                'name.required'               => 'Full name is required.',
                'email.required'              => 'Work email is required.',
                'email.email'                 => 'Please enter a valid email address.',
                'company.required'            => 'Company name is required.',
                'looking_for.required'        => 'Please select what you are looking for.',
                'preferred_material.required' => 'Preferred material is required.',
                'annual_volume.required'      => 'Annual volume is required.',
                'design_files.required'       => 'Please upload at least one design file.',
                'design_files.min'            => 'Please upload at least one design file.',
                'design_files.*.max'          => 'Each file must be 50MB or smaller.',
                'g-recaptcha-response.required' => 'Captcha verification is required.',
            ]);

            $recaptchaSecret = config('app.google_recaptcha_secret') ?: '6Lc-G5orAAAAABINJ6u9YJTt3_Ctklg8hztTGKj_';
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => $recaptchaSecret,
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            $recaptchaData = $response->json();
            if (!isset($recaptchaData['success']) || $recaptchaData['success'] != true) {
                return redirect()->back()
                    ->withErrors(['captcha' => 'reCAPTCHA verification failed. Please try again.'])
                    ->withInput();
            }

            $allowedExt = ['step', 'stp', 'iges', 'igs', 'pdf', 'dwg', 'dxf'];
            $uploadedFiles = [];

            if ($request->hasFile('design_files')) {
                $uploadDir = public_path('uploads/design-enquiries');
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                foreach ($request->file('design_files') as $file) {
                    if (!$file->isValid()) {
                        continue;
                    }
                    $ext = strtolower($file->getClientOriginalExtension());
                    if (!in_array($ext, $allowedExt, true)) {
                        return redirect()->back()
                            ->withErrors(['design_files' => 'Invalid file type. Allowed: STEP, STP, IGS, PDF, DWG, DXF.'])
                            ->withInput();
                    }

                    $original = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                    $safeName = time() . '_' . Str::random(8) . '_' . $original;
                    $file->move($uploadDir, $safeName);
                    $uploadedFiles[] = [
                        'path' => 'uploads/design-enquiries/' . $safeName,
                        'name' => $file->getClientOriginalName(),
                    ];
                }
            }

            $fileLinks = [];
            foreach ($uploadedFiles as $file) {
                $fileLinks[] = [
                    'url' => url($file['path']),
                    'name' => $file['name'],
                ];
            }

            DesignUpload::create([
                'name'               => $validatedData['name'],
                'email'              => $validatedData['email'],
                'company'            => $validatedData['company'],
                'looking_for'        => $validatedData['looking_for'],
                'preferred_material' => $validatedData['preferred_material'],
                'annual_volume'      => $validatedData['annual_volume'],
                'part_description'   => $validatedData['part_description'] ?? null,
                'program_name'       => $validatedData['program_name'] ?? null,
                'sop_timeline'       => $validatedData['sop_timeline'] ?? null,
                'files'              => $uploadedFiles,
                'ip_address'         => $request->ip(),
                'status'             => 'pending',
            ]);

            $adminTo = EnquiryMailer::adminEmail();
            $adminSubject = 'New design upload request — ' . str_replace(["\r", "\n"], '', $validatedData['company']);

            EnquiryMailer::sendView('emails.design_upload_admin', [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'company' => $validatedData['company'],
                'looking_for' => $validatedData['looking_for'],
                'preferred_material' => $validatedData['preferred_material'],
                'annual_volume' => $validatedData['annual_volume'],
                'part_description' => $validatedData['part_description'] ?? null,
                'program_name' => $validatedData['program_name'] ?? null,
                'sop_timeline' => $validatedData['sop_timeline'] ?? null,
                'files' => $fileLinks,
            ], $adminTo, $adminSubject, [
                'reply_to' => $validatedData['email'],
            ]);

            $userSubject = 'We received your design upload — Auto Dynamics';
            EnquiryMailer::sendView('emails.design_upload_user', [
                'name' => $validatedData['name'],
                'company' => $validatedData['company'],
                'looking_for' => $validatedData['looking_for'],
                'preferred_material' => $validatedData['preferred_material'],
                'annual_volume' => $validatedData['annual_volume'],
                'support_email' => EnquiryMailer::adminEmail(),
            ], $validatedData['email'], $userSubject);

            return redirect()->back()->with('success', 'Your design request has been submitted. We will get back to you within 7 days.');
        }

        $meta_title = 'Upload Your Design | AutoDynamics';
        $meta_keywords = 'upload CAD design, engineering quote, AutoDynamics, automotive manufacturing';
        return view('upload_design', compact('meta_title', 'meta_keywords'));
    }

    public function distributor(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            Log::info($data);

            $gstFile = null;
            if ($request->hasFile('gst')) {
                $file = $request->file('gst');
                $gstFile = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('assets/distributor/');
                $file->move($destinationPath, $gstFile);
            }

            $panFile = null;
            if ($request->hasFile('pan')) {
                $file = $request->file('pan');
                $panFile = time() . '-' . $file->getClientOriginalName();
                $destinationPath = public_path('assets/distributor/');
                $file->move($destinationPath, $panFile);
            }

            DB::table('distributor')->insert([
                'name' => $data['name'],
                'farm' => $data['farm'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'business_type' => $data['business_type'],
                'GST' => $gstFile,
                'PAN Card' => $panFile,
            ]);

            // Admin Email ID (Change this to the admin's email)
            $adminEmail = "sankalp@ycstech.in";  

            // Email Subject
            $subject = "New Distributor Enquiry from {$data['name']}";

            // Email Content
            $emailData = [
                'name' => $data['name'],
                'farm' => $data['farm'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'pincode' => $data['pincode'],
                'business_type' => $data['business_type'],
                'gstFile' => $gstFile ? asset('assets/distributor/' . $gstFile) : null,
                'panFile' => $panFile ? asset('assets/distributor/' . $panFile) : null,
            ];

            // Send Email Using Laravel Mail
            Mail::send('emails.distributor_enquiry', $emailData, function ($message) use ($adminEmail, $subject) {
                $message->to($adminEmail)->subject($subject);
            });

            // WhatsApp Message Content
            $whatsappMessage = "📌 *New Distributor Enquiry*\n\n";
            $whatsappMessage .= "👤 *Name:* {$data['name']}\n";
            $whatsappMessage .= "🏢 *Firm:* {$data['farm']}\n";
            $whatsappMessage .= "📧 *Email:* {$data['email']}\n";
            $whatsappMessage .= "📞 *Phone:* {$data['phone']}\n";
            $whatsappMessage .= "📍 *Address:* {$data['address']}\n";
            $whatsappMessage .= "📮 *Pincode:* {$data['pincode']}\n";
            $whatsappMessage .= "🏭 *Business Type:* {$data['business_type']}\n";

            if ($gstFile) {
                $whatsappMessage .= "📝 *GST File:* " . asset('assets/distributor/' . $gstFile) . "\n";
            }
            if ($panFile) {
                $whatsappMessage .= "📝 *PAN File:* " . asset('assets/distributor/' . $panFile) . "\n";
            }

            // Send WhatsApp Message
            $this->sendWhatsAppMessage("+919404371723", $whatsappMessage);

            return redirect()->back()->with('success_message', 'Form submitted successfully.');
        }

        $meta_title = 'Distributor | ' . config('app.name');
        return view('distributor', compact('meta_title'));
    }

    private function sendWhatsAppMessage($phoneNumber, $message) {
        $apiKey = "your-api-key-here"; 
        $encodedMessage = urlencode($message);

        $url = "https://api.callmebot.com/whatsapp.php?phone=$phoneNumber&text=$encodedMessage&apikey=$apiKey";

        $response = file_get_contents($url);

        Log::info("WhatsApp Message Sent: " . $response);
    }

    public function about(Request $request){
        $meta_title = 'About Us | '. config('app.name');
        return view('about',compact('meta_title'));
    }

    public function capabilities(Request $request){
        $meta_title = 'Capabilities | '. config('app.name');
        return view('capabilities',compact('meta_title'));
    }

    public function capdetails(Request $request){
        $meta_title = 'Automotive | '. config('app.name');
        $jsonPath = public_path('assets/data/automotive-showcase.json');
        $showcaseData = file_exists($jsonPath)
            ? json_decode(file_get_contents($jsonPath), true)
            : ['hero' => [], 'categories' => [], 'steps' => []];
        if (!empty($showcaseData['steps'])) {
            foreach ($showcaseData['steps'] as &$step) {
                if (!empty($step['productImage'])) {
                    $step['productImageUrl'] = asset($step['productImage']);
                }
            }
            unset($step);
        }
        if (!empty($showcaseData['vehicleImages'])) {
            foreach ($showcaseData['vehicleImages'] as $key => $path) {
                $showcaseData['vehicleImages'][$key] = asset($path);
            }
        }
        return view('capabilities_details', compact('meta_title', 'showcaseData'));
    }

    public function industrialProducts(Request $request)
    {
        $meta_title = 'Industrial | ' . config('app.name');
        $jsonPath = public_path('assets/data/industrial-showcase.json');
        $showcaseData = file_exists($jsonPath)
            ? json_decode(file_get_contents($jsonPath), true)
            : ['hero' => [], 'categories' => [], 'steps' => []];
        if (!empty($showcaseData['steps'])) {
            foreach ($showcaseData['steps'] as &$step) {
                if (!empty($step['productImage'])) {
                    $step['productImageUrl'] = asset($step['productImage']);
                }
            }
            unset($step);
        }
        if (!empty($showcaseData['vehicleImages'])) {
            foreach ($showcaseData['vehicleImages'] as $key => $path) {
                $showcaseData['vehicleImages'][$key] = asset($path);
            }
        }
        return view('industrial_products', compact('meta_title', 'showcaseData'));
    }

    public function automotiveExperience(Request $request)
    {
        $meta_title = 'Automotive Experience | ' . config('app.name');
        return view('automotive_experience', compact('meta_title'));
    }

    public function lightweightTechnologyByImc(Request $request){
        $meta_title = 'Lightweight Technology by IMC | ' . config('app.name');
        return view('technology.lightweight_technology_by_imc', compact('meta_title'));
    }

    public function limTechnology(Request $request){
        $meta_title = 'LIM Technology | ' . config('app.name');
        return view('technology.lim_technology', compact('meta_title'));
    }

    public function imOfTechnicalComponent(Request $request){
        $meta_title = 'IM of Technical Component | ' . config('app.name');
        return view('technology.im_of_technical_component', compact('meta_title'));
    }

    public function privacypolicy(Request $request){
        $meta_title = 'Privacy Policy | '. config('app.name');
        return view('privacy_policy',compact('meta_title'));
    }

    public function productsPage(Request $request){
        // $partners = PartnersCategory::with(['partners' => function ($query) {
        //     $query->where('status', 1);
        // }])->where('status',1)->get();
        $meta_title = 'Products | '. config('app.name');
        return view('products',compact('meta_title'));
    }

    public function showSubcategories($id){
        $mainCategory = Category::findOrFail($id);
        $subCategories = Category::where('parent_id', $id)->get();
        return view('subcategory-listing', compact('mainCategory', 'subCategories'));
    }

    public function subcategoryListing($subcategory_id){
        $subcategory = \App\Models\Category::find($subcategory_id);

        // Check if the subcategory exists
        if ($subcategory) {
            // Fetch products for the subcategory
            $products = \App\Models\Services::where('category_id', $subcategory_id)->get();
        } else {
            // Fetch products for the main category if no subcategory exists
            $products = \App\Models\Services::where('category_id', $mainCategory_id)->get();
        }
        
        $subCategoriesLevel1 = Category::where('parent_id', $subcategory_id)->where('level', 1)->get();

        $meta_title = 'Product Listing | ' . config('app.name');

        return view('product_listing', compact('subcategory', 'products','meta_title','subCategoriesLevel1'));
    }

    public function productDetails($id, $title=null){
        $Product = Services::select('services.*','category.id as category_id','category.title')
            ->join('category','services.category_id','category.id')
            ->where('services.id',$id)
            ->first();
        //dd($detail);
        return view('product_detail')->with(compact('Product'));
    }

    public function gallery(Request $request, $id=null){
        $categories = collect();
        $items = collect();
        $activeCategory = (string) $request->query('category', '');

        if (Schema::hasTable('gallery')) {
            if (Schema::hasTable('gallery_category')) {
                $categories = GalleryCategory::query()
                    ->when(Schema::hasColumn('gallery_category', 'status'), function ($q) {
                        $q->where('status', 1);
                    })
                    ->orderBy('id', 'ASC')
                    ->get(['id', 'name']);
            }

            $query = Gallery::query()
                ->leftJoin('gallery_category', 'gallery_category.id', '=', 'gallery.cat_id')
                ->select(
                    'gallery.*',
                    DB::raw("COALESCE(gallery_category.name, 'Uncategorized') as category_name")
                )
                ->orderBy('gallery.id', 'DESC');

            if (Schema::hasColumn('gallery', 'status')) {
                $query->where('gallery.status', 1);
            }

            if ($activeCategory !== '') {
                if (is_numeric($activeCategory)) {
                    $query->where('gallery.cat_id', (int) $activeCategory);
                } else {
                    $normalized = strtolower(trim(preg_replace('/-+/', ' ', $activeCategory)));
                    $query->whereRaw('LOWER(gallery_category.name) like ?', ['%' . $normalized . '%']);
                }
            } elseif (!empty($id) && is_numeric($id)) {
                $query->where('gallery.cat_id', (int) $id);
                $activeCategory = (string) $id;
            }

            $items = $query->paginate(12)->appends($request->query());
        } else {
            $items = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                12,
                (int) $request->query('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        $meta_title = 'Gallery | '. config('app.name');
        $meta_keywords = 'Auto Dynamics gallery, facilities, products, labs, equipment';
        return view('gallery',compact('meta_title','meta_keywords', 'categories', 'items', 'activeCategory'));
    }

    public function blogsListing(Request $request){
        $blogs = collect();
        if (Schema::hasTable('blogs')) {
            $blogs = Blogs::where('status', 1)
                ->orderByRaw("COALESCE(`date`, created_at) DESC")
                ->paginate(9);
        } else {
            $blogs = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                9,
                (int) $request->query('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }
        $meta_title = 'Blog | '. config('app.name');
        return view('blog_listing',compact('meta_title', 'blogs'));
    }

    public function blogDetail(Request $request, $id=null, $slug=null){
        $blog = null;

        if (!Schema::hasTable('blogs')) {
            return redirect()->route('blogs');
        }

        // /media/blogs/{slug}
        if ($slug === null && $id !== null && !is_numeric($id)) {
            $slug = $id;
            $id = null;
        }

        if (!empty($id) && is_numeric($id)) {
            $blog = Blogs::find($id);
        }
        if (!$blog && !empty($slug)) {
            $slugValue = strtolower((string) $slug);
            $blog = Blogs::get()->first(function ($item) use ($slugValue) {
                return \Illuminate\Support\Str::slug((string) $item->title) === $slugValue;
            });
            if (!$blog) {
                $normalizedTitle = trim(preg_replace('/-+/', ' ', $slugValue));
                $blog = Blogs::whereRaw('LOWER(title) like ?', ['%' . $normalizedTitle . '%'])->first();
            }
        }
        if (!$blog) {
            return redirect()->route('blogs');
        }

        $meta_title = $blog->title . ' | Blog';
        return view('blog_detail',compact('meta_title','blog'));
    }

    public function newsListing(Request $request){
        $linkedinPosts = collect();

        if (Schema::hasTable('news')) {
            $news = News::where('status', 1)->orderByRaw("COALESCE(`date`, created_at) DESC")->paginate(9);
        } else {
            $news = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                9,
                (int) $request->query('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
        }

        if (Schema::hasTable('linkedin_posts')) {
            $linkedinPosts = LinkedinPost::orderBy('id', 'DESC')
                ->get();
        } elseif (Schema::hasTable('site_settings')) {
            $legacyEmbed = SiteSetting::where('setting_key', 'linkedin_embed_news')->value('setting_value');
            if (!empty($legacyEmbed)) {
                $linkedinPosts = collect([
                    (object) [
                        'title' => null,
                        'embed_code' => $legacyEmbed,
                    ]
                ]);
            }
        }

        $meta_title = 'News | '. config('app.name');
        return view('news_listing', compact('meta_title', 'news', 'linkedinPosts'));
    }

    public function newsDetail(Request $request, $slug){
        if (!Schema::hasTable('news')) {
            return redirect()->route('news.list');
        }

        $slugValue = strtolower((string) $slug);
        $item = News::where('status', 1)->get()->first(function ($row) use ($slugValue) {
            return \Illuminate\Support\Str::slug((string) $row->title) === $slugValue;
        });

        if (!$item) {
            $normalizedTitle = trim(preg_replace('/-+/', ' ', $slugValue));
            $item = News::where('status', 1)->whereRaw('LOWER(title) like ?', ['%' . $normalizedTitle . '%'])->first();
        }

        if (!$item) {
            return redirect()->route('news.list');
        }

        $meta_title = $item->title . ' | News';
        return view('news_detail', compact('meta_title', 'item'));
    }

    public function career(Request $request){
        $search = trim((string) $request->query('search', ''));
        $location = trim((string) $request->query('location', ''));
        $department = trim((string) $request->query('department', ''));

        if (Schema::hasTable('opportunities')) {
            $query = Opportunities::query()->where('status', 1);

            if ($search !== '') {
                $query->where(function ($q) use ($search) {
                    $q->where('designation_name', 'like', "%{$search}%")
                        ->orWhere('job_description', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('qualification', 'like', "%{$search}%");
                });
            }

            if ($location !== '') {
                $query->where('location', $location);
            }

            if ($department !== '') {
                if (Schema::hasColumn('opportunities', 'department')) {
                    $query->where('department', $department);
                } else {
                    $query->where('qualification', $department);
                }
            }

            $opportunities = $query->orderBy('id', 'DESC')->paginate(9)->appends($request->query());

            $locations = Opportunities::where('status', 1)
                ->whereNotNull('location')
                ->where('location', '!=', '')
                ->distinct()
                ->orderBy('location')
                ->pluck('location');

            if (Schema::hasColumn('opportunities', 'department')) {
                $departments = Opportunities::where('status', 1)
                    ->whereNotNull('department')
                    ->where('department', '!=', '')
                    ->distinct()
                    ->orderBy('department')
                    ->pluck('department');
            } else {
                $departments = Opportunities::where('status', 1)
                    ->whereNotNull('qualification')
                    ->where('qualification', '!=', '')
                    ->distinct()
                    ->orderBy('qualification')
                    ->pluck('qualification');
            }
        } elseif (Schema::hasTable('career')) {
            $fallback = Career::query()->select('id', 'title', 'description')->orderBy('id', 'DESC')->get();

            if ($search !== '') {
                $fallback = $fallback->filter(function ($item) use ($search) {
                    return stripos((string) $item->title, $search) !== false || stripos((string) $item->description, $search) !== false;
                })->values();
            }

            $mapped = $fallback->map(function ($item) {
                return (object) [
                    'id' => $item->id,
                    'designation_name' => $item->title,
                    'job_description' => $item->description,
                    'location' => 'Location TBA',
                    'qualification' => 'General',
                    'experience' => '',
                ];
            });

            $page = (int) $request->query('page', 1);
            $perPage = 9;
            $items = $mapped->slice(($page - 1) * $perPage, $perPage)->values();
            $opportunities = new \Illuminate\Pagination\LengthAwarePaginator(
                $items,
                $mapped->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
            $locations = collect();
            $departments = collect();
        } else {
            $opportunities = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                9,
                (int) $request->query('page', 1),
                ['path' => $request->url(), 'query' => $request->query()]
            );
            $locations = collect();
            $departments = collect();
        }

        $meta_title = 'Career at '. config('app.name');
        return view('career', compact('meta_title', 'opportunities', 'locations', 'departments', 'search', 'location', 'department'));
    }

    private function normalizeCareerFilters(array $query): array
    {
        return [
            'search' => trim((string) ($query['search'] ?? '')),
            'location' => trim((string) ($query['location'] ?? '')),
            'department' => trim((string) ($query['department'] ?? '')),
        ];
    }

    public function submitJobApp(Request $request)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'job_id' => 'nullable|integer',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:40',
                'comment' => 'required|string',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            ]);

            $job = null;
            if (!empty($validated['job_id']) && Schema::hasTable('opportunities')) {
                $job = Opportunities::find($validated['job_id']);
            }

            $resumeFile = null;
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $resumeFile = time() . '-' . preg_replace('/\s+/', '-', $file->getClientOriginalName());
                $destinationPath = public_path('assets/applications/');
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $resumeFile);
            }

            $payload = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'comment' => $validated['comment'],
                'resume' => $resumeFile,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (Schema::hasTable('job_applications') && Schema::hasColumn('job_applications', 'job_id')) {
                $payload['job_id'] = $job?->id;
            }
            if (Schema::hasTable('job_applications') && Schema::hasColumn('job_applications', 'designation')) {
                $payload['designation'] = $job?->designation_name;
            }
            if (Schema::hasTable('job_applications')) {
                DB::table('job_applications')->insert($payload);
            }

            $to = ($job && !empty($job->email)) ? $job->email : EnquiryMailer::adminEmail();
            $subject = 'New Job Application' . ($job ? ' - ' . $job->designation_name : '');

            $attachments = [];
            $resumeUrl = null;
            if ($resumeFile) {
                $resumePath = public_path('assets/applications/' . $resumeFile);
                if (is_file($resumePath)) {
                    $attachments[] = $resumePath;
                }
                $resumeUrl = asset('assets/applications/' . $resumeFile);
            }

            $jobTitle = 'General Application';
            if ($job && !empty($job->designation_name)) {
                $jobTitle = $job->designation_name;
            }

            EnquiryMailer::sendView('emails.career_application_admin', [
                'position' => $jobTitle,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'comment' => $validated['comment'],
                'resume_url' => $resumeUrl,
            ], $to, $subject, [
                'reply_to' => $validated['email'],
                'attachments' => $attachments,
            ]);

            EnquiryMailer::sendView('emails.career_application_user', [
                'position' => $jobTitle,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'support_email' => EnquiryMailer::adminEmail(),
            ], $validated['email'], 'Thank you for your application — Auto Dynamics');

            $redirectUrl = !empty($validated['job_id']) ? url('career/job/' . $validated['job_id']) : route('career');
            return redirect($redirectUrl)->with('success_message', 'Application submitted successfully.');
        }

        return redirect()->route('career');
    }

    public function jobDetails(Request $request, $id, $slug = null){
        $job = null;

        if (Schema::hasTable('opportunities')) {
            $job = Opportunities::find($id);

            if (!$job && !empty($slug)) {
                $job = Opportunities::whereRaw('LOWER(REPLACE(designation_name, \" \", \"-\")) = ?', [strtolower($slug)])->first();
            }
        }

        if (!$job && Schema::hasTable('career')) {
            $career = Career::find($id);
            if (!$career && !empty($slug)) {
                $career = Career::whereRaw('LOWER(REPLACE(title, \" \", \"-\")) = ?', [strtolower($slug)])->first();
            }

            if ($career) {
                $job = (object) [
                    'id' => $career->id,
                    'designation_name' => $career->title,
                    'job_description' => $career->description,
                    'location' => 'Location TBA',
                    'qualification' => 'General',
                    'experience' => '',
                    'employment_type' => 'Full-time',
                    'created_at' => $career->created_at,
                ];
            }
        }

        if (!$job) {
            return redirect()->route('career');
        }

        $meta_title = $job->designation_name . ' | Career';
        return view('career_detail', compact('meta_title', 'job'));
    }

    public function jobDetailsBySlug(Request $request, $slug){
        $job = null;
        if (Schema::hasTable('opportunities')) {
            $job = Opportunities::whereRaw('LOWER(REPLACE(designation_name, \" \", \"-\")) = ?', [strtolower($slug)])->first();
            if (!$job && is_numeric($slug)) {
                $job = Opportunities::find((int) $slug);
            }
        }

        if (!$job && Schema::hasTable('career')) {
            $career = Career::whereRaw('LOWER(REPLACE(title, \" \", \"-\")) = ?', [strtolower($slug)])->first();
            if (!$career && is_numeric($slug)) {
                $career = Career::find((int) $slug);
            }
            if ($career) {
                $job = (object) [
                    'id' => $career->id,
                    'designation_name' => $career->title,
                    'job_description' => $career->description,
                    'location' => 'Location TBA',
                    'qualification' => 'General',
                    'experience' => '',
                    'employment_type' => 'Full-time',
                    'created_at' => $career->created_at,
                ];
            }
        }

        if (!$job) {
            return redirect()->route('career');
        }

        $meta_title = $job->designation_name . ' | Career';
        return view('career_detail', compact('meta_title', 'job'));
    }

    public function serviceDetailPage(Request $request, $id){
        $service = Service::select('services.*','service_categories.name')
            ->leftJoin('service_categories','service_categories.id','services.service_cat_id')
            ->where('services.id',$id)
            ->first();

        $meta_title = $service->title.' | '. config('app.name');
        return view('services.service_detail',compact('meta_title','service'));
    }
    
}