<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ActivityLogs;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){

        return view('products');
    }

    public function add_product(Request $request){
        //*********Get current user id and name **************/
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;

        //**********Validate requests ***************/
        $request->validate([
            'product_name' => 'required',
            'product_cost' => 'required',
            'product_type' => 'required'
        ]);

        //***********Save requests in a variable : product_data, array key is the db-column name and the value is the request data *******//
        $product_data = [
            'product_name' => $request->product_name,
            'product_cost' => $request->product_cost,
            'product_type' => $request->product_type
        ];

        //**********Save data with laravel eloquent with product model ********/
        $save_to_db = Product::Create($product_data);

        //***********Store user activity to the activity table when the product data is successfully saved *********//
        if ($save_to_db) {
            //********** creating a custom message for the activity table with current user id */
            $activity_data = [
                'user_id' => $user_id,
                'activity' => $user_name." added a new product with the following details : Product Name - ".$request->product_name.", Product Cost - GHs".$request->product_cost.", and Product Type - ".$request->product_type." on ".date('d F Y , h:i:s A')
            ];

            ActivityLogs::Create($activity_data);

            return redirect()->back()->with('success', 'Product added successful');
        }
        else{
            return redirect()->back()->with('error', 'Failed to add Product');
        }
    }



}
