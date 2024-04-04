<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\product\ProductStoreRequest;
use App\DataTables\productDataTable;


class ProductAdminController extends Controller
{
    public function index(productDataTable $dataTable){
  
        return $dataTable->render("Admin.product.showProduct");
    }
    public function create()
    {
        return view('Admin.product.addProduct');
    }

    public function store(ProductStoreRequest $request)
    {
        $data = $request->validated();

        $imagePath = $data['image']->store('uploads', 'public');
    
        auth()->user()->product()->create([
            'user_id' => $data['caption'],
            'caption' => $data['caption'],
            'discription' => $data['discription'],
            'image' => $imagePath,
        ]);

        return redirect('/dashbord');
    }
    public function edit(Product $product, Request $request, $id){
        $product = Product::find($id);
       return view ('Admin.product.editProduct',compact('product'));
    }
    public function update(ProductStoreRequest $request,$id)
    {
        $product = Product::find($id);
        $data = $request->validated();
        $product->update(array_merge(
            $data,
        ));
        return redirect("/dashbord");
    }
    public function destroy($id){

        $product = Product::find($id);
        $product->delete();
        return redirect('/dashbord');
    }
}
