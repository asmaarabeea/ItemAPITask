<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use Auth;
use App\User;

class ItemController extends Controller
{
    /**
    show all items for the logged in user
    @return items array
    */
    public function showUserItems(Request $request){
        if($request->get('token')){
            $user = User::where('api_token', $request->get('token'))->first();

        	$items = Item::all()->where('user_id','=', $user->email);
        	if($items){
        		return response()->json(['sucess' => true, 'items' => $items] , 200);
    	    }else{
    			return response()->json(['sucess' => false] , 404);	    	
    	    }
        }else{
            return response()->json(['error' => 'User not registered.'], 401);
        }
    }


    /**
    Add new item for the logged in user
    @return item array
    */
    public function addUserItems(Request $request){
        if($request->get('token')){
            $user = User::where('api_token', $request->get('token'))->first();

            $item = new Item;
            $item->item = $request->get("item");
            $item->user_id = $user->email;

            if($item->save()){
                return response()->json($item,200); 
            }else{
                return response()->json("Failed to save the item", 500);
            }
        }else{
            return response()->json(['error' => 'User not registered.'], 401);
        }
    }


    /**
    check item
    @return the checked item array
    */
    public function markItem($id, Request $request){
    	if($request->get('token')){
            $user = User::where('api_token', $request->get('token'))->first();

        	$item = Item::find($id);

            if ($request->get('done') == null) {
                    $item->done = false;
                } else{
                    $item->done = true;
                }
        	
        	if($item){
        	
        		return response()->json($item , 200);
        	
        	}else{

        		return response()->json("This item is not exists" , 404);	

        	}
    	}else{
            return response()->json(['error' => 'User not registered.'], 401);
        }
    }

    /**
    delete an item if exists
    @return success string
    */
    public function deletItem($id, Request $request){
        if($request->get('token')){
            $user = User::where('api_token', $request->get('token'))->first();

        	$item = Item::where('id', $id)->where('user_id', $user->email)->first();

        	if(isset($item) && $item->delete()){
        		return response()->json(['sucess'=>'Item deleted successfully'],200);
        	}else{
        		return response()->json("This item is not exists", 404);
        	}
        	
        
        }else{
            return response()->json(['error' => 'User not registered.'], 401);
        }
    }
 
}
