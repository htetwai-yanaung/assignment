<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Type;
use App\Models\Owner;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ItemController extends Controller
{
    //item page
    public function index(){
        $items = Item::with('category', 'condition', 'type', 'owner')->paginate(5);
        return view('admin.item.index')->with(['items' => $items]);
    }

    //item create page
    public function create(){
        $categories = Category::get();
        $conditions = Condition::get();
        $types = Type::get();
        return view('admin.item.create')->with([
            'categories' => $categories,
            'conditions' => $conditions,
            'types' => $types
        ]);
    }

    //store item
    public function store(Request $request){

        $this->checkItemsValidation($request);

        $photo = uniqid().'_'.$request->file('photo')->getClientOriginalName();
        $request->file('photo')->move(public_path().'/asset/images', $photo);

        $owner = [
            'name' => $request->ownerName,
            'phone' => $request->phone,
            'address' => $request->address,
            'location' => $request->location
        ];

        $owner = Owner::create($owner);

        $item = [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'condition_id' => $request->condition,
            'type_id' => $request->type,
            'status' => $request->status ? $request->status:'unplish',
            'photo' => $photo,
            'owner_id' => $owner->id
        ];

        Item::create($item);

        return redirect()->route('item.index')->with(['success' => 'Item successfully created.']);
    }

    //delete item
    public function delete($id){
        $item = Item::find($id);
        $photo = $item->photo;
        $ownerId = $item->owner_id;

        if(File::exists(public_path().'/asset/images/'.$photo)){
            File::delete(public_path().'/asset/images/'.$photo);
        }

        Owner::where('id', $ownerId)->delete();

        Item::where('id', $id)->delete();
        return back()->with(['success' => 'Item successfully deleted!']);
    }

    //edit item page
    public function edit($id){
        $categories = Category::get();
        $conditions = Condition::get();
        $types = Type::get();
        $item = Item::find($id);
        return view('admin.item.edit')->with([
            'categories' => $categories,
            'conditions' => $conditions,
            'types' => $types,
            'item' => $item
        ]);
    }

    //update item
    public function update(Request $request, $id){
        $this->checkItemsValidation($request);

        $item = Item::find($id);
        $oldPhoto = $item->photo;
        $ownerId = $item->owner_id;
        if($request->hasFile('photo')){

            if(File::exists(public_path().'/asset/images/'.$oldPhoto)){
                File::delete(public_path().'/asset/images/'.$oldPhoto);
            }

            $photo = uniqid().'_'.$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path().'/asset/images', $photo);

            Item::where('id', $id)->update($this->itemData($request, $photo));
        }else{
            Item::where('id', $id)->update($this->itemData($request, $oldPhoto));
        }

        Owner::where('id', $ownerId)->update($this->ownerData($request));

        return redirect()->route('item.index')->with(['success' => 'Item update success!']);
    }

    //check item validation
    private function checkItemsValidation($request){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'description' => 'required',
            'condition' => 'required',
            'type' => 'required',
            'photo' => Route::currentRouteName() == 'item.store' ? 'required|mimes:jpg,png,webp' : 'mimes:jpg,png,webp',
            'ownerName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'location' => 'required',
        ]);
    }

    //item data
    private function itemData($request, $photo){
        $item = [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'condition_id' => $request->condition,
            'type_id' => $request->type,
            'status' => $request->status ? $request->status:'unplish',
            'photo' => $photo,
        ];
        return $item;
    }

    //owner data
    private function ownerData($request){
        $owner = [
            'name' => $request->ownerName,
            'phone' => $request->phone,
            'address' => $request->address,
            'location' => $request->location
        ];
        return $owner;
    }
}
