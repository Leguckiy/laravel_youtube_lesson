<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        return view('categories');
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
        return view('category', compact('category'));
    }

    public function product($category, $productCode)
    {
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        return view('product', compact('product'));
    }

    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо мы сообщим вам о поступлении товара');
    }

    public function changeLocale($locale)
    {
        $availableLocales = ['ru', 'en'];
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();

        session(['currency' => $currency->code]);

        return redirect()->back();
    }
}
