<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Property;
use App\Models\Useditem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $p = count(Property::whereNot('is_deleted', 1)->get());
        $c = count(Car::whereNot('is_deleted', 1)->get());
        $i = count(Useditem::whereNot('is_deleted', 1)->get());
        $propertys = Property::latest('publishDate')->whereNot('is_deleted', 1)->take(5)->get();
        $cars = Car::latest('carid')->whereNot('is_deleted', 1)->take(5)->get();
        $items = Useditem::latest('useditemsid')->whereNot('is_deleted', 1)->take(5)->get();
        return view('admin.index', [
            'propertys' => $propertys,
            'cars'=>$cars,
            'items'=>$items,
            'p' => $p, 'c' => $c, 'i' => $i,
            ]);
    }
}
