<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\About;
use App\Models\Stats;
use App\Models\Whykpca;
use App\Models\Industry;
use Image;

class HomepageController extends Controller
{

        // add new banner
    public function addBanner(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->description = $data['description'];
            $banner->status = !empty($data['status']) ? 1 : 0;

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalName();
                    $filename = strtotime("now") . '.' . $extension;
                    $path = 'assets/imgs/banner/' . $filename;
                    Image::make($image_tmp)->save($path);
                    $banner->image = $filename;
                }
            }
            
            $banner->save();
            return redirect('admin/view-banner')->with('flash_message_success','New record added successfully');
        }
        return view('admin.banner.add-banner');
    }
    
    // edit specific banner
    public function editBanner(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalName();
                    $filename = strtotime("now") . '.' . $extension;
                    $path = 'assets/imgs/banner/' . $filename;
                    Image::make($image_tmp)->save($path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Banner::where('id',$id)->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $filename,
                'status' => !empty($data['status']) ? 1 : 0,
            ]);
            return redirect('admin/view-banner')->with('flash_message_success','New record updated successfully');
        }
        $banner = Banner::where('id',$id)->first();
        return view('admin.banner.edit-banner')->with(compact('banner'));
    }

     public function viewBanner(){
        $banner = Banner::orderBy('id','ASC')->paginate(5);
        return view('admin.banner.view-banner')->with(compact('banner'));
    }

    public function deleteBanner(Request $request, $id){
        Banner::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new about
    public function addAbout(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $about = new About;
            $about->title = $data['title'];
            $about->description = $data['description'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/about/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $about->image = $filename;
                }
            }

            $about->save();
            return redirect('admin/view-about')->with('flash_message_success','New record added successfully');
        }
        return view('admin.about.add-about');
    }
    
    // edit specific about
    public function editAbout(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalName();
                    $filename = strtotime("now") . '.' . $extension;
                    $collaborate_path = 'assets/imgs/about/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            About::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'image'=>$filename]);
            return redirect('admin/view-about')->with('flash_message_success','New record updated successfully');
        }
        $about = About::where('id',$id)->first();
        return view('admin.about.edit-about')->with(compact('about'));
    }

     public function viewAbout(){
        $about = About::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.about.view-about')->with(compact('about'));
    }

    public function deleteAbout(Request $request, $id){
        About::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new stats
    public function addStats(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $stats = new Stats;
            $stats->count = $data['count'];
            $stats->prefix = $data['prefix'];
            $stats->title = $data['title'];

            $stats->save();
            return redirect('admin/view-stats')->with('flash_message_success','New record added successfully');
        }
        return view('admin.stats.add-stats');
    }
    
    // edit specific stats
    public function editStats(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            Stats::where('id',$id)->update(['count'=>$data['count'],'prefix'=>$data['prefix'],'title'=>$data['title']]);
            return redirect('admin/view-stats')->with('flash_message_success','New record updated successfully');
        }
        $stats = Stats::where('id',$id)->first();
        return view('admin.stats.edit-stats')->with(compact('stats'));
    }

     public function viewStats(){
        $stats = Stats::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.stats.view-stats')->with(compact('stats'));
    }

    public function deleteStats(Request $request, $id){
        Stats::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new whykpca
    public function addWhykpca(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $whykpca = new Whykpca;
            $whykpca->title = $data['title'];
            $whykpca->description = $data['description'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/whykpca/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $whykpca->image = $filename;
                }
            }
            $whykpca->save();
            return redirect('admin/view-whykpca')->with('flash_message_success','New record added successfully');
        }
        return view('admin.whykpca.add-whykpca');
    }
    
    // edit specific whykpca
    public function editWhykpca(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'assets/imgs/whykpca/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Whykpca::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'image'=>$filename]);
            return redirect('admin/view-whykpca')->with('flash_message_success','New record updated successfully');
        }
        $whykpca = Whykpca::where('id',$id)->first();
        return view('admin.whykpca.edit-whykpca')->with(compact('whykpca'));
    }

     public function viewWhykpca(){
        $whykpca = Whykpca::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.whykpca.view-whykpca')->with(compact('whykpca'));
    }

    public function deleteWhykpca(Request $request, $id){
        Whykpca::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new industry
    public function addIndustry(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $industry = new Industry;            
            $industry->title = $data['title'];
            $industry->description = $data['description'];
            $industry->date = $data['date'];

            if($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $pdf = strtotime("now") . '.' . $file->getClientOriginalName();
                $destinationPath = public_path('pdf/');
                $file->move($destinationPath, $pdf);
                $industry->pdf=$pdf;
            }

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/industry/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $industry->image = $filename;
                }
            }
            $industry->save();
            return redirect('admin/view-industry')->with('flash_message_success','New record added successfully');
        }
        return view('admin.industry.add-industry');
    }
    
    // edit specific industry
    public function editIndustry(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalName();
                    $filename = strtotime() . '.' . $extension;
                    $collaborate_path = 'assets/imgs/industry/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            // Upload Product pdf
            if($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $pdf = time() . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('pdf/');
                $file->move($destinationPath, $pdf);
            }else if(!empty($data['current_file'])){
                $pdf = $data['current_file'];
            }else{
                $pdf = '';
            }

            Industry::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'date'=>$data['date'],'pdf'=>$pdf,'image'=>$filename]);
            return redirect('admin/view-industry')->with('flash_message_success','New record updated successfully');
        }
        $industry = Industry::where('id',$id)->first();
        return view('admin.industry.edit-industry')->with(compact('industry'));
    }

    public function viewIndustry(){
        $industry = Industry::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.industry.view-industry')->with(compact('industry'));
    }

    public function deleteIndustry(Request $request, $id){
        Industry::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }
}
