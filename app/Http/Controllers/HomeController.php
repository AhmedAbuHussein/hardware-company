<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use App\Category;
use App\Comment;

class HomeController extends Controller
{
    public function index(){
        $cats = Category::all();
        $items = Item::orderBy('id','DESC')->get();
        $arr = Array(
            'items'=>$items,
            'cats'=>$cats,
        );
        return view('users.main',$arr);
    }

    public function view($id){
        $item = Item::find($id);
        $user = User::find($item->user_id);
        $cat = Category::find($item->category_id);
        $cats = Category::all();
        $comments = Comment::where('item_id','=',$id)
                            ->orderby('id','DESC')
                            ->get();

        $arr = Array(
            'item'=>$item,
            'user'=>$user,
            'cat'=>$cat,
            'cats'=>$cats,
            'comments'=>$comments,
        );

        return view('users.view',$arr);
    }

    public function category($id){
        $item = Item::where('category_id','=',$id)->get();
        $users = User::all();
        $cats = Category::all();

        $arr = Array(
            'items'=>$item,
            'users'=>$users,
            'cats'=> $cats,
        );
        return view('users.category',$arr);
    }
  
    public function profile($id){
        $user = User::find($id);
        if(count($user) == 0){
            return redirect('/');
        }
        $cats = Category::all();
        $items =  Item::join('categorys','items.category_id','=','categorys.id')
                        ->join('users','items.user_id','=','users.id')
                        ->select('items.*','categorys.name as cat_name')
                        ->where('users.id','=',$id)
                        ->get();
        $price =  Item::join('categorys','items.category_id','=','categorys.id')
                        ->join('users','items.user_id','=','users.id')
                        ->where('users.id','=',$id)
                        ->sum('price');

        $arr = Array(
            'cats'=>$cats,
            'items' => $items,
            'user'=>$user,
            'price'=>$price,
        );
        return view('users.profile',$arr);
    }

    public function newads(Request $req){
        $cats = Category::all();
        $arr = Array(
            'cats'=>$cats,
        );
        return view('users.ads',$arr);

    }
    public function addads(Request $req){
        if($req->isMethod('POST')){
            $newItem = new Item();
            return $this->itemFun($req,$newItem,'/');
        }
        return redirect('/');

    }




    public function itemFun($req, $item,$dir="/"){

        $img_name = time() . '.'. $req->url->getClientOriginalExtension();
       
        $this->validate($req,[
            'name'=>'required|min:3',
            'description'=>'required|min:10',
            'price'=>'required',
            'country'=>'required|min:3',
            'status'=>'required',
            'category_id'=>'required',
            'user_id'=>'required',
            'approve'=>'required',
            'url'=> 'max:5120|mimes:jpg,jpeg,png,gif'
        ]);
        
        $item->name = filter_var($req->input('name'),FILTER_SANITIZE_STRING);
        $item->description = filter_var($req->input('description'),FILTER_SANITIZE_STRING);
        $item->price = filter_var($req->input('price'),FILTER_SANITIZE_STRING);
        $item->country= filter_var($req->input('country'),FILTER_SANITIZE_STRING);
        $item->status = filter_var($req->input('status'),FILTER_SANITIZE_NUMBER_INT);
        $item->category_id = intval( filter_var($req->input('category_id'),FILTER_SANITIZE_NUMBER_INT) );
        $item->user_id = intval( filter_var($req->input('user_id'),FILTER_SANITIZE_NUMBER_INT) );
        $item->approve = intval( filter_var($req->input('approve'),FILTER_SANITIZE_NUMBER_INT) );
        $item->img = $img_name;

        $item->save();
        $req->url->move(public_path('items'),$img_name);
        return redirect($dir);
    }

}
