<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request,[ //inputs are not empty or null
            'sort_by' => ['nullable', Rule::in(['name', 'price'])],
            'sort_direction' => ['nullable', Rule::in(['asc', 'desc'])],
        ]);

        $sort_by = $request->query('sort_by', 'created_at');
        $sort_direction = $request->query('sort_direction', 'asc');
        
        return Product::orderBy($sort_by, $sort_direction)->paginate(5);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        if ($request->hasFile('image')) {

            $this->validate($request,[ //inputs are not empty or null
                'name' => ['required', 'max:255'],
                'description' => ['required', 'max:2024'],
                'price' => ['required', 'numeric', 'min:1' ],
                'image' => ['required', 'mimes:jpeg,png'],// Only allow .jpg and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->image->store('uploads', 'public');

            $product = new Product;
            $product->name = $request->input('name'); //retrieving user inputs
            $product->description = $request->input('description');  //retrieving user inputs
            $product->price = $request->input('price');  //retrieving user inputs
            $product->image = $request->image->hashName(); //using the new file hashname which will be it's new filename identity.
            $product->save(); //storing values as an object
            return $product; //returns the stored value if the operation was successful.
        }
        return 'please add an image';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Product::findorFail($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorFail($id); //searching for object in database using ID
        $img_path = public_path('storage/uploads/' . $product->image);

        if(File::exists($img_path) && $product->delete()){ //deletes the object
            File::delete($img_path);
            return 'Product deleted successfully'; //shows a message when the delete operation was successful.
        }
        return 'Product not exists.';
    }
}
