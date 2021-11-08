<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

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
            'name' => ['required', 'unique:categories', 'max:255'],
            'parent_category' => 'nullable|exists:categories,id'
        ]);
  
        $category = new Category;
        $category->name = $request->input('name'); //retrieving user inputs
        $category->parent_category = $request->input('parent_category');  //retrieving user inputs
        $category->save(); //storing values as an object
        return $category; //returns the stored value if the operation was successful.
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
        $category = Category::findorFail($id); //searching for object in database using ID
        if($category->delete()){ //deletes the object
            return 'Category deleted successfully'; //shows a message when the delete operation was successful.
        }
    }
}
