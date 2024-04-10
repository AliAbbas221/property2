<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index()
    {

        return view('admin.settings.country');
    }



    public function getById($id)
    {
        $type = Country::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = Country::query();

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->id . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->id . ')" class="text-dark p-1"> 
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


        $type = Country::create([

            'country_name' => $data['name'],


        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = Country::findOrFail($req->id);

        $type->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = Country::where('id', $req->id_edit)
            ->update([
                'country_name' => $data['name_edit'],



            ]);

        return $type;
    }
}
