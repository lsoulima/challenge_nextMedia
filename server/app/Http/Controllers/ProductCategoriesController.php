<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ProductCategories;

class ProductCategoriesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [ //inputs are not empty or null
            'product_id' => ['required', 'exists:products,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
  
        $productCategories = new ProductCategories;
        $productCategories->product_id = $request->input('product_id'); //retrieving user inputs
        $productCategories->category_id = $request->input('category_id');  //retrieving user inputs
        $productCategories->save(); //storing values as an object
        return $productCategories; //returns the stored value if the operation was successful.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $productCategories = ProductCategories::findorFail($id); //searching for object in database using ID
        if($productCategories->delete()){ //deletes the object
            return 'Product removed from Category successfully'; //shows a message when the delete operation was successful.
        }
    }
}
