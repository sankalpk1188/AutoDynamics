<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Utility\CategoryUtility;
use Illuminate\Support\Str;
use Cache;
use PDF;
use Auth;
use DB;
use Image;
use Session;

class ServiceController extends Controller
{

    public function addServices(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $services = new Services;
            $services->name = $data['name'];
            $services->type = $data['type'];
            $services->size = $data['size'];
            $services->description = $data['description'];
            $services->additional = $data['additional'];
            $services->category_id = $data['category_id'];
            $services->season = isset($data['season']) ? implode(',', $data['season']) : null;

            if($request->hasFile('image')){

                $image_tmp = $request->image;          
                $filename = time(). '.'.$image_tmp->clientExtension();
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $services_path = 'assets/img/products/'.$filename;
                    Image::make($image_tmp)->save($services_path);
                    $services->image = $filename;
                }
            }

            // dd($services);
            $services->save();
           return redirect('admin/view-services')->with('flash_message_success','Data added successfully');
        }
        $category = Category::where('parent_id', 0)
            ->with('childrenCategory')
            ->get();
        return view('admin.services.add-services')->with(compact('category'));
    }

    public function editServices(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            // Upload services image
             
             
            if($request->hasFile('image')){

                $image_tmp = $request->image;         
                $filename = time() . '.'.$image_tmp->clientExtension(); 
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $services_path = 'assets/img/products/'.$filename;
                    Image::make($image_tmp)->save($services_path);
                }
            }else if(!empty($data['current_image'])){
                $filename = $data['current_image'];
            }else{
                $filename = '';
            }

            Services::where(['id' => $id])->update([
                'name' => $data['name'],
                'type' => $data['type'],
                'size' => $data['size'],
                'description' => $data['description'],
                'additional' => $data['additional'],
                'season' => implode(',', $data['season']),
                'image' => $filename
            ]);
            return redirect('/admin/view-services')->with('flash_message_success','Data updated Successfully!');
        }
        $services = services::where(['id'=>$id])->first();
        return view('admin.services.edit-services')->with(compact('services'));
    }

    public function deleteServices(Request $request, $id = null){
        if(!empty($id)){
            services::where(['id'=>$id])->delete();
            // return redirect()->back()->('flash_message_success','Category Deleted Successfully');
            return redirect('/admin/view-services')->with('flash_message_success','Category Deleted Successfully');
        }
    }

    public function viewServices(){
        $services = Services::select('services.*','category.title')->Join('category','category.id','services.category_id')->orderBy('services.id','DESC')->get();
        // $services = services::orderBy('id','ASC')->get();
        // dd($services);
        return view('admin.services.view-services')->with(compact('services'));
    }


    public function view(Request $request)
    {
        $sort_search =null;
        $category = Category::orderBy('order_level', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $category = $category->where('name', 'like', '%'.$sort_search.'%');
        }
        $category = $category->paginate(15);
        return view('admin.services.view', compact('sort_search','category'));
    }

    public function add(){
        $category = Category::where('parent_id', 0)
            ->with('childrenCategory')
            ->get();
        // dd($category);    
        return view('admin.services.add', compact('category'));
    }

    public function store(Request $request){
        $category = new Category;
        $category->title = $request->title;
        $category->order_level = 0;
        if($request->order_level != null) {
            $category->order_level = $request->order_level;
        }
        
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;
            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1 ;
        }

        if ($request->slug != null) {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }
 
        $category->save();

        // flash('Category has been inserted successfully')->success();
        return redirect('admin/services/view/');
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $request, $id){
        $lang = $request->lang;
        $category = Category::findOrFail($id);
        $category = Category::where('parent_id', 0)
            ->with('childrenCategory')
            ->whereNotIn('id', CategoryUtility::children_ids($category->id, true))->where('id', '!=' , $category->id)
            ->orderBy('title','asc')
            ->get();

        return view('admin.services.edit', compact('category', 'category', 'lang'));
    }

    public function update(Request $request, $id){
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if($request->order_level != null) {
            $category->order_level = $request->order_level;
        }

        $previous_level = $category->level;

        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1 ;
        }
        else{
            $category->parent_id = 0;
            $category->level = 0;
        }

        if($category->level > $previous_level){
            CategoryUtility::move_level_down($category->id);
        }
        elseif ($category->level < $previous_level) {
            CategoryUtility::move_level_up($category->id);
        }

        if ($request->slug != null) {
            $category->slug = strtolower($request->slug);
        }
        else {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.Str::random(5);
        }

        $category->save();    

        return redirect('admin/services/view/');
    }

    public function destroy($id){
        CategoryUtility::delete_category($id);
        return redirect()->back();
    }
}
