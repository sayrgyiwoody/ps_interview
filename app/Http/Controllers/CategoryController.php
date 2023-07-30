<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(){
        $category = Category::when(request('searchKey'),function($query){
            $query->where('name','like','%'.request('searchKey').'%');
        })->orderBy('created_at','desc')->paginate(6);
        return view('admin.category.list',compact('category')); // -> direct to category list page
    }

    public function createPage(){

        return view('admin.category.create'); // -> direct to category create page
    }

    public function editPage($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category')); // -> direct to category edit page
    }

    //update product
    public function edit(Request $request,$id) {
        $this->categoryValidationCheck($request,$id);
        $data = $this->categoryGetData($request);
        //image check
        if($request->hasFile('categoryImage')) {
            $dbImage = Category::select('image')->where('id',$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/categoryImages/'.$dbImage);
            }
            $imageName = uniqid() . '_' . $request->file('categoryImage')->getClientOriginalName();
            $data['image'] = $imageName;
            $request->file('categoryImage')->storeAs('public/categoryImages/',$imageName);
        }
        Category::where('id',$id)->update($data);
        return redirect()->back()->with(['updateAlert'=>'Category updated successfully.']);
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $category = $this->categoryGetData($request);
        if($request->has('categoryStatus')){
            $category['publish_status'] = 1;
        }
        if($request->hasFile('categoryImage')) {
            $categoryImageName = uniqid(). '_' . $request->file('categoryImage')->getClientOriginalName();
            $category['image'] = $categoryImageName;
            $request->file('categoryImage')->storeAs('public/categoryImages',$categoryImageName);
        }
        Category::create($category);
        return redirect()->back()->with(['createAlert' => 'category Created successfully']);
    }

    //delete category
    public function delete($id) {
        $dbImage = Category::select('image')->where('id',$id)->first();
        $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/categoryImages/'.$dbImage);
            }
        Category::where('id',$id)->delete();
        return back()->with(['deleteAlert'=>'Category deleted successfully.']);
    }

    //change publish status
    public function changeStatus(Request $request){
        Category::where('id',$request->category_id)->update(['publish_status'=>$request->category_status]);
        return response()->json(200);
    }

    //validate category
    private function categoryValidationCheck($request,$id = 0){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name,'. $id,
            'categoryImage' => 'required|mimes:png,jpg,jpeg,JPEG,webp|file',

        ])->validate();
    }

     //get data from category input
     private function categoryGetData($request) {
        return [
            'name' => $request->categoryName,
            'image' => null,
        ];
    }
}
