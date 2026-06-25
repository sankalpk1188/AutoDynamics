<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use App\Models\BlogLike;
use App\Models\BlogComment;
use Image;

class BlogsController extends Controller
{

    // add new blogs
    public function addBlogs(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $blogs = new Blogs;            
            $blogs->title = $data['title'];
            $blogs->category = $data['category'];
            $blogs->description = $data['description'];
            $blogs->date = $data['date'];
            $blogs->status = !empty($data['status']) ? 1 : 0;

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $filename = strtotime("now").'.'. $image_tmp->getClientOriginalName();
                    $newsviews_path = 'assets/images/blogs/'.$filename;
                    Image::make($image_tmp)->save($newsviews_path);
                    $blogs->image = $filename;
                }
            }
        
            $blogs->save();
            return redirect('admin/view-blogs')->with('flash_message_success','New blog added successfully');
        }
        return view('admin.blogs.add-blogs');
    }
    
    // edit specific blogs
    public function editBlogs(Request $request, $id){
        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalName();
                    $filename = strtotime("now").'.'. $extension;
                    $collaborate_path = 'assets/images/blogs/' . $filename;
                    Image::make($image_tmp)->save($collaborate_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            Blogs::where('id',$id)->update([
                'title' => $data['title'],
                'category' => $data['category'],
                'description' => $data['description'],
                'date' => $data['date'],
                'image' => $filename,
                'status' => !empty($data['status']) ? 1 : 0,
            ]);

            return redirect('admin/view-blogs')->with('flash_message_success','Blog updated successfully');
        }
        $blogs = Blogs::where('id',$id)->first();
        return view('admin.blogs.edit-blogs')->with(compact('blogs'));
    }

    public function viewBlogs(){
        $blogs = Blogs::orderBy('date','DESC')->get();
        // dd($newsviewss);
        return view('admin.blogs.view-blogs')->with(compact('blogs'));
    }

    public function deleteBlogs(Request $request, $id){
        Blogs::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Blog deleted successfully');
    }


    public function blogComments(Request $request, $id){
        $comments = BlogComment::where('blog_id',$id)->orderBy('id','DESC')->paginate(10);
        return view('admin.blogs.blog_comments')->with(compact('comments'));
    }

    public function commentStatus(Request $request, $id){
        if($request->status == '1'){
            $status='1';
        }else{
            $status='0';
        }
        BlogComment::where(['id'=>$id])->update(['status'=>$status]);
        createLog(__FUNCTION__);
        return redirect()->back();
    }

    // delete blog
    public function commentDelete(Request $request, $id){
        BlogComment::where('id',$id)->delete();
        createLog(__FUNCTION__);
        return redirect()->back()->with('flash_message_success','Comment deleted successfully');
    }

    public function likeBlog(Request $request, $id) {
        $liked = BlogLike::where(['blog_id'=>$id,'user_ip'=>$request->ip()])->first();
        if($liked){
            BlogLike::where(['blog_id'=>$id,'user_ip'=>$request->ip()])->delete();
            return redirect()->back();
        }
        else{
            $bloglike = new BlogLike;
            $bloglike->blog_id = $id;
            $bloglike->user_ip = $request->ip();
            $bloglike->save();
            return redirect()->back();
        }
    }

    public function commentBlog(Request $request, $id) {
        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);
            $comment = new BlogComment;            
            $comment->blog_id = $id;
            $comment->user_ip = $request->ip();
            $comment->user_name = $data['user_name'];
            $comment->comment = $data['comment'];
            $comment->status = 0;
            $comment->save();

            $blog = Blogs::select('id','title')->where('id',$id)->first();
            $blog_title = $blog->title;
            // $email = [getValue('comment_form_email')];
            $messageData = [
                'user' => $data,
                'blog_title' => $blog_title,
            ];
            // Mail::send('emails.comment_notification',$messageData,function($message) use($email, $blog_title){
            //     $message->to($email)->subject('New comment on blog - '. Str::limit($blog_title, 25));
            // });

            return redirect()->back()->with('success_message','Your comment has been successfully submitted. We will review it and then proceed to publish it. Thank you!');
        }
    }
}
