<?php

namespace App\Http\Controllers\admin\property;

use App\Http\Controllers\Controller;
use App\Models\PropertyRegistrationType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegistrationController extends Controller
{
    public function index()
    {

        return view('admin.property.registration.index');
    }



    public function getById($id)
    {
        $type = PropertyRegistrationType::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = PropertyRegistrationType::whereNot('is_deleted', 1);

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->property_regestration_type_id . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->property_regestration_type_id . ')" class="text-dark p-1"> 
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


        $type = PropertyRegistrationType::create([

            'name' => $data['name'],
            'is_deleted' => 0,

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = PropertyRegistrationType::findOrFail($req->id);
        $type->is_deleted = 1;
        $type->save();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = PropertyRegistrationType::where('property_regestration_type_id', $req->id_edit)
            ->update([
                'name' => $data['name_edit'],



            ]);

        return $type;
    }
}
