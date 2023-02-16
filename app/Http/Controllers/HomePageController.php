<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Type;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //home page
    public function index(Request $request) {
        $items = Item::when(request('searchKey'), function($query){
            $query->orWhere('name', 'like', '%'.request('searchKey').'%');
        })->with('category', 'condition', 'type', 'owner')->get();
        $categories = Category::get();
        return view('user.home.index')->with(['items' => $items, 'categories' => $categories]);
    }

    //search page
    public function search() {
        $items = Item::Where('name','like','%'.request('itemName').'%')
        ->Where('category_id','like','%'.request('category').'%')
        ->Where('condition_id','like','%'.request('condition').'%')
        ->Where('type_id','like','%'.request('type').'%')
        ->when(request('min'),function($query){
            $query->WhereBetween('price', [request('min'), request('max')]);
        })
        ->with('category', 'condition', 'type', 'owner')
        ->get();
        $categories = Category::get();
        $conditions = Condition::get();
        $types = Type::get();
        return view('user.home.search')->with([
            'items' => $items,
            'categories' => $categories,
            'conditions' => $conditions,
            'types' => $types
        ]);
    }

    //details page
    public function details($id) {
        $item = Item::where('id', $id)->with('category', 'condition', 'type', 'owner')->first();
        return view('user.home.details')->with(['item' => $item]);
    }

}
