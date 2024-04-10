<?php

namespace App\Http\Controllers\admin\car;

use App\Http\Controllers\Controller;
use App\Models\CarType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index()
    {
       
        return view('admin.cars.type.index');
    }



    public function getById($id)
    {
        $type = CarType::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = CarType::query();

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->cartypeid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->cartypeid . ')" class="text-dark p-1"> 
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


        $type = CarType::create([

            'typename' => $data['name'],
           

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = CarType::findOrFail($req->id);
        $type->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;
        

        $type = CarType::where('cartypeid', $req->id_edit)
            ->update([
                'typename' => $data['name_edit'],
                


            ]);

        return $type;
    }
}
