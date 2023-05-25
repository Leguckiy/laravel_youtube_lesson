<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{

    public function index()
    {
        $merchants = Merchant::paginate(10);
        return view('auth.merchants.index', compact('merchants'));
    }

    public function create()
    {
        return view('auth.merchants.form');
    }

    public function store(Request $request)
    {
        Merchant::create($request->all());
        return redirect()->route('merchants.index');
    }

    public function show(Merchant $merchant)
    {
        return view('auth.merchants.show', compact('merchant'));
    }

    public function edit(Merchant $merchant)
    {
        return view('auth.merchants.form', compact('merchant'));
    }

    public function update(Request $request, Merchant $merchant)
    {
        $merchant->update($request->all());
        return redirect()->route('merchants.index');
    }

    public function destroy(Merchant $merchant)
    {
        $merchant->delete();
        return redirect()->route('merchants.index');
    }

    public function updateToken(Merchant $merchant)
    {
        $token = $merchant->createToken();
        session()->flash('success', 'Ваш токен ' . $token);

        return redirect()->route('merchants.index');
    }
}
