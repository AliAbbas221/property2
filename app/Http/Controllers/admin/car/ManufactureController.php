<?php

namespace App\Http\Controllers\admin\car;

use App\Http\Controllers\Controller;
use App\Models\CarManufacture;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ManufactureController extends Controller
{
    public function index()
    {
        return view('admin.cars.manufacture.index');
    }

   

    public function getById($id)
    {
        $manufacture = CarManufacture::findOrFail($id);
        return $manufacture;
    }

    

    public function get_data(Request $request)
    {

        $data = CarManufacture::query();

        return DataTables::eloquent($data)
            ->addColumn('companylogo', function ($data) {
                return '<img src="' . $data->companylogo . '" style="    width: 100px;
                aspect-ratio: 1/1;" />';
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_man(' . $data->carmanufactureid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_man(' . $data->carmanufactureid . ')" class="text-dark p-1"> 
            <i class="fas fa-trash "></i></a></div>';
                return $actionBtn;
            })
            ->rawColumns(['companylogo', 'action'])

            ->make(true);
    }

    public function create(Request $req)
    {
        $data = $req->all();
        // return $data;


        $manufacture = CarManufacture::create([
            'companyname' => $data['name'],
            'companysite' => $data['url'],


        ]);
        if ($req->companylogo) {
            $manufacture->companylogo = $data['companylogo'];
            $manufacture->save();
        }

        return $manufacture;
    }

    public function delete(Request $req)
    {
        $manufacture = CarManufacture::findOrFail($req->id);
        $manufacture->models()->delete();
        $manufacture->delete();


        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;
        $manufacture = CarManufacture::findOrFail($req->id_edit);
        if ($req->photo) {
            $manufacture->companylogo = $req->photo;
            $manufacture->save();
        }
        $manufacture = CarManufacture::where('carmanufactureid', $req->id_edit)
            ->update([
                'companyname' => $data['name_edit'],
                'companysite' => $data['url_edit'],


            ]);

        return $manufacture;
        
    }
}
