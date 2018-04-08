<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Category;
use App\Item;
use App\Comment;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{

    public function index(){

        if(Auth::user()->groupid != 1){
            return redirect('/');
        }

        $numUser = count( User::all());
        $numCat = count(Category::all());
        $numItem = count(Item::all());
        $numComment = count(Comment::all());
        $latsUser = User::orderBy('id' , 'DESC')->limit(5)->get();
        $latsItems = Item::orderBy('id', 'DESC')->limit(5)->get();

        $arr = Array(
            'userNum'=>$numUser,
            'catNum'=>$numCat,
            'itemNum'=>$numItem,
            'commentNum'=>$numComment,
            'latsUser'=> $latsUser,
            'latsItems' => $latsItems
            ); 
        
        
        return view('admin.home',$arr);
    }

    public function users(Request $req){


        if(Auth::user()->groupid != 1){
            return redirect("/");
        }

        if($req->get('userid') != "" && is_numeric($req->get('userid'))){

            $id = intval($req->get('userid'));
            $user = User::find($id);
            $user->delete();

            return redirect('users');
        }

        $users = User::all();
        $arr = Array('users'=>$users);

        return view('admin.user',$arr);

    }

    public function category(Request $req){

        if(Auth::user()->groupid != 1){
            return redirect("/");
        }

        if($req->get('catid') != "" && is_numeric($req->get('catid'))){

            $id = intval($req->get('catid'));
            $cat = Category::find($id);
            $cat->delete();

            return redirect('category');
        }
        $cats = Category::all();
        $arr = Array('cats'=>$cats);
        return view('admin.category',$arr);
    }

    public function item(Request $req){

        if(Auth::user()->groupid != 1){
            return redirect("/");
        }

        if($req->get('itemid') != "" && is_numeric($req->get('itemid'))){

            $id = intval($req->get('itemid'));
            $item = Item::find($id);
            $item->delete();

            return redirect('item');
        }

        $cats = Item::all();
        $arr = Array('items'=>$cats);
        return view('admin.item',$arr);
    }

    public function comment(Request $req){

        if(Auth::user()->groupid != 1){
            return redirect("/");
        }

        if($req->get('commentid') != "" && is_numeric($req->get('commentid'))){

            $id = intval($req->get('commentid'));
            $comment = Comment::find($id);
            $comment->delete();

            return redirect('comment');
        }

        $cats = Comment::all();
        $arr = Array('comments'=>$cats);
        return view('admin.comment',$arr);
    }


    public function profile(Request $req)
    {

        if(Auth::user()->groupid != 1){
            return redirect("/");
        }

        $users = User::all();
        $id = $req->get('userid');
        $user = Array();
        $userid = "";
        foreach($users as $u){
            if(sha1($u->id) == $id){
                $userid = $u->id;
                $user = $u;
                break;
            }
        }

        if(count($user)== 0){
            return redirect('/profile?userid='. sha1(Auth::user()->id) );
        }

        $cats = Category::all();
        $items =  Item::join('categorys','items.category_id','=','categorys.id')
                        ->join('users','items.user_id','=','users.id')
                        ->select('items.*','categorys.name as cat_name')
                        ->where('users.id','=',$userid)
                        ->get();
        $arr = Array(
            'user'=>$user,
            'cats'=>$cats,
            'items'=>$items,

        );
        return view('admin.profile',$arr);
    }

    /****************************** Edit Function ******************************** */
    public function edit(Request $req){

        $action =  $req->get('action');
       if($action == "user"){

           $id = intval($req->get('id'));
           $user = User::find($id);
           $arr = Array('action'=>'user','data'=>$user);
           return view('admin.edit',$arr);

       }elseif ($action == "category") {

            $id = intval($req->get('id'));
            $cat = Category::find($id);
            $arr = Array('action'=>'category','data'=>$cat);
            return view('admin.edit',$arr);

       }elseif($action == "item"){

            $id = intval($req->get('id'));
            $cat = Item::find($id);
            $users = User::all();
            $cats = Category::all();

            $arr = Array('action'=>'item','data'=>$cat, 'users'=>$users, "cats"=>$cats);
            return view('admin.edit',$arr);
       }
       return redirect('home');

    }


    public function editPost (Request $req){

        if($req->isMethod('POST')){

            $action = $req->input('action');

            if($action == 'user'){

                $id = intval($req->input('id'));
                $edit = User::find($id);
                return $this->userFun($req, $edit);
                
            }//end post user edit data 
            elseif($action == "category"){

                $id = intval($req->get('id'));
                $cat = Category::find($id);
                return $this->categoryFun($req, $cat);
            }//end post category edit data
            elseif($action== "item"){
                $id = intval($req->get('id'));
                $item = Item::find($id);
                return $this->itemFun($req, $item);
            }

        } // end is post method  
    }//end edit function 



    public function add(Request $req){

        if($req->isMethod('POST')){
            $action = $req->input('action');
            //add new user
            if($action=='user'){

                $newUser = new User();
                return $this->userFun($req, $newUser);

            }//end add new user
            elseif($action == "category"){

                $newCat = new Category();
                return $this->categoryFun($req, $newCat);

            }//end add new category
            elseif($action == "item"){

                $newItem = new Item();
                return $this->itemFun($req, $newItem);

            }//end add new Item
        }// end post status


        // get request
        $action = $req->get('action');

        if($action == "item"){
            $users = User::all();
            $cat = Category::all();

            $arr = Array('action'=>$action,'users'=>$users,'cats'=>$cat);
            return view('admin.add',$arr);
        }

        $arr = Array('action'=>$action);
        return view('admin.add',$arr);
    }


    /***************************** Custom Function *********************************** */

    public function userFun($req, $edit){
     
        $img_name = time() . '.'. $req->url->getClientOriginalExtension();
       

        $this->validate($req,[

            'name'=>'required|min:3',
            'email'=>'required|min:6',
            'password'=>'required|min:3',
            'fullname'=>'required|min:6',
            'groupid'=>'required',
            'regstatus'=>'required',
        ]);

        $edit->name = filter_var($req->input('name'),FILTER_SANITIZE_STRING);
        $edit->email= filter_var($req->input('email'),FILTER_SANITIZE_EMAIL);
        $edit->password = bcrypt (filter_var($req->input('password'),FILTER_SANITIZE_STRING));
        $edit->fullname = filter_var($req->input('fullname'),FILTER_SANITIZE_STRING);
        $edit->groupid = filter_var($req->input('groupid'),FILTER_SANITIZE_NUMBER_INT);
        $edit->regstatus = filter_var($req->input('regstatus'),FILTER_SANITIZE_NUMBER_INT);
  
        $edit->img  = $img_name;

        $edit->save();
        $req->url->move(public_path('upload'),$img_name);

        return redirect('users');
        
    }

    public function categoryFun($req, $cat) {

        $this->validate($req,[

            'name'=>'required|min:3',
            'description'=>'required|min:10',
            'ordering'=>'required'

        ]);

        $cat->name = filter_var($req->input('name'),FILTER_SANITIZE_STRING);
        $cat->description = filter_var($req->input('description'),FILTER_SANITIZE_STRING);
        $cat->ordering = filter_var($req->input('ordering'),FILTER_SANITIZE_NUMBER_INT);
        $cat->save();

        return redirect('category');
    }


    public function itemFun($req, $item,$dir="item"){

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
