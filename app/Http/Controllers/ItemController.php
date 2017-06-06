<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;

class ItemController extends Controller
{
    public function showUserItems(){
    	$items = Item::all()->where('user_id','=',Auth::user()->email);
    	return view('item',compact('items'));
    }

    public function addUserItems(Request $request){
    	$item = new Item;
    	 if($request->saveItem){
            $this->validate($request,[
            'item' => 'required',
            ]);

            $item->item = $request->get("item");
            $item->user_id = Auth::user()->email;
            $item->save();

         return back();
    	}

	}

	public function markItem($id){
		$item = Item::find($id);
		if ($request->get('done') == null) {
        		$item->done = false;
        	} else{
        		$item->done = true;
        	}
        $item->save();
        return back();
	}

	public function deletItem($id){

		$item_id = Item::find($id);

		$item_id->delete();

		return back();
	}
}

