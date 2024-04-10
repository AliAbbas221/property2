<?php

namespace App\Http\Controllers\admin\car;

use App\Http\Controllers\Controller;
use App\Models\CarManufacture;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ModelController extends Controller
{
    public function index()
    {
        $manufacture = CarManufacture::get();
        return view('admin.cars.model.index', ['manufacture' => $manufacture]);
    }



    public function getById($id)
    {
        $model = CarModel::findOrFail($id);
        return $model;
    }



    public function get_data(Request $request)
    {

        $data = CarModel::with('manufacture');

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_model(' . $data->carmodelid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_model(' . $data->carmodelid . ')" class="text-dark p-1"> 
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


        $model = CarModel::create([

            'modelname' => $data['name'],
            'manufactureid' => $data['manufacture'],

        ]);


        return $model;
    }

    public function delete(Request $req)
    {
        //return $req;
        $model = CarModel::findOrFail($req->id);
        $model->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;
        

        $model = CarModel::where('carmodelid', $req->id_edit)
            ->update([
                'modelname' => $data['name_edit'],
                'manufactureid' => $data['manufacture_edit'],


            ]);

        return $model;
    }
}
