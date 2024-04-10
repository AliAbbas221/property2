<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarManufacture;
use App\Models\CarOperationType;
use App\Models\CarType;
use App\Models\CarTypeDetail;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Owner;
use App\Models\Property;
use App\Models\PropertyOperationType;
use App\Models\PropertyRegistrationType;
use App\Models\PropertyType;
use App\Models\PropertyTypeDetail;
use App\Models\Useditem;
use App\Models\UseditemType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {

        return view('admin.users.index');
    }

    public function add()
    {

        return view('admin.users.add');
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.users.edit', ['owner' => $owner]);
    }

    public function view($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.users.view', ['owner' => $owner]);
    }


    public function get_data(Request $request)
    {
        $data = Owner::whereNot('is_deleted', 1)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('users')
                    ->whereRaw('users.email = owner.email');
            });


        return DataTables::eloquent($data)
            ->addColumn('photo', function ($data) {
                return '<img src="' . $data->photo . '" style="    width: 100px;
                aspect-ratio: 1/1;" />';
            })

            ->addColumn('action', function ($data) {
                if ($data->isactive == 1) {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                    <a onclick="toggle_active(' . $data->ownerId . ')" class="btn text-dark p-1">                     
                    <i class="fa-solid fa-toggle-on"></i></a>
                    <a href="users/' . $data->ownerId . '/view" class="text-dark p-1"> 
                    <i class="fa-solid fa-eye"></i></a >
                    <a href="users/' . $data->ownerId . '/edit" class="text-dark p-1"> 
                    <i class="fas fa-edit "></i></a>
                    <a href="users/' . $data->ownerId . '/add_post" class="text-dark p-1"> 
                    <i class="fa-solid fa-file-circle-plus"></i></a>                    
                    <a href="#delModal" data-toggle="modal" onclick="opendel_owner(' . $data->ownerId . ')" class="text-dark p-1"> 
                    <i class="fas fa-trash "></i></a></div>';
                } else {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                    <a onclick="toggle_active(' . $data->ownerId . ')" class=" btn text-dark p-1"> 
                    <i class="fa-solid fa-toggle-off"></i></a>
                    <a href="users/' . $data->ownerId . '/view" class="text-dark p-1"> 
                    <i class="fa-solid fa-eye"></i></a >
                <a href="users/' . $data->ownerId . '/edit" class="text-dark p-1"> 
                <i class="fas fa-edit "></i></a>
                <a href="users/' . $data->ownerId . '/add_post" class="text-dark p-1"> 
                <i class="fa-solid fa-file-circle-plus"></i></a>                    
                <a href="#delModal" data-toggle="modal" onclick="opendel_owner(' . $data->ownerId . ')" class="text-dark p-1"> 
                <i class="fas fa-trash "></i></a></div>';
                }
                return $actionBtn;
            })
            ->rawColumns(['photo', 'action'])

            ->make(true);
    }

    public function create(Request $req)
    {
        $data = $req->all();
        // return $data;


        $validator =  Validator::make($data, [
            'firstname' => ['nullable', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'numeric', 'digits_between:8,12'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:owner'],
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000|max:1024',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'mimes'    => 'The :attribute must be of type jpg,png,jpeg,gif,svg only.',
            // 'max'    => 'The :attribute size must be :size.',
            'dimensions' => 'The :attribute dimensions must be at least :min_height*:min_width and maxiamum of :max_width*:max_height ',

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($data);
        }
        $token = bin2hex(random_bytes(16));
        Owner::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'photo' => $data['photo'],
            'token' => $token,
            'isactive' => 1,
            'registerationdate' => Carbon::now()->format('y-m-d'),
            'password' => $data['password'],
        ]);

        return redirect()->to('users')->with(['status' => 'تمت إضافة مستخدم جديد بنجاح']);
    }

    public function delete(Request $req)
    {
        $user = Owner::find($req->id);
        $cars = Car::where('ownerid', $req->id)->get();
        $property = Property::where('ownerId', $req->id)->get();
        $used_items = Useditem::where('ownerid', $req->id)->get();
        //$program=$program->applications();
        if ($cars->isEmpty() &&  $property->isEmpty() && $used_items->isEmpty()) {
            $user->is_deleted = 1;
            $user->save();
            return 'empty';
        }
        if (!$cars->isEmpty() &&  !$property->isEmpty() && !$used_items->isEmpty()) {

            $cars = Car::where('ownerid', $req->id)->update([
                'is_deleted' => 1
            ]);
            $property = Property::where('ownerId', $req->id)->update([
                'is_deleted' => 1
            ]);
            $used_items = Useditem::where('ownerid', $req->id)->update([
                'is_deleted' => 1
            ]);


            $user->is_deleted = 1;
            $user->save();
            return 'empty';
        }
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //  return $data;
        $validator =  Validator::make($data, [
            'firstname' => ['nullable', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'numeric', 'digits_between:8,12'],
            'email' => [
                'required', Rule::unique('users')->ignore($req->id),
            ],
            'photo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000|max:1024',
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'mimes'    => 'The :attribute must be of type jpg,png,jpeg,gif,svg only.',
            // 'max'    => 'The :attribute size must be :size.',
            'dimensions' => 'The :attribute dimensions must be at least :min_height*:min_width and maxiamum of :max_width*:max_height ',

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($data);
        }
        $user = Owner::findOrFail($req->id);
        if ($req->photo) {
            $user->photo = $data['photo'];
            $user->save();
            // $user = Owner::where('ownerId', $req->id)
            //     ->update([
            //         'photo' => $data['photo'],

            //     ]);
        }
        if ($req->password) {
            $user = Owner::where('ownerId', $req->id)
                ->update([

                    'password' => $data['password'],
                ]);
        }
        $user = Owner::where('ownerId', $req->id)
            ->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                //'isactive' => 1,
            ]);
        // return back();
        return redirect()->to('users')->with(['status' => 'تم تعديل المستخدم بنجاح']);
    }


    public function active(Request $req)
    {
        $user = Owner::find($req->id);
        $toggle = $user->isactive;
        if ($toggle == 1)
            $toggle = 0;
        else
            $toggle = 1;

        $cars = Car::where('ownerid', $req->id)->get();
        $property = Property::where('ownerId', $req->id)->get();
        $used_items = Useditem::where('ownerid', $req->id)->get();
        //$program=$program->applications();
        if ($cars->isEmpty() &&  $property->isEmpty() && $used_items->isEmpty()) {
            $user->isactive = $toggle;
            $user->save();
            return 'empty';
        }
        if (!$cars->isEmpty() &&  !$property->isEmpty() && !$used_items->isEmpty()) {

            $cars = Car::where('ownerid', $req->id)->update([
                'isactive' => $toggle
            ]);
            $property = Property::where('ownerId', $req->id)->update([
                'isApproved' => $toggle
            ]);
            $used_items = Useditem::where('ownerid', $req->id)->update([
                'isactive' => $toggle
            ]);


            $user->isactive = $toggle;
            $user->save();
            return 'empty';
        }
    }


    public function getById(Request $req)
    {
        $uni = Owner::find($req->id);

        $features = Owner::find($req->id)->getAttributes()['features'];
        $features = json_decode($features);
        $uni->feature_num = $features;
        //array_push($uni, $features);
        return $uni;
    }

    public function add_post($id)
    {
        $owner = Owner::findOrFail($id);

        return view('admin.users.add_post', ['id' => $id]);
    }

    public function post_form(Request $request)
    {
        if (!($request->has('type') && is_numeric($request->type)))
            return 'No Result';

        if ($request->type == '1') {
            $types = PropertyType::whereNot('is_deleted', 1)->get();
            $registrations = PropertyRegistrationType::whereNot('is_deleted', 1)->get();
            $currency = Currency::get();
            $country = Country::get();
            $operations = PropertyOperationType::whereNot('is_deleted', 1)->get();
            $details = PropertyTypeDetail::get();
            $content = View::make('components.post_form.property-form')->with(['id' => $request->id, 'types' => $types, 'currencys' => $currency, 'countrys' => $country, 'operations' => $operations, 'details' => $details, 'registrations' => $registrations])->render();

            return $content;
        }

        if ($request->type == '2') {
            $types = CarType::get();
            $manufactures = CarManufacture::get();
            $currency = Currency::get();
            $country = Country::get();
            $operations = CarOperationType::get();
            $details = CarTypeDetail::get();
            $content = View::make('components.post_form.car-form')->with(['id' => $request->id, 'types' => $types, 'manufactures' => $manufactures, 'currencys' => $currency, 'countrys' => $country, 'operations' => $operations, 'details' => $details])->render();

            return $content;
        }
        if ($request->type == '3') {
            $types = UseditemType::get();
            $currency = Currency::get();
            $country = Country::get();
            $content = View::make('components.post_form.item-form')->with(['id' => $request->id, 'types' => $types, 'currencys' => $currency, 'countrys' => $country])->render();

            return $content;
        }
    }
}
