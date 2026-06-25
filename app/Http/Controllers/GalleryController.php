<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Support\Facades\Schema;
use Image;

class GalleryController extends Controller
{

    public function addGallery(Request $request){
        if($request->isMethod('post')){
            if (!Schema::hasTable('gallery')) {
                return redirect()->back()->with('flash_message_error','Gallery table missing. Please run migrations.');
            }
            $data = $request->all();
            $request->validate([
                'cat_id' => 'required|numeric',
                'title' => 'nullable|string|max:255',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status' => 'nullable|in:0,1',
            ]);
            $gallery = new Gallery;
            $gallery->cat_id = $data['cat_id'];
            if (Schema::hasColumn('gallery', 'title')) {
                $gallery->title = $data['title'] ?? null;
            }
            $gallery->status = !empty($data['status']) ? 1 : 0;

            if($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999999) . '.' . $extension;
                    $uploadDir = public_path('assets/images/gallery');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $file_path = $uploadDir . DIRECTORY_SEPARATOR . $filename;
                    Image::make($image_tmp)->save($file_path);
                    $gallery->image = $filename;
                }
            }
            $gallery->save();
            return redirect('admin/view-gallery/')->with('flash_message_success','Gallery added successfully');
        }
        return view('admin.gallery.add_gallery');
    }

    public function editGallery(Request $request, $id){
        if (!Schema::hasTable('gallery')) {
            return redirect()->back()->with('flash_message_error','Gallery table missing. Please run migrations.');
        }
        $gallery = Gallery::where('id',$id)->first();
        if (!$gallery) {
            return redirect('admin/view-gallery')->with('flash_message_error', 'Gallery record not found.');
        }

        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'cat_id' => 'required|numeric',
                'title' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'status' => 'nullable|in:0,1',
            ]);
            if ($request->hasFile('image')) {
                $image_tmp = $request->image;
                if ($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(1111, 99999999) . '.' . $extension;
                    $uploadDir = public_path('assets/images/gallery');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
                    $file_path = $uploadDir . DIRECTORY_SEPARATOR . $filename;
                    Image::make($image_tmp)->save($file_path);
                }
            } else if (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            } else {
                $filename = '';
            }

            $updateData = [
                'cat_id' => $data['cat_id'],
                'status' => !empty($data['status']) ? 1 : 0,
                'image' => $filename
            ];
            if (Schema::hasColumn('gallery', 'title')) {
                $updateData['title'] = $data['title'] ?? null;
            }
            Gallery::where('id',$id)->update($updateData);
            return redirect('admin/view-gallery')->with('flash_message_success','Gallery details updated successfully');
        }
        return view('admin.gallery.edit_gallery')->with(compact('gallery'));
    }

    public function deleteGallery(Request $request, $id){
        Gallery::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Gallery deleted successfully');
    }

    public function viewGallery(Request $request) {
        if (!Schema::hasTable('gallery')) {
            return view('admin.gallery.view_gallery')->with('gallery', collect())->with('flash_message_error', 'Gallery table missing. Please run migrations.');
        }
        $gallery = Gallery::select('gallery.id','gallery.cat_id','gallery.title','gallery.image','gallery.status','gallery_category.name')
            ->leftJoin('gallery_category','gallery.cat_id','gallery_category.id')
            ->orderBy('gallery.id','DESC');

        if($request->cat_id){
            $gallery = $gallery->where('gallery.cat_id',$request->cat_id);
        }

        $gallery = $gallery->paginate(20)->appends($request->query());
        return view('admin.gallery.view_gallery', compact('gallery'));
    }
}
