<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Product;
use Psy\Readline\Hoa\Protocol;

class MainController extends Controller
{
    public function index(ProductsFilterRequest $request)
    {
        // $productsQuery = Product::query();
        $productsQuery = Product::with('category'); // объединяет множество одинаковых запросов в один

        if($request->filled('price_from')) {
            $productsQuery->where('price', '>=', $request->price_from);
        }

        if($request->filled('price_to')) {
            $productsQuery->where('price', '<=', $request->price_to);
        }

        foreach(['hit', 'new', 'recommend'] as $field) {
            if($request->has($field)) {
                // $productsQuery->where($field, 1);
                // заменяет предыдущую строку. Вызов метода hit() делает вызов метода из модели scopeHit()
                $productsQuery->$field();
            }
        }

        $method = 'withPath';
        $products = $productsQuery->paginate(6)->$method($request->fullUrl());

        return view('index', compact('products'));
    }

    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->first();
        return view('product', compact('product'));
    }
}
