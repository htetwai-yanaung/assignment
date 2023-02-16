<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function changeCategoryStatus(Request $request){
        Category::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return back()->with(['success' => 'Category status updated']);
    }

    public function changeItemStatus(Request $request){
        Item::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return back()->with(['success' => 'Item status updated']);
    }

    public function filter(Request $request){
        if($request->category_id != null){
            $items = Item::where('category_id', $request->category_id)
                ->with('category', 'condition', 'type', 'owner')->get();
            return response()->json($items, 200);
        }else{
            $items = Item::with('category', 'condition', 'type', 'owner')->get();
            return response()->json($items, 200);
        }
    }

}
