<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\DesignUpload;
use Image;

class ContactController extends Controller
{

    //ENQUIRY
    public function viewJoinusEnq(Request $request){
        
        $enquiry = Enquiry::orderBy('id','asc')->get();
        // dd($enq);
        return view('admin.enquiry.view_joinus_enq')->with(compact('enquiry'));
    }
    
    public function deleteJoinusEnq(Request $request, $id){
        enquiry::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Enquiry deleted successfully.');
    }

    public function viewDesignUploads(Request $request)
    {
        $uploads = DesignUpload::orderBy('id', 'desc')->get();
        return view('admin.design_upload.view_design_uploads')->with(compact('uploads'));
    }

    public function deleteDesignUpload(Request $request, $id)
    {
        DesignUpload::where('id', $id)->delete();
        return redirect()->back()->with('flash_message_success', 'Design upload request deleted successfully.');
    }

    public function joinusEnq(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            $enquiry = new Enquiry;
            $enquiry->name = $data['name'];
            $enquiry->email = $data['email'];
            $enquiry->phone = $data['phone'];
            $enquiry->organisation = $data['organisation'];
            $enquiry->requirement = $data['requirement'];
            $enquiry->comment = $data['comment'];
            $enquiry->save();
            return redirect()->back()->with('flash_message_success','Your response recorded successfully');
        }
    }


    // add new contact
    public function addContact(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $contact = new Contact;
            $contact->location = $data['location'];
            $contact->address = $data['address'];
            $contact->phone = $data['phone'];
            $contact->email = $data['email'];

            $contact->save();
            return redirect('admin/view-contact')->with('flash_message_success','New record added successfully');
        }
        return view('admin.contact.add-contact');
    }
    
    // edit specific contact
    public function editContact(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            Contact::where('id',$id)->update(['location'=>$data['location'],'address'=>$data['address'],'phone'=>$data['phone'],'email'=>$data['email']]);
            return redirect('admin/view-contact')->with('flash_message_success','New record updated successfully');
        }
        $contact = Contact::where('id',$id)->first();
        return view('admin.contact.edit-contact')->with(compact('contact'));
    }

     public function viewContact(){
        $contact = Contact::orderBy('id','ASC')->get();
        // dd($newsviewss);
        return view('admin.contact.view-contact')->with(compact('contact'));
    }

    public function deleteContact(Request $request, $id){
        Contact::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Data deleted successfully');
    }

}
