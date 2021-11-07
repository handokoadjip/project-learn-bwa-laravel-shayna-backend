<?php

namespace App\Http\Controllers\Admin;

use App\ProductGallery;
use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGalleryRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// dependency
use RealRashid\SweetAlert\Facades\Alert;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
        header("Pragma: no-cache"); // HTTP 1.0.
        header("Expires: 0 ");

        $data = [
            'galleries' => ProductGallery::all()
        ];

        return view('pages.admin.product-galleries.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'products' => Product::pluck('name', 'id')
        ];

        return view('pages.admin.product-galleries.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $data['image'] = Storage::disk('public')->putFile(
            'assets/image/product',
            $request->file('image')
        );

        ProductGallery::create($data);

        Alert::toast('Gallery succesfully added', 'success');
        return redirect()->route('product-galleries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGallery $productGallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductGallery  $productGallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGallery $productGallery)
    {
        // NOTED HANYA UNTUK DELETE DI SOFT DELETE
        // $arr = preg_split("/\//", $productGallery->image);

        // for ($i = 4; $i < count($arr); $i++) {
        //      $paths[] = $arr[$i];
        // };

        // Storage::delete('public/' . join('/', $paths));

        ProductGallery::destroy($productGallery->id);

        Alert::toast('Gallery succesfully deleted', 'success');
        return back();
    }
}
