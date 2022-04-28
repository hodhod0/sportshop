<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class CategoryController extends Controller
{
    //
    public function getCategory(){
        return Category::with(['Item'])->get();
    }

    public function getCategoryByID($id){
        return Category::find($id);
    }

    public function createCategory(Request $request){
        $category = new Category();
        $category -> name = $request-> name;
        $category -> image = $request-> image;
        $category->save();
        $category->item()->attach($request->item_id);
        $category->item;
        return $category;
    }

    public function deleteCategory($id){
        $category = Category::find($id);

        if (isset($category)) {
            $category->delete();
            $respond = [
                'status' => 201,
                'message' => "category $id deleted successfully",
                'data' => $category
            ];
            return $respond;
        }
        $respond = [
            'status' => 201,
            'message' => "category $id is not found",
            'data' => null
        ];
        return $respond;


    }

    public function updateCategory(Request $request, $id){
        $respond = [
            'status' => 201,
            'message' => null,
            'data' => null
        ];
        $category = Category::find($id);
        if(!isset($category)){
            $respond["message"]= "category $id doesn't exist";
            return $respond;
        }

        
        
        $category->name = $request->name??$category->name;
        $category->image = $request->image??$category->image;
        $category->save();
        $respond["message"]= "category edited successfully";
        $respond["data"] = $category;
        return $respond;

        
    }
}
