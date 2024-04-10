<?php

namespace App\Http\Controllers\admin\car;

use App\Http\Controllers\Controller;
use App\Models\CarOperationType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OperationController extends Controller
{
    public function index()
    {
       
        return view('admin.cars.operation.index');
    }



    public function getById($id)
    {
        $operation = CarOperationType::findOrFail($id);
        return $operation;
    }



    public function get_data(Request $request)
    {

        $data = CarOperationType::query();

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_operation(' . $data->caroperationtypeid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_operation(' . $data->caroperationtypeid . ')" class="text-dark p-1"> 
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


        $operation = CarOperationType::create([

            'operationtype' => $data['name'],
          

        ]);


        return $operation;
    }

    public function delete(Request $req)
    {
        //return $req;
        $operation = CarOperationType::findOrFail($req->id);
        $operation->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;
        

        $operation = CarOperationType::where('caroperationtypeid', $req->id_edit)
            ->update([
                'operationtype' => $data['name_edit'],
              
            ]);

        return $operation;
    }
}
