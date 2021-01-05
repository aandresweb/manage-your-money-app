<?php

namespace App\Http\Controllers;

use App\Http\Requests\Area\StoreRequest;
use App\Http\Resources\Area\Area as AppArea;
use App\Http\Resources\Area\AreaCollection;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{


    public function index()
    {
        return view('areas.index');
    }

    public function all()
    {
        return new AreaCollection(
            Area::where('user_id', Auth::user()->id)->get()
        );
    }

    public function store(StoreRequest $request)
    {
        $area = Area::create($request->all());
        return new AppArea($area);
    }

    public function delete($id)
    {
        return $area = Area::findOrFail($id)->delete();
    }
}
