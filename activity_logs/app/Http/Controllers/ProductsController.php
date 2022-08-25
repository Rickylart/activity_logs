<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ActivityLogs;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $showEditForm = false;
        $product_data = [];

        $products = Products::all();

        return view('addproduct',compact('products','product_data','showEditForm'));
    }

    public function add_product(Request $request){
        //*********Get current user id and name **************/
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;

        //**********Validate requests ***************/
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'product_cost' => 'required|numeric',
            'product_type' => 'required'
        ]);

        //***********Save requests in a variable : product_data, array key is the db-column name and the value is the request data *******//
        $product_data = [
            'product_name' => $request->product_name,
            'product_cost' => $request->product_cost,
            'product_type' => $request->product_type
        ];

        //**********Save data with laravel eloquent with product model ********/
        $save_to_db = Products::Create($product_data);

        //***********Store user activity to the activity table when the product data is successfully saved *********//
        if ($save_to_db) {
            //********** creating a custom message for the activity table with current user id */
            $activity_data = [
                'user_id' => $user_id,
                'activity' => $user_name." added a new product with the following details :<br/> <b class='text-success'>Product Name - ".$request->product_name.",<br/> Product Cost - GHs".$request->product_cost.", <br/> Product Type - ".$request->product_type."<br/></b> on ".date('d F Y , h:i:s A')
            ];

            ActivityLogs::Create($activity_data);

            return redirect()->back()->with('success', 'Product added successful');
        }
        else{
            return redirect()->back()->with('error', 'Failed to add Product');
        }
    }

    public function edit_product($id){
        $showEditForm = true;
        $products = Products::all();

        //******Get Product by id */
        $fetchProducts = Products::findOrFail($id);

        $product_data = [
            'id' => $id,
            'name' => $fetchProducts->product_name,
            'cost' => $fetchProducts->product_cost,
            'type' => $fetchProducts->product_type
        ];

        session()->flash('noti','Product Ready For Editing');

        return view('addproduct',compact('products','product_data','showEditForm'));
    }

    public function update_product(Request $request){
        //*********Get current user id and name **************/
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;

        $showEditForm = false;
        $products = Products::all();
        $product_data = [];

         //******Get Product by id */
         $fetchProducts = Products::findOrFail($request->id);

         //********** creating a custom message for the activity table with current user id */
        $activity_data = [
            'user_id' => $user_id,
            'activity' => $user_name." updated a product with the following details : <br/> Product Name - from <b class='text-danger'>[".$fetchProducts->product_name."]</b> to <b class='text-success'>".$request->product_name.",</b> <br/> Product Cost - from <b class='text-danger'>[GHs".$fetchProducts->product_cost."]</b> to <b class='text-success'>GHs".$request->product_cost.",</b> <br/> Product Type - from <b class='text-danger'>[".$fetchProducts->product_type."]</b> to <b class='text-success'>".$request->product_type."</b><br/> on ".date('d F Y , h:i:s A')
        ];


        //******Update Product by id */
        $fetchProducts->update([
            'product_name' => $request->product_name,
            'product_cost' => $request->product_cost,
            'product_type' => $request->product_type
        ]);

        ActivityLogs::Create($activity_data);


        return redirect()->to(route('add-product'))->with('success', 'Product updated successful');
        // return view('addproduct',compact('products','product_data','showEditForm'));
    }

    public function destroy_product(Request $request){
        //*********Get current user id and name **************/
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;

        $get_product_data = Products::find($request->id);

        /********** creating a custom message for the activity table with current user id */
        $activity_data = [
            'user_id' => $user_id,
            'activity' => $user_name." deleted a product with the following details :<br/> <b class='text-danger'>Product Name - ".$get_product_data->product_name.",<br/> Product Cost - GHs".$get_product_data->product_cost.", <br/> Product Type - ".$get_product_data->product_type."</b> <br/> on ".date('d F Y , h:i:s A')
        ];

       $delete = Products::find($request->id)->delete();

       if($delete){
        ActivityLogs::Create($activity_data);

        return redirect()->back()->with('success', 'Product delete successful');
       }
       else{
        return redirect()->back()->with('error', 'Error Deleting data');
       }




    }



}
