<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;
use App\Models\Property;
use App\Models\PropertyOption;

class PropertyOptionController extends Controller
{

    public function index(Property $property)
    {
        // $propertyOptions = PropertyOption::paginate(10);
        $propertyOptions = $property->propertyOptions()->paginate(10);
        return view('auth.property_options.index', compact('propertyOptions', 'property'));
    }

    public function create(Property $property)
    {
        return view('auth.property_options.form', compact('property'));
    }

    public function store(PropertyOptionRequest $request, Property $property)
    {
        $params = $request->all();
        $params['property_id'] = $request->property->id;

        PropertyOption::create($params);
        return redirect()->route('property-options.index', $property);
    }

    public function show(Property $property, PropertyOption $propertyOption)
    {
        return view('auth.property_options.show', compact('propertyOption'));
    }

    public function edit(Property $property, PropertyOption $propertyOption)
    {
        return view('auth.property_options.form', compact('property', 'propertyOption'));
    }

    public function update(PropertyOptionRequest $request, Property $property, PropertyOption $propertyOption)
    {
        $propertyOption->update($request->all());
        return redirect()->route('property-options.index', $property);
    }

    public function destroy(Property $property, PropertyOption $propertyOption)
    {
        $propertyOption->delete();
        return redirect()->route('property-options.index', $property);
    }
}
