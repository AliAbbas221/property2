<?php

namespace App\Http\Controllers\admin\property;

use App\Http\Controllers\Controller;
use App\Models\PropertyOperationType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OperationController extends Controller
{
    public function index()
    {

        return view('admin.property.operation.index');
    }



    public function getById($id)
    {
        $type = PropertyOperationType::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = PropertyOperationType::whereNot('is_deleted', 1);

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_operation(' . $data->propertyoperationtypeid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_operation(' . $data->propertyoperationtypeid . ')" class="text-dark p-1"> 
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


        $type = PropertyOperationType::create([

            'operationtypename' => $data['name'],
            'is_deleted' => 0,

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = PropertyOperationType::findOrFail($req->id);
        $type->is_deleted = 1;
        $type->save();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = PropertyOperationType::where('propertyoperationtypeid', $req->id_edit)
            ->update([
                'operationtypename' => $data['name_edit'],



            ]);

        return $type;
    }
}
