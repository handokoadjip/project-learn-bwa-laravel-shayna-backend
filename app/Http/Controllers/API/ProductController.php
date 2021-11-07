<?php

namespace App\Http\Controllers\API;

use App\Product;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->id;
        $limit = $request->input('limit', 5);
        $name = $request->name;
        $slug = $request->slug;
        $type = $request->type;
        $price_from = $request->price_from;
        $price_to = $request->price_to;

        if ($id) {
            $product = Product::with('galleries')->find($id);
            return $this->_utilityCheck($product, 'id', $id);
        }

        if ($slug) {
            $product = Product::with('galleries')->where('slug', $slug)->first();
            return $this->_utilityCheck($product, 'slug', $slug);
        }

        $product = Product::with('galleries');

        if ($name)
            $product->where('name', 'LIKE', "%$name%");

        if ($type)
            $product->where('type', 'LIKE', "%$type%");

        if ($price_from)
            $product->where('price', '>=', $price_from);

        if ($price_to)
            $product->where('price', '<=', $price_to);

        return ResponseFormatter::success(
            200,
            'The data is successfully retrieved',
            $product->paginate($limit)
        );
    }

    public function _utilityCheck($product, $type, $search)
    {
        if ($product)
            return ResponseFormatter::success(200, 'The data is successfully retrieved', $product);
        else
            return ResponseFormatter::error(404, "Data with $type = $search not found", null);
    }
}
