<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminsRole;
use App\Models\Category;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function categories(){
        $categories =  Category::with('parentcategory')->get();
        
        $categoriesModuleCount = AdminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id, 'module' => 'categories'])->count();
       $categoriesModule = array();
        if(Auth::guard('admin')->user()->type == "admin"){
           $categoriesModule['view_access'] = 1;
           $categoriesModule['edit_access'] = 1;
           $categoriesModule['full_access'] = 1;
        }else if($categoriesModuleCount==0){
            $message = "This feature is restricted for you";
            return redirect('admin/dashboard')->with('error_message', $message);
        }else{
           $categoriesModule =  AdminsRole::where(['subadmin_id' => Auth::guard('admin')->user()->id, 'module' => 'categories'])->first()->toArray();
        }
        return view('admin.categories.categories', compact('categories', 'categoriesModule'));
    }

    public function updateCategoryStatus(Request $request, Category $category){
        if($request->ajax()){
            $data = $request->all();
            // echo "<pre>". print_r($data); die;
            if($data['status'] == "Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            $category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function destroy($id)
    {
        Category::where('id', $id)->delete();
        return redirect('admin/categories')->with('success_message', 'Page Deleted Sucessfully');
    }

    public function addEditCategory(Request $request, $id=null){
        $getcategories = Category::getcategories();
         if($id==""){
            $title = 'Add Category';
            $category = new Category;
            $message = 'Category added Sucessfully';
         }else{
            $title = "Edit Category";
            $category = Category::find($id);
            $message = 'Category updated Successfully';
         }
         if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            $rules = [
                'category_name' => 'required',
                'url' => 'required|unique:categories'
            ];

            $this->validate($request, $rules);

            
            if ($request->hasFile('category_image')) {
                // Storage::disk('public')->delete($category->category_image);
                $ext = $request->file('category_image')->extension();
                $content = file_get_contents($request->file('category_image'));
                $filename = Str::random(35);
                $path = "category/$filename.$ext";
                Storage::disk('public')->put($path, $content);
            }
            if(empty($data['category_discount'])){
                $data['category_discount'] = 0;
            }
            $category->category_image = $path;
            $category->category_name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories')->with('success_message', $message);
         }
         return view('admin.categories.add_edit_category', compact('title', 'category', 'getcategories'));
    }
}
