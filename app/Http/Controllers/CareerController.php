<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Career;
use App\Models\JobApplication;
use App\Models\Opportunities;
use Image;
use Illuminate\Support\Facades\Schema;

class CareerController extends Controller
{

    // add new career
    public function addCareer(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $career = new Career;
            $career->title = $data['title'];
            $career->description = $data['description'];

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'-'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/imgs/career/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $career->image = $filename;
                }
            }

            $career->save();
            return redirect('admin/view-career')->with('flash_message_success','New record added successfully');
        }
        return view('admin.career.add-career');
    }
    
    // edit specific career
    public function editCareer(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                $filename = time() . '.' . $image_tmp->clientExtension();
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999) . '.' . $extension;
                    $collaborate_path = 'assets/imgs/career/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Career::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'image'=>$filename]);
            return redirect('admin/view-career')->with('flash_message_success','New record updated successfully');
        }
        $career = Career::where('id',$id)->first();
        return view('admin.career.edit-career')->with(compact('career'));
    }

     public function viewCareer(){
        $career = Career::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.career.view-career')->with(compact('career'));
    }

    public function deleteCareer(Request $request, $id){
        Career::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }


    // add new opportunities
    public function addOpportunities(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $opportunities = new Opportunities;            
            $opportunities->designation_name = $data['designation_name'];
            $opportunities->job_description = $data['job_description'];
            $opportunities->location = $data['location'];
            $opportunities->qualification = $data['qualification'];
            $opportunities->experience = $data['experience'];
            $opportunities->email = $data['email'];
            $opportunities->status = !empty($data['status']) ? 1 : 0;

            $opportunities->save();
            return redirect('admin/view-opportunities')->with('flash_message_success','New record added successfully');
        }
        return view('admin.opportunities.add-opportunities');
    }
    
    // edit specific opportunities
    public function editOpportunities(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            Opportunities::where('id',$id)->update([
                'designation_name' => $data['designation_name'],
                'job_description' => $data['job_description'],
                'location' => $data['location'],
                'qualification' => $data['qualification'],
                'experience' => $data['experience'],
                'email' => $data['email'],
                'status' => !empty($data['status']) ? 1 : 0,
            ]);

            // Opportunities::where('id',$id)->update(['designation_name'=>$data['designation_name'],'job_description'=>$data['job_description'],'location'=>$data['location'],'qualification'=>$data['qualification'],'experience'=>$data['experience'],'email'=>$data['email']]);
            return redirect('admin/view-opportunities')->with('flash_message_success','New record updated successfully');
        }
        $opportunities = Opportunities::where('id',$id)->first();
        return view('admin.opportunities.edit-opportunities')->with(compact('opportunities'));
    }

    public function viewOpportunities(){
        $opportunities = Opportunities::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.opportunities.view-opportunities')->with(compact('opportunities'));
    }

    public function deleteOpportunities(Request $request, $id){
        Opportunities::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }

    public function viewJobApplications(Request $request, $id = null){
        if (!Schema::hasTable('job_applications')) {
            $applications = collect();
            return view('admin.opportunities.view-applications')->with(compact('applications'));
        }

        if (Schema::hasColumn('job_applications', 'job_id') && !empty($id)) {
            $applications = JobApplication::where('job_id', $id)->orderBy('id', 'DESC')->get();
        } else {
            $applications = JobApplication::orderBy('id', 'DESC')->get();
        }
        return view('admin.opportunities.view-applications')->with(compact('applications'));
    }
}
