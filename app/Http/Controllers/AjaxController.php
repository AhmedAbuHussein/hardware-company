<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function search(Request $req){
        $items = Item::where('name','LIKE','%' . $req->text . '%')->get();
        return json_encode($items);
    }

    public function message(Request $req){

        $msg = new Comment();
        $msg->comment = filter_var($req->message,FILTER_SANITIZE_STRING);
        $msg->user_id = $req->userid;
        $msg->item_id = $req->itemid;
        $msg->save();
        return 'done';
    }

    public function messages(Request $req){
        $msg = new Comment();
        $msg->comment = filter_var($req->message,FILTER_SANITIZE_STRING);
        $msg->user_id = Auth::id();
        $msg->item_id = $req->input('id');
        $msg->save();
        return redirect('/view/' . $req->input('id'));
    }
}
