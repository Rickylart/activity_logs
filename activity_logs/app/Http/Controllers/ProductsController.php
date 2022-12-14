<?php

namespace App\Http\Controllers;

use App\Models\ActivityLogs;
use App\Models\Products;
use DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $product_data = [];

        $products = Products::all();

        return view('addproduct', compact('products', 'product_data'));
    }

    public function add_product(Request $request)
    {
        try {
            //*********Get current user id and name **************/
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;

            //**********Validate requests ***************/
            $request->validate([
                'product_name' => 'required|unique:products,product_name',
                'product_cost' => 'required|numeric',
                'product_type' => 'required',
            ]);

            //***********Save requests in a variable : product_data, array key is the db-column name and the value is the request data *******//
            $product_data = [
                'product_name' => $request->product_name,
                'product_cost' => $request->product_cost,
                'product_type' => $request->product_type,
            ];

            //**********Save data with laravel eloquent with product model ********/
            $save_to_db = Products::Create($product_data);

            //***********Store user activity to the activity table when the product data is successfully saved *********//
            if ($save_to_db) {
                //********** creating a custom message for the activity table with current user id */
                $activity_data = [
                    'user_id' => $user_id,
                    'activity' => $user_name . " added a new product with the following details :<br/> <b class='text-success'>Product Name - " . $request->product_name . ",<br/> Product Cost - GHs" . $request->product_cost . ", <br/> Product Type - " . $request->product_type . "<br/></b> on " . date('d F Y , h:i:s A'),
                ];

                ActivityLogs::Create($activity_data);

                return redirect()->back()->with('success', 'Product added successful');
            } else {
                return redirect()->back()->with('error', 'Failed to add Product');
            }
        } catch (\Throwable$th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function product_status($id)
    {
        try {
            //*********Get current user id and name **************/
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;
            $status = '';

            //******Get Product by id */
            $fetchProducts = Products::findOrFail($id);

            //******Check product status */
            if ($fetchProducts->status === 'pending') {
                //*****Update status*/
                $status = 'published';
                DB::update('update products set status = ? where id = ?', [$status, $id]);
            } else {
                //*****Update status*/
                $status = 'pending';
                DB::update('update products set status = ? where id = ?', [$status, $id]);
            }

            //********** creating a custom message for the activity table with current user id */
            $activity_data = [
                'user_id' => $user_id,
                'activity' => $user_name . " updated a product status with the following details : <br/> Product Name - <b class='text-success'>[" . $fetchProducts->product_name . "]</b> <br/> Product Cost - <b class='text-success'>[GHs" . $fetchProducts->product_cost . "]</b> <br/> Product Type - <b class='text-success'>[" . $fetchProducts->product_type . "]</b> <br/> Product Status - from <b class='text-danger'>[" . $fetchProducts->status . "]</b> to <b class='text-success'>[" . $status . "]</b> <br/> on " . date('d F Y , h:i:s A'),
            ];

            ActivityLogs::Create($activity_data);

            return redirect()->to(route('add-product'))->with('success', 'Product updated successful');

        } catch (\Throwable$th) {
            return redirect()->to(route('add-product'))->with('error', $th->getMessage());
        }

    }

    public function edit_product($id)
    {
        $showEditForm = true;
        $products = Products::all();

        //******Get Product by id */
        $fetchProducts = Products::findOrFail($id);

        $product_data = [
            'id' => $id,
            'name' => $fetchProducts->product_name,
            'cost' => $fetchProducts->product_cost,
            'type' => $fetchProducts->product_type,
        ];

        session()->flash('noti', 'Product Ready For Editing');

        return view('addproduct', compact('products', 'product_data', 'showEditForm'));
    }

    public function update_product(Request $request, $id)
    {
        try {
            //*********Get current user id and name **************/
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;

            $showEditForm = false;
            $products = Products::all();
            $product_data = [];

            //******Get Product by id */
            $fetchProducts = Products::findOrFail($id);

            //********** creating a custom message for the activity table with current user id */
            $activity_data = [
                'user_id' => $user_id,
                'activity' => $user_name . " updated a product with the following details : <br/> Product Name - from <b class='text-danger'>[" . $fetchProducts->product_name . "]</b> to <b class='text-success'>" . $request->product_name . ",</b> <br/> Product Cost - from <b class='text-danger'>[GHs" . $fetchProducts->product_cost . "]</b> to <b class='text-success'>GHs" . $request->product_cost . ",</b> <br/> Product Type - from <b class='text-danger'>[" . $fetchProducts->product_type . "]</b> to <b class='text-success'>" . $request->product_type . "</b><br/> on " . date('d F Y , h:i:s A'),
            ];

            //******Update Product by id */
            $fetchProducts->update([
                'product_name' => $request->product_name,
                'product_cost' => $request->product_cost,
                'product_type' => $request->product_type,
            ]);

            ActivityLogs::Create($activity_data);

            return redirect()->back()->with('success', 'Product updated successful');
        } catch (\Throwable$th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

    }

    public function give_product_comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|min:5',
        ]);

        try {
            //*********Get current user id and name **************/
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;

            //******Get Product by id */
            $fetchProducts = Products::findOrFail($id);

            //********** creating a custom message for the activity table with current user id */
            $activity_data = [
                'user_id' => $user_id,
                'activity' => $user_name . " added a comment to a product with the following details : <br/> Product Name - <b class='text-success'>" . $fetchProducts->product_name . ",</b> <br/> Product Cost - <b class='text-success'>GHs" . $fetchProducts->product_cost . ",</b> <br/> Product Type - <b class='text-success'>" . $fetchProducts->product_type . "</b><br/><b class='text-warning'> Comment Added : ". $request->comment ."</b><br/>on " . date('d F Y , h:i:s A'),
            ];

            //*****Update */
            DB::update('update products set product_comment = ? where id = ?', [$request->comment, $id]);

            ActivityLogs::Create($activity_data);

            return redirect()->back()->with('success', "Comment added !");
        } catch (\Throwable$th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy_product(Request $request, $id)
    {
        try {
            //*********Get current user id and name **************/
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;

            $get_product_data = Products::find($id);

            /********** creating a custom message for the activity table with current user id */
            $activity_data = [
                'user_id' => $user_id,
                'activity' => $user_name . " deleted a product with the following details :<br/> <b class='text-danger'>Product Name - " . $get_product_data->product_name . ",<br/> Product Cost - GHs" . $get_product_data->product_cost . ", <br/> Product Type - " . $get_product_data->product_type . "</b> <br/> on " . date('d F Y , h:i:s A'),
            ];

            $delete = Products::find($id)->delete();

            if ($delete) {
                ActivityLogs::Create($activity_data);

                return redirect()->back()->with('success', 'Product delete successful');
            } else {
                return redirect()->back()->with('error', 'Error Deleting data');
            }
        } catch (\Throwable$th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

}
