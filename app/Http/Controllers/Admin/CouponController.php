<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('auth.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('auth.coupons.form');
    }

    public function store(CouponRequest $request)
    {
        $params = $request->all();
        foreach(['type', 'only_once'] as $fieldName) {
            if(isset($params[$fieldName])) {
                $params[$fieldName] = 1;
            }
        }

        // if(!$request->has('type')) {
        //     $params['currency_id'] = null;
        // }

        Coupon::create($params);
        return redirect()->route('coupons.index');
    }

    public function show(Coupon $coupon)
    {
        return view('auth.coupons.show', compact('coupon'));
    }

    public function edit(Coupon $coupon)
    {
        return view('auth.coupons.form', compact('coupon'));
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $params = $request->all();
        foreach(['type', 'only_once'] as $fieldName) {
            if(isset($params[$fieldName])) {
                $params[$fieldName] = 1;
            } else {
                $params[$fieldName] = 0;
            }
        }

        // if(!$request->has('type')) {
        //     $params['currency_id'] = null;
        // }

        $coupon->update($params);
        return redirect()->route('coupons.index');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index');
    }
}
