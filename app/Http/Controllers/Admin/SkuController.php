<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Product;
use App\Models\Sku;

class SkuController extends Controller
{

    public function index(Product $product)
    {
        $skus = $product->skus()->paginate(10);
        return view('auth.skus.index', compact('skus', 'product'));
    }

    public function create(Product $product)
    {
        return view('auth.skus.form', compact('product'));
    }

    public function store(SkuRequest $request, Product $product)
    {
        $params = $request->all();
        $params['product_id'] = $product->id;

        $sku = Sku::create($params);
        $sku->propertyOptions()->sync($request->property_id);

        return redirect()->route('skus.index', $product);
    }

    public function show(Product $product, Sku $sku)
    {
        return view('auth.skus.show', compact('product', 'sku'));
    }

    public function edit(Product $product, Sku $sku)
    {
        return view('auth.skus.form', compact('product', 'sku'));
    }

    public function update(SkuRequest $request, Product $product, Sku $sku)
    {
        $params = $request->all();
        $params['product_id'] = $product->id;

        $sku->update($params);
        $sku->propertyOptions()->sync($request->property_id);

        return redirect()->route('skus.index', $product);
    }

    public function destroy(Product $product, Sku $sku)
    {
        $sku->delete();

        return redirect()->route('skus.index', $product);
    }
}
