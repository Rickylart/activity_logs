<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLogs;
use App\Models\Products;
use App\Models\User;

class HomeController extends Controller
{
    //
    public function index(){
        //*****fetch all logs from db */
        $activities = ActivityLogs::all();

        //*****count products from db */
        $total_products = Products::all()->count();

        //*****count not published products from db */
        $pending_products = Products::where('status','pending')->count();

        //*****count all users from db */
        $total_users = User::where('is_admin',0)->count();

        //*****count not active users from db */
        $unactive_users = User::where('status','inactive')->count();


        return view('dashboard',compact('activities','total_products','pending_products','total_users','unactive_users'));
    }
}
