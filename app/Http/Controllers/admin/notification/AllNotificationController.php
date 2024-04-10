<?php

namespace App\Http\Controllers\admin\notification;

use App\Http\Controllers\Controller;
use App\Models\AllNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AllNotificationController extends Controller
{
    public function index()
    {

        return view('admin.notification.all');
    }



    public function getById($id)
    {
        $type = AllNotification::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = AllNotification::query();

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


        $type = AllNotification::create([

            'title' => $data['title'],
            'body' => $data['body'],
            'senddate' => Carbon::now()->format('y-m-d'),
            'is_read' => 0,

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = AllNotification::findOrFail($req->id);
       
        $type->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = AllNotification::where('id', $req->id_edit)
            ->update([
                'title' => $data['title_edit'],
                'body' => $data['body_edit'],


            ]);

        return $type;
    }
}
