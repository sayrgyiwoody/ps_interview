<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\Owner;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function list(){
        $searchKey = request('searchKey');
        $query = Item::select('items.*','owners.name as owner_name','categories.name as category_name')
            ->leftJoin('owners', 'items.owner_id', 'owners.id')
            ->leftJoin('categories', 'items.category_id', 'categories.id')
            ->orderBy('items.created_at', 'desc');
        if ($searchKey) {
            $query->where('items.name', 'like', '%' . $searchKey . '%');
        }
        $item = $query->paginate(6);
        return view('admin.item.list',compact('item')); // -> direct to category list page
    }

    public function createPage(){
        $category = Category::get();
        return view('admin.item.create',compact('category')); // -> direct to category create page
    }

    //Direct to item edit Page
    public function editPage($id){
        $category = Category::get();
        $item = Item::select('items.*','items.name as item_name','owners.id as owner_id','owners.name as owner_name','owners.*')
        ->leftJoin('owners','items.owner_id','owners.id')
        ->where('items.id',$id)->first();
        $location = unserialize($item->location);
        $lat = $location[0];
        $long = $location[1];
        $old_category_id = $item->category_id;
        return view('admin.item.edit',compact('category','item','old_category_id','lat','long'));
    }


    public function create(Request $request){

        $this->itemValidationCheck($request);

        //for owner data
        $owner = $this->ownerGetData($request);
        $owner = Owner::create($owner); // -> insert owner data into owners table
        $owner_id = $owner->id; // -> get owner_id

        //for item data
        $item = $this->itemGetData($request);
        $item['owner_id'] = $owner_id;
        if($request->has('itemStatus')){
            $item['publish_status'] = 1;
        }

        //for item image
        if($request->hasFile('itemImage')) {
            $itemImageName = uniqid(). '_' . $request->file('itemImage')->getClientOriginalName();
            $item['image'] = $itemImageName;
            $request->file('itemImage')->storeAs('public/itemImages',$itemImageName);
        }
        Item::create($item); // -> insert item data to items table

        return redirect()->back()->with(['createAlert' => 'item Created successfully']);
    }

    //update item
    public function edit(Request $request,$id) {
        $this->itemValidationCheck($request,$id);
        //for owner data
        $owner_id = Item::select('owner_id')->where('id',$id)->get();
        $owner = $this->ownerGetData($request);
        Owner::where('id',$owner_id)->update($owner); // -> insert owner data into owners table

        //for item data
        $item = $this->itemGetData($request);

        //image check
        if($request->hasFile('itemImage')) {
            $dbImage = Item::select('image')->where('id',$id)->first();
            $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/itemImages/'.$dbImage);
            }
            $imageName = uniqid() . '_' . $request->file('itemImage')->getClientOriginalName();
            $item['image'] = $imageName;
            $request->file('itemImage')->storeAs('public/itemImages/',$imageName);
        }
        Item::where('id',$id)->update($item);
        return redirect()->back()->with(['updateAlert'=>'item updated successfully.']);
    }

    //change publish status
    public function changeStatus(Request $request){
        Item::where('id',$request->item_id)->update(['publish_status'=>$request->item_status]);
        return response()->json(200);
    }

    //delete item
    public function delete($id) {
        $dbImage = Item::select('image')->where('id',$id)->first();
        $dbImage = $dbImage->image;
            if($dbImage!=null) {
                Storage::delete('public/itemImages/'.$dbImage);
            }
        Item::where('id',$id)->delete();
        return back()->with(['deleteAlert'=>'item deleted successfully.']);
    }

    //validate item
    private function itemValidationCheck($request,$id=0) {
        Validator::make($request->all(),[
            'itemName' => 'required|unique:items,name,'. $id,
            'categoryId' => 'required',
            'itemPrice' => 'required',
            'itemDesc' => 'required',
            'itemImage' => 'required|mimes:png,jpg,jpeg,JPEG,webp|file',
            'ownerName' => 'required',
        ])->validate();
    }

    //get data from item input
    private function itemGetData($request) {
        return [
            'name' => $request->itemName,
            'category_id' => $request->categoryId,
            'desc' => $request->itemDesc,
            'price' => $request->itemPrice,
            'image' => $request->itemImage,
            'condition' => $request->condition,
            'type' => $request->type,
            'location' => serialize([$request->lat,$request->long]),
            'updated_at' => Carbon::now()
        ];
    }

    private function ownerGetData($request){
        return [
            'name' => $request->ownerName,
            'number' => $request->ownerNumber,
            'address' => $request->ownerAddress,
        ];
    }

}
