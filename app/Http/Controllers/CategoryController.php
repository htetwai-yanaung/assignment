<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    //category page
    public function index(){
        $categories = Category::paginate(5);
        return view('admin.category.index')->with(['categories' => $categories]);
    }

    //category create page
    public function create(){
        return view('admin.category.create');
    }

    //store category
    public function store(Request $request){
        $this->checkCategoryValidation($request);
        if($request->hasFile('photo')){
            $photo = uniqid().'_'.$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path().'/asset/images', $photo);

            Category::create([
                'name' => $request->name,
                'photo' => $photo,
                'status' => $request->status ? $request->status:'unpublish',
            ]);
        }else{
            Category::create([
                'name' => $request->name,
                'status' => $request->status ? $request->status:'unplish',
            ]);
        }
        return redirect()->route('category.index')->with(['success' => 'Category successfully created!']);
    }

    //delete category
    public function delete($id){
        $item = Item::where('category_id', $id)->first();
        if($item){
            return back()->with(['fail' => 'You can not delete this category right now!']);
        }else{
            $category = Category::find($id);
            $photo = $category->photo;
            if($photo){
                File::delete(public_path().'/asset/images/'.$photo);
            }
            Category::where('id', $id)->delete();
        }
        return back()->with(['success' => 'Category successfully deleted!']);
    }

    //edit category page
    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit')->with(['category' => $category]);
    }

    //update category
    public function update(Request $request, $id){
        $this->checkCategoryValidation($request);
        if($request->hasFile('photo')){
            $photo = uniqid().'_'.$request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path().'/asset/images', $photo);

            $this->deletePhoto($id);

            Category::where('id', $id)->update([
                'name' => $request->name,
                'photo' => $photo,
                'status' => $request->status ? $request->status:'unpublish',
            ]);
        }else{
            Category::where('id', $id)->update([
                'name' => $request->name,
                'status' => $request->status ? $request->status:'unpublish',
            ]);
        }
        return redirect()->route('category.index')->with(['success' => 'Category successfully updated!']);
    }

    //validation category request
    private function checkCategoryValidation($request){
        $request->validate([
            'name' => 'required',
            'photo' => 'mimes:png,jpg,webp',
        ]);
    }

    //delete photo
    private function deletePhoto($id){
        $category = Category::find($id);
        $photo = $category->photo;
        if($photo){
            File::delete(public_path().'/asset/images/'.$photo);
        }
    }
}
