<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductImagesController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $file_name = str_replace('.jpeg', '.jpg', $request->image->hashName());
        $request->image->storeAs(Product::TEMP_IMAGE_DIR, $file_name);

        return [
            'data' => $file_name
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
