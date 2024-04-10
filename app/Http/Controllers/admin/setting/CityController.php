<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index()
    {
        $country = Country::get();
        return view('admin.settings.city',['country'=>$country]);
    }



    public function getById($id)
    {
        $type = City::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = City::with('country');

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->cityId . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->cityId . ')" class="text-dark p-1"> 
            <i class="fas fa-trash "></i></a></div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])

            ->make(true);
    }

    public function create(Request $req)
    {
        $data = $req->all();
        // return $data;


        $type = City::create([

            'name' => $data['name'],
            'country_id' => $data['country'],

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = City::findOrFail($req->id);

        $type->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = City::where('cityId', $req->id_edit)
            ->update([
                'name' => $data['name_edit'],
                'country_id' => $data['country_edit'],


            ]);

        return $type;
    }
}
