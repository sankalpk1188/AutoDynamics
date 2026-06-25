<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\News;
use App\Models\Clients;
use App\Models\Event;
use App\Models\Expo;
use App\Models\SiteSetting;
use App\Models\LinkedinPost;
use Auth;
use Image;

class AdminController extends Controller
{
    public function getLogin(){
        
        return view('admin.auth.login');
    }

    public function postLogin(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();
            
            // dd($adminCount);
            if(Auth::attempt(['email' => $data['email'],'password'=>md5($data['password'])])){
                return redirect()->route('adminDashboard')->with('flash_message_error','You are Logged in sucessfully.');
            }
            else{
                return back()->with('flash_message_error','Invalid Email or Password');
            }
        }
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            $adminCount = Admin::where(['email' => $data['email'],'password'=>md5($data['password'])])->count();
            if($adminCount > 0){
                Session::put('adminSession', $data['email']);
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin-login')->with('flash_message_error','Invalid Email or Password');
            }
        }
        return view('admin.admin_login');
    }

    public function logout(){
        // auth()->guard('admin')->logout();
        Session::flush();
        return view('admin.admin_login')->with('flash_message_success','Logged Out Successfully');
    }

    public function setting(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $adminCount = Admin::where(['email' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
            if($adminCount == 1){
                $password = md5($data['new_pwd']);
                $email = $data['email'];
                $confirm_password = md5($data['confirm_pwd']);
                if($password == $confirm_password)
                {
                    Admin::where('email',Session::get('adminSession'))->update(['password'=>$password]);
                    return redirect('/admin/admin-setting')->with('flash_message_success','Password Updated Successfully!');
                }else{
                    return redirect('/admin/admin-setting')->with('flash_message_error','New password and confirm password must be same!');
                }
            }else{
                return redirect('/admin/admin-setting')->with('flash_message_error','Incorrect Current Password!');
            }
        }
        $admin = Admin::first();
        return view('admin.admin_setting')->with(compact('admin'));
    }

    public function changePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $adminCount = Admin::where(['email' => Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
            if (Hash::check($data['password'], $adminCount->password)) {
                Admin::where('email',Auth::Admin()->email)->update(['password'=>bcrypt($data['new_password'])]);
                return redirect()->back()->with('flash_message_success','Password updated successfully');
            }else{
                return redirect()->back()->with('flash_message_error','Incorrect current password');
            }
        }
        $meta_title = 'Change Password | Kirtane & Pandit';
        return view('users.changePassword')->with(compact('meta_title'));   
    }

    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user = Admin::where('email',$data['email'])->first();
            if($user && !empty($user->google_id)){
                Alert::toast('<p style="color:black">Your account is register with google </p>','warning');    
                return redirect()->back();
            }
            $user = Admin::where('email',$data['email'])->first();
            if(empty($user)){
                return redirect()->back()->with('flash_message_error','We can not find a user with that Email address.');
            }

            //generate otp
            $otp = random_int(100000, 999999);
            Session::put('resetPassOTP',$otp);

            //send forgot email password email code
            $email = $data['email'];            
            $messageData = [
                'name'=>$user->name,                
                'otp'=>$otp
            ];
            Mail::send('emails.forgotpassword_otp',$messageData,function($message) use($email){
                $message->to($email)->subject('New Password - Kirtane & Pandit.');
            });

            return redirect('reset-password')->with('flash_message_success','OTP sent on email to reset password');
        }
        return view('forgotpassword');
    }

    public function resetPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);

            $user = Admin::where('email',$data['email'])->first();
            if(empty($user)){
                return redirect()->back()->with('flash_message_error','We can not find a user with that Email address.');
            }
            
            if($data['otp'] != Session::get('resetPassOTP')){
                return redirect()->back()->with('flash_message_error','Incorrect OTP. Please enter again.');
            }else{
                //update pwd
                Admin::where('email',$data['email'])->update(['password'=>md5($data['password'])]);
                Session::forget('resetPassOTP');
            }
            return redirect('/admin-login')->with('flash_message_success','Password has been reset successfully. Please login');
            // Alert::toast('<p style="color:black">Password has been reset successfully. Please login</p>','success');
            // return redirect('loginpage');
        }
        return view('users.reset_password');
    }

    // public function resetPassword(Request $request){
    //     if($request->isMethod('post')){
    //         $data = $request->all();
    //         // dd($data);
    //         $adminCount = Admin::where('email',$data['email'])->count();
    //         if($adminCount==0){
    //             return redirect()->back()->with('flash_message_error','We can not find a user with this email address.');
    //         }

    //         $adminDetails = Admin::where('email',$data['email'])->first();
    //         $random_password = mt_rand(100000, 999999);
    //         $new_password = md5($random_password);

    //         Admin::where('email',$data['email'])->update(['password'=>$new_password]);

    //         //Password sent on mail notification

    //         $email = $data['email'];
    //         $messageData = [
    //             'email'=>$email,
    //             'password'=>$random_password
    //         ];

    //         Mail::send('passwords.reset',$messageData,function($message) use($email){
    //             $message->to($email)->subject('New Password - Kirtane & Pandit');
    //         });
    //         return redirect()->back()->with('flash_message_success','Password sent on your email, please check your Email.');
    //         }
    //     }


    // public function forgotPassword(Request $request){
    //     if($request->isMethod('post')){
    //         $data = $request->all();
           
    //         $adminCount = Admin::where('email',$data['email'])->count();
    //         if($adminCount==0){
    //             return redirect()->back()->with('flash_message_error','Please Enter Valid Email Address.');
    //         }

            
    //         $adminDetails = Admin::where('email',$data['email'])->first();
            
    //         $random_password = Str::random(8);
    //         $new_password = md5($random_password);

            
    //         Admin::where('email',$data['email'])->update(['password'=>$new_password]);

            
    //         $email = $data['email'];
            
    //         $messageData = [
    //             'email'=>$email,
    //             'password'=>$random_password
    //         ];
    //         Mail::send('emails.forgotpassword',$messageData,function($message) use($email){
    //             $message->to($email)->subject('New Password - Kirtane & Pandit');
    //         });

    //         return redirect()->back()->with('flash_message_success','Password sent on your email, kindly check your Email.');
    //     }
    //     return view('users.forgot_password');
    // }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $current_password = $data['current_pwd'];
        $user_id = Auth::Admin()->id;
        $check_password = Admin::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $old_pwd = Admin::where('id',Auth::Admin()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                // Update password
                $new_pwd = bcrypt($data['new_pwd']);
                Admin::where('id',Auth::Admin()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password updated successfully!');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is incorrect!');
            }
        }
    }    


    public function viewDashboard(Request $request){
        return view('admin.dashboard');
    }


    // newsviews section
    // add new newsviews
    public function addNews(Request $request){
        if($request->isMethod('post')){
            if (!Schema::hasTable('news')) {
                return redirect()->back()->with('flash_message_error', 'News table is missing. Please run migrations.');
            }

            $data = $request->all();
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
            $newsviews = new News;
            $newsviews->title = $data['title'];
            $newsviews->description = $data['description'];
            if (Schema::hasColumn('news', 'category')) {
                $newsviews->category = $data['category'] ?? null;
            }
            if (Schema::hasColumn('news', 'date')) {
                $newsviews->date = $data['date'] ?? null;
            }
            if (Schema::hasColumn('news', 'status')) {
                $newsviews->status = isset($data['status']) ? (int)$data['status'] : 1;
            }

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999999) . '.' . $extension;
                    $uploadDir = public_path('assets/images/news');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $newsviews_path = $uploadDir . DIRECTORY_SEPARATOR . $filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $newsviews->image = $filename;
                }
            }
            $newsviews->save();
            return redirect('admin/view-news')->with('flash_message_success','New record added successfully');
        }
        return view('admin.media.add-news');
    }
    
    // edit specific newsviews
    public function editNews(Request $request, $id){
        if (!Schema::hasTable('news')) {
            return redirect()->back()->with('flash_message_error', 'News table is missing. Please run migrations.');
        }

        $newsviews = News::where('id',$id)->first();
        if (!$newsviews) {
            return redirect('admin/view-news')->with('flash_message_error', 'News record not found.');
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $uploadDir = public_path('assets/images/news');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $collaborate_path = $uploadDir . DIRECTORY_SEPARATOR . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            $updateData = [
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $filename
            ];

            if (Schema::hasColumn('news', 'category')) {
                $updateData['category'] = $data['category'] ?? null;
            }
            if (Schema::hasColumn('news', 'date')) {
                $updateData['date'] = $data['date'] ?? null;
            }
            if (Schema::hasColumn('news', 'status')) {
                $updateData['status'] = isset($data['status']) ? (int)$data['status'] : 1;
            }

            News::where('id',$id)->update($updateData);
            return redirect('admin/view-news')->with('flash_message_success','New record updated successfully');
        }
        return view('admin.media.edit-news')->with(compact('newsviews'));
    }

     public function viewNews(){
        if (!Schema::hasTable('news')) {
            return view('admin.media.view-news')->with('newsviews', collect())->with('flash_message_error', 'News table is missing. Please run migrations.');
        }
        $newsviews = News::orderBy('id','DESC')->get();
        // dd($newsviewss);
        return view('admin.media.view-news')->with(compact('newsviews'));
    }

    public function deleteNews(Request $request, $id){
        News::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }

    public function linkedinEmbed(Request $request)
    {
        if (!Schema::hasTable('site_settings')) {
            return redirect()->back()->with('flash_message_error', 'site_settings table missing. Please run php artisan migrate.');
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'linkedin_embed' => 'nullable|string',
            ]);

            SiteSetting::updateOrCreate(
                ['setting_key' => 'linkedin_embed_news'],
                ['setting_value' => trim((string) ($data['linkedin_embed'] ?? ''))]
            );

            return redirect()->back()->with('flash_message_success', 'LinkedIn embed URL updated successfully');
        }

        $linkedinEmbed = SiteSetting::where('setting_key', 'linkedin_embed_news')->value('setting_value');
        return view('admin.media.linkedin-embed')->with(compact('linkedinEmbed'));
    }

    public function addLinkedinPost(Request $request)
    {
        if (!Schema::hasTable('linkedin_posts')) {
            return redirect()->back()->with('flash_message_error', 'linkedin_posts table missing. Please run php artisan migrate.');
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'embed_code' => 'required|string',
            ]);

            LinkedinPost::create([
                'title' => null,
                'embed_code' => trim((string) $data['embed_code']),
                'sort_order' => 0,
                'status' => 1,
            ]);

            return redirect('admin/view-linkedin-posts')->with('flash_message_success', 'LinkedIn post added successfully');
        }

        return view('admin.media.add-linkedin-post');
    }

    public function viewLinkedinPosts()
    {
        if (!Schema::hasTable('linkedin_posts')) {
            return view('admin.media.view-linkedin-posts')->with('posts', collect())->with('flash_message_error', 'linkedin_posts table missing. Please run php artisan migrate.');
        }

        $posts = LinkedinPost::orderBy('id', 'DESC')->get();
        return view('admin.media.view-linkedin-posts')->with(compact('posts'));
    }

    public function editLinkedinPost(Request $request, $id)
    {
        if (!Schema::hasTable('linkedin_posts')) {
            return redirect()->back()->with('flash_message_error', 'linkedin_posts table missing. Please run php artisan migrate.');
        }

        $post = LinkedinPost::find($id);
        if (!$post) {
            return redirect('admin/view-linkedin-posts')->with('flash_message_error', 'LinkedIn post not found.');
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'embed_code' => 'required|string',
            ]);

            $post->update([
                'embed_code' => trim((string) $data['embed_code']),
            ]);

            return redirect('admin/view-linkedin-posts')->with('flash_message_success', 'LinkedIn post updated successfully');
        }

        return view('admin.media.edit-linkedin-post')->with(compact('post'));
    }

    public function deleteLinkedinPost($id)
    {
        LinkedinPost::where('id', $id)->delete();
        return redirect()->back()->with('flash_message_success', 'LinkedIn post deleted successfully');
    }


    // Clients section

    // add new Client
    public function addClient(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $clients = new Clients;
            $clients->title = $data['title'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999999) . '.' . $extension;
                    $newsviews_path = 'images/backend_images/client/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $clients->image = $filename;
                }
            }
            $clients->save();
            return redirect('admin/view-client')->with('flash_message_success','New record added successfully');
        }
        return view('admin.clients.add-client');
    }
    
    // edit specific Client
    public function editClient(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'images/backend_images/client/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }
            Clients::where('id',$id)->update(['title'=>$data['title'],'image'=>$filename]);
            return redirect('admin/view-client')->with('flash_message_success','New record updated successfully');
        }
        $clients = Clients::where('id',$id)->first();
        return view('admin.clients.edit-client')->with(compact('clients'));
    }

     public function viewClient(){
        $clients = Clients::orderBy('id','DESC')->get();
        // dd($newsviewss);
        return view('admin.clients.view-client')->with(compact('clients'));
    }

    public function deleteClient(Request $request, $id){
        Clients::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }    


    // Event section

    // add new event
    public function addEvent(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $clients = new Event;
            $clients->title = $data['title'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999999) . '.' . $extension;
                    $newsviews_path = 'images/backend_images/event/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $clients->image = $filename;
                }
            }
            $clients->save();
            return redirect('admin/view-event')->with('flash_message_success','New record added successfully');
        }
        return view('admin.events.add-event');
    }
    
    // edit specific Event
    public function editEvent(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'images/backend_images/event/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }
            Event::where('id',$id)->update(['title'=>$data['title'],'image'=>$filename]);
            return redirect('admin/view-event')->with('flash_message_success','New record updated successfully');
        }
        $event = Event::where('id',$id)->first();
        return view('admin.events.edit-event')->with(compact('event'));
    }

     public function viewEvent(){
        $event = Event::orderBy('id','DESC')->get();
        // dd($newsviewss);
        return view('admin.events.view-event')->with(compact('event'));
    }

    public function deleteEvent(Request $request, $id){
        Event::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // Expo section

    // add new Expo
    public function addExpo(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $expo = new Expo;
            $expo->title = $data['title'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999999) . '.' . $extension;
                    $newsviews_path = 'images/backend_images/expo/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $expo->image = $filename;
                }
            }
            $expo->save();
            return redirect('admin/view-expo')->with('flash_message_success','New record added successfully');
        }
        return view('admin.events.add-expoevent');
    }
    
    // edit specific Event
    public function editExpo(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'images/backend_images/expo/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }
            Expo::where('id',$id)->update(['title'=>$data['title'],'image'=>$filename]);
            return redirect('admin/view-expo')->with('flash_message_success','New record updated successfully');
        }
        $expo = Expo::where('id',$id)->first();
        return view('admin.events.edit-expoevent')->with(compact('expo'));
    }

     public function viewExpo(){
        $expo = Expo::orderBy('id','DESC')->get();
        // dd($newsviewss);
        return view('admin.events.view-expoevent')->with(compact('expo'));
    }

    public function deleteExpo(Request $request, $id){
        Expo::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }

}
