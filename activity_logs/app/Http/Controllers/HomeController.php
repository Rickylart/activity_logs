<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLogs;
use App\Models\Products;
use App\Models\User;
use DB;

class HomeController extends Controller
{
    //
    public function index(){
        //*****fetch all logs from db */
        if (auth()->user()->is_admin === 1) {
            $activities = ActivityLogs::orderBy('created_at', 'DESC')->get();
        }else {
            $activities = ActivityLogs::where('user_id',auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        }

        //*****count products from db */
        $total_products = Products::all()->count();

        //*****count not published products from db */
        $pending_products = Products::where('status','pending')->count();

        //*****count all users from db */
        $total_users = User::where('is_admin',0)->count();

        //*****count not active users from db */
        $inactive_users = User::where('status','inactive')->count();


        return view('dashboard',compact('activities','total_products','pending_products','total_users','inactive_users'));
    }

    public function user(){
        if (auth()->user()->is_admin === 1) {
            //*****fetch all logs from db */
        $activities = ActivityLogs::orderBy('created_at', 'DESC')->get();

        //*****count products from db */
        $total_products = Products::all()->count();

        //*****count not published products from db */
        $pending_products = Products::where('status','pending')->count();

        //*****count all users from db */
        $total_users = User::where('is_admin',0)->count();

        //*****count not active users from db */
        $inactive_users = User::where('status','inactive')->count();

        //******fetch all users in the system */
        $users = User::where('id',"!=",auth()->user()->id)->orderBy('created_at', 'DESC')->get();


        return view('users',compact('activities','total_products','pending_products','total_users','inactive_users','users'));
        }
        else{

            return redirect()->to(route('dashboard'))->with('error', 'You are not allowed');
        }
    }


    public function status($id){

        //******fetch all users in the system */
        $user = User::findOrFail($id);


        if ($user->status === 'inactive') {

        DB::update('update users set status = ? where id = ?', ['active',$id]);
        }
        else{
            DB::update('update users set status = ? where id = ?', ['inactive',$id]);
        }


        return redirect()->back()->with('success', 'User updated successful');
    }
}
