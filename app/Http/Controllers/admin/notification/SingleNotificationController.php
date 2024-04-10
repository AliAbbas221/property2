<?php

namespace App\Http\Controllers\admin\notification;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Owner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SingleNotificationController extends Controller
{
    public function index()
    {
        $owners = Owner::whereNot('is_deleted', 1)
            ->where('isactive', 1)->get();
        return view('admin.notification.single', ['owners' => $owners]);
    }



    public function getById($id)
    {
        $type = Notification::findOrFail($id);
        return $type;
    }



    public function get_data(Request $request)
    {

        $data = Notification::with('owner');

        return DataTables::eloquent($data)

            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="#editModal" data-toggle="modal" onclick="getDetails_type(' . $data->notificationsid . ')" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                             
            <a href="#delModal" data-toggle="modal" onclick="opendel_type(' . $data->notificationsid . ')" class="text-dark p-1"> 
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


        $type = Notification::create([

            'title' => $data['title'],
            'body' => $data['body'],
            'senddate' => Carbon::now()->format('y-m-d'),
            'is_read' => 0,
            'ownerid' => $data['owner'],
            'notificationtype' => $data['type'],

        ]);


        return $type;
    }

    public function delete(Request $req)
    {
        //return $req;
        $type = Notification::findOrFail($req->id);
       
        $type->delete();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //return $data;


        $type = Notification::where('notificationsid', $req->id_edit)
            ->update([
                'title' => $data['title_edit'],
                'body' => $data['body_edit'],
                'ownerid' => $data['owner_edit'],
                'notificationtype' => $data['type_edit'],



            ]);

        return $type;
    }
}
