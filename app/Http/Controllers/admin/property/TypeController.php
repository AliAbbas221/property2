<?php

namespace App\Http\Controllers\admin\property;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index()
    {

        return view('admin.property.type.index');
    }



    public function getById($id)
    {
        $type = PropertyType::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = PropertyType::whereNot('is_deleted', 1);

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->property_type_id . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->property_type_id . ')" class="text-dark p-1"> 
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


        $type = PropertyType::create([

            'typename' => $data['name'],
            'is_deleted' => 0,

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = PropertyType::findOrFail($req->id);
        $type->is_deleted = 1;
        $type->save();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = PropertyType::where('property_type_id', $req->id_edit)
            ->update([
                'typename' => $data['name_edit'],



            ]);

        return $type;
    }
}
