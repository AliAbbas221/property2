<?php

namespace App\Http\Controllers\admin\item;

use App\Http\Controllers\Controller;
use App\Models\UseditemType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{
    public function index()
    {
       
        return view('admin.used_items.type.index');
    }



    public function getById($id)
    {
        $type = UseditemType::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = UseditemType::query();

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->useditemtypeid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->useditemtypeid . ')" class="text-dark p-1"> 
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


        $type = UseditemType::create([

            'usedtypename' => $data['name'],
           

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = UseditemType::findOrFail($req->id);
        $type->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;
        

        $type = UseditemType::where('useditemtypeid', $req->id_edit)
            ->update([
                'usedtypename' => $data['name_edit'],
                


            ]);

        return $type;
    }
}
