<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;


class ItemController extends Controller
{
    //
    public function getItem(){
        return Item::with(['category'])->get();
    }
    public function getItemByID($id){
        return Item::find($id);
    }

    public function createItem(Request $request){
        $item = new Item();
        $item -> name = $request-> name;
        $item -> image = $request-> image;
        $item -> price = $request-> price;
        $item -> description = $request-> description;
        $item->save();
        $item->category()->attach($request->category_id);
        $item->category();
        return $item;
    }

    public function deleteItem($id){
        $item = Item::find($id);

        if (isset($item)) {
            $item->delete();
            $respond = [
                'status' => 201,
                'message' => "item $id deleted successfully",
                'data' => $item
            ];
            return $respond;
        }
        $respond = [
            'status' => 201,
            'message' => "item $id is not found",
            'data' => null
        ];
        return $respond;


    }
    public function updateItem(Request $request, $id){
        $respond = [
            'status' => 201,
            'message' => null,
            'data' => null
        ];
        $item = Item::find($id);
        if(!isset($item)){
            $respond["message"]= "item $id doesn't exist";
            return $respond;
        }
        
        $item->name = $request->name??$item->name;
        $item->image = $request->image??$item->image;
        $item->price = $request->image??$item->price;
        $item->description = $request->image??$item->description;
        $item->save();
        $respond["message"]= "item edited successfully";
        $respond["data"] = $item;
        return $respond;

        
    }

}
