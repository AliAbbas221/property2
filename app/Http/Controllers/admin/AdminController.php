<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Owner;
use App\Models\Property;
use App\Models\Useditem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.admins.index');
    }

    public function add()
    {

        return view('admin.admins.add');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.admins.edit', ['user' => $user]);
    }



    public function get_data(Request $request)
    {
        $data = User::query();


        return DataTables::eloquent($data)
            ->addColumn('action', function ($data) {
                $actionBtn = '<div style="display:flex; justify-content: space-around;">
            <a href="admins/' . $data->id . '/edit" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
                         
            <a href="#delModal" data-toggle="modal" onclick="opendel_admin(' . $data->id . ')" class="text-dark p-1"> 
            <i class="fas fa-trash "></i></a></div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])

            ->make(true);
    }

    public function create(Request $req)
    {
        $data = $req->all();
        //return $data;

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($data);
        }
        Owner::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
       $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->attachRole('admin');
        return redirect()->to('admins')->with(['status' => 'تمت إضافة مشرف جديد']);
    }

    public function delete(Request $req)
    {
        $admin = User::findOrfail($req->id);
        $user =  Owner::where('email', $admin->email)->first();
        $cars = Car::where('ownerid', $user->ownerId)->get();
        $property = Property::where('ownerId', $user->ownerId)->get();
        $used_items = Useditem::where('ownerid', $user->ownerId)->get();
        //$program=$program->applications();
        if ($cars->isEmpty() &&  $property->isEmpty() && $used_items->isEmpty()) {
            $user->is_deleted = 1;
            $user->save();
            $admin->delete();
            return 'empty';
        }
        if (!$cars->isEmpty() &&  !$property->isEmpty() && !$used_items->isEmpty()) {

            $cars = Car::where('ownerid', $user->ownerId)->update([
                'is_deleted' => 1
            ]);
            $property = Property::where('ownerId', $user->ownerId)->update([
                'is_deleted' => 1
            ]);
            $used_items = Useditem::where('ownerid', $user->ownerId)->update([
                'is_deleted' => 1
            ]);


            $user->is_deleted = 1;
            $user->save();
            $admin->delete();
            return 'empty';
        }
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //  return $data;
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($req->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($data);
        }
        $admin = User::findOrfail($req->id);
        $owner_id =  Owner::where('email', $admin->email)->first()->ownerId;

        if ($req->password) {
            $user = User::where('id', $req->id)
                ->update([

                    'password' => Hash::make($data['password']),
                ]);
            $owner = Owner::where('ownerId', $owner_id)
                ->update([
                    'password' => Hash::make($data['password']),
                    //'isactive' => 1,
                ]);
        }
        $owner = Owner::where('ownerId', $owner_id)
            ->update([
                'email' => $data['email'],
                //'isactive' => 1,
            ]);
        $user = User::where('id', $req->id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],

            ]);
        // return back();
        return redirect()->to('admins')->with(['status' => 'تم تعديل المشرف بنجاح']);
    }
}
