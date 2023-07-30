<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    //user home page
    public function home(){
        $item = Item::select('items.*','owners.name as owner_name','owners.address as owner_address')
        ->leftJoin('owners','items.owner_id','owners.id')
        ->orderBy('items.created_at','desc')
        ->when(request('searchKey'),function($query){
            $query->where('items.name','like','%'.request('searchKey').'%');
        })->paginate(9);
        $category = Category::get();
        return view('user.home',compact('item','category')); // -> direct to user home page
    }

    //Filter with Category
    public function categoryFilter($categoryId) {
        $item = Item::select('items.*','owners.name as owner_name','owners.number as owner_number','owners.address as owner_address')
        ->leftJoin('owners','items.owner_id','owners.id')
        ->where('category_id',$categoryId)->orderBy('created_at','desc')->paginate(9);
        $category = Category::get();
        return view('user.home',compact('item' ,'category'));
    }

    //item detail page
    public function detail($id){
        $item = Item::select('items.*','owners.name as owner_name','owners.number as owner_number','owners.address as owner_address')
        ->leftJoin('owners','items.owner_id','owners.id')
        ->where('items.id',$id)->first();
        $location = unserialize($item->location);
        $lat = $location[0];
        $long = $location[1];
        $items = Item::select('items.*','owners.name as owner_name','owners.address as owner_address')
        ->leftJoin('owners','items.owner_id','owners.id')
        ->orderBy('items.created_at','desc')->paginate(9);
        $category = Category::get();
        return view('user.detail',compact('category','item','items','lat','long'));
    }

    // filer
    public function filter(Request $request){
        $query = Item::query();

        if ($request->min_price !== null && $request->max_price !== null && $request->max_price > $request->min_price) {
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif ($request->min_price !== null) {
            $minPrice = $request->min_price;
            $query->where('price', '>=', $minPrice);
        } elseif ($request->max_price !== null) {
            $maxPrice = $request->max_price;
            $query->where('price', '<=', $maxPrice);
        }

        if ($request->condition !== null) {
            $condition = $request->condition;
            $query->where('condition', $condition);
        }

        if ($request->type !== null) {
            $type = $request->type;
            $query->where('type', $type);
        }

        $item = $query->select('items.*','owners.name as owner_name','owners.number as owner_number','owners.address as owner_address')
        ->leftJoin('owners','items.owner_id','owners.id')
        ->orderBy('items.created_at','desc')
        ->paginate(9);
        $category = Category::get();

        return view('user.home', compact('item','category'));
    }
}
