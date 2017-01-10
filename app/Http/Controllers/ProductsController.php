<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller {

    private $product_fields = ['name', 'description', 'quantities', 'options'];

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        $result = ['data' => Product::orderByRaw('TRIM(LEADING \'"\' FROM name)')->get()];

        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->only($this->product_fields));

        $this->move_image($product, $request->get('image'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        $result = ['data' => Product::find($id)];

        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->only($this->product_fields));
        $this->move_image($product, $request->get('image'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
    }

    private function move_image(Product $product, $image)
    {

        $temp_image_path = Product::TEMP_IMAGE_DIR . '/' . $image;

        if (Storage::exists($temp_image_path)) {

            $temp_image_info = new \SplFileInfo($temp_image_path);
            $perm_image_path = $product->getImagePath($temp_image_info->getExtension());

            if (Storage::exists($perm_image_path)) {
                Storage::delete($perm_image_path);
            }

            Storage::move($temp_image_path, $perm_image_path);
        }

    }

}
