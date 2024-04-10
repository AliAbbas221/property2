<?php

namespace App\Http\Controllers\admin\car;
use App\Http\Controllers\imageuploadfile;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarAttatchment;
use App\Models\CarDetail;
use App\Models\CarManufacture;
use App\Models\CarModel;
use App\Models\CarOperationType;
use App\Models\CarType;
use App\Models\CarTypeDetail;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Owner;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CarController extends Controller
{use imageuploadfile;
    public function index()
    {
        return view('admin.cars.index');
    }

    public function add()
    {
        $types = CarType::get();
        $manufactures = CarManufacture::get();
        $currency = Currency::get();
        $country = Country::get();
        $operations = CarOperationType::get();
        $details = CarTypeDetail::get();


        return view('admin.cars.add', ['types' => $types, 'manufactures' => $manufactures, 'currencys' => $currency, 'countrys' => $country, 'operations' => $operations, 'details' => $details]);
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $types = CarType::get();
        $manufactures = CarManufacture::get();
        $currency = Currency::get();
        $country = Country::get();
        $operations = CarOperationType::get();
        $details = CarTypeDetail::get();
        $models = CarModel::where('manufactureid', $car->carmanufactureid)->get();
        $ccountry = Country::where('id', $car->city->country->id)->first();
        $citys = City::where('country_id', $ccountry->id)->get();

        return view(
            'admin.cars.edit',
            [
                'car' => $car, 'types' => $types,
                'manufactures' => $manufactures, 'currencys' => $currency,
                'countrys' => $country, 'operations' => $operations,
                'details' => $details, 'models' => $models,
                'ccountry' => $ccountry, 'citys' => $citys
            ]
        );
    }

    public function view($id)
    {

        $car = Car::with('owner')->findOrFail($id);
        $types = CarType::get();
        $manufactures = CarManufacture::get();
        $currency = Currency::get();
        $country = Country::get();
        $operations = CarOperationType::get();
        $details = CarTypeDetail::get();
        $models = CarModel::where('manufactureid', $car->carmanufactureid)->get();
        $ccountry = Country::where('id', $car->city->country->id)->first();
        $citys = City::where('country_id', $ccountry->id)->get();
        return view(
            'admin.cars.view',
            [
                'car' => $car, 'types' => $types,
                'manufactures' => $manufactures, 'currencys' => $currency,
                'countrys' => $country, 'operations' => $operations,
                'details' => $details, 'models' => $models,
                'ccountry' => $ccountry, 'citys' => $citys
            ]
        );
    }

    public function get_data(Request $request)
    {

        $data = Car::with([
            'attatchments',
            'details', 'manufacture', 'model', 'operationtype', 'type', 'owner'
        ])
            ->whereNot('is_deleted', 1);

        return DataTables::eloquent($data)
            ->addColumn('mainphoto', function ($data) {
                return '<img src="' . $data->mainphoto . '" style="    width: 100px;
                aspect-ratio: 1/1;" />';
            })
            ->addColumn('action', function ($data) {

                if ($data->isactive == 1) {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                    <a onclick="toggle_active(' . $data->carid . ')" class="btn text-dark p-1">

                    <i class="fa-solid fa-toggle-on"></i></a>
                    <a href="cars/' . $data->carid . '/edit" class="text-dark p-1">
                    <i class="fas fa-edit "></i></a>
                    <a href="cars/' . $data->carid . '/view" class="text-dark p-1">
                    <i class="fa-solid fa-eye"></i></a>
                    <a href="#delModal" data-toggle="modal" onclick="opendel_car(' . $data->carid . ')" class="text-dark p-1">
                     <i class="fas fa-trash "></i></a></div>';
                } else {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                    <a onclick="toggle_active(' . $data->carid . ')" class=" btn text-dark p-1">

                    <i class="fa-solid fa-toggle-off"></i></a>
                    <a href="cars/' . $data->carid . '/edit" class="text-dark p-1">
                    <i class="fas fa-edit "></i></a>
                    <a href="cars/' . $data->carid . '/view" class="text-dark p-1">
                    <i class="fa-solid fa-eye"></i></a>
                    <a href="#delModal" data-toggle="modal" onclick="opendel_car(' . $data->carid . ')" class="text-dark p-1">
                    <i class="fas fa-trash "></i></a></div>';
                }


                //     $actionBtn = '<div style="display:flex; justify-content: space-between;">
                // <a href="cars/' . $data->carid . '/edit" class="text-dark p-1">
                // <i class="fas fa-edit "></i></a>
                // <a href="cars/' . $data->carid . '/view" class="text-dark p-1">
                // <i class="fa-solid fa-eye"></i></a>
                // <a href="#delModal" data-toggle="modal" onclick="opendel_car(' . $data->carid . ')" class="text-dark p-1">
                // <i class="fas fa-trash "></i></a></div>';
                return $actionBtn;
            })
            ->rawColumns(['mainphoto', 'action'])

            ->make(true);
    }

    public function create(Request $req)
    {
        $data = $req->all();
        // return $data;
        // return $data["detail1"];


        // $validator =  Validator::make($data, []);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput($data);
        // }
        if ($req->id) {
            $owner_id = $req->id;
        } else {
            $owner_id =  Owner::where('email', Auth::user()->email)->first()->ownerId;
        }
        $carimage = $data['mainphoto'];
        $result =$this->upload($carimage);

        $car = Car::create([
            'cartitle' => $data['cartitle'],
            'cartypeid' => $data['cartypeid'],
            'carmanufactureid' => $data['manufacture'],
            'modelid' => $data['model'],
            'manufactureyear' => $data['manufactureyear'],
            'registeryear' => $data['registeryear'],
            'km' => $data['km'],
            'price' => $data['price'],
            'currency' => $data['currency'],
            'mainphoto' => $result,
            'descriptions' => $data['description'],
            'operationtypeid' => $data['operation'],
            'cityid' => $data['city'],
            'address' => $data['address'],
            'isactive' => 1,
            'ownerid' => $owner_id,
            'is_deleted'=>0,
            'is_sold'=>0,
            //'sale_date'=>0000-00-00,
            'sale_price'=>0,
        ]);


        if ($req->attachment) {
            foreach ($req->file('attachment') as $attach) {

                $attachment = new CarAttatchment;
                $attachment->carid = $car->carid;
                $attachment->attachmentlink = $attach;
                $car->attatchments()->save($attachment);
            }
        }
        $details = CarTypeDetail::get();
        foreach ($details as $det) {
            $detail = new CarDetail;
            $detail->carid = $car->carid;
            $detail->detailsid = $det->detailsid;

            if ($data[$det->detailsid] == null) {
                $detail->value = 'غير مذكور';
            } else
                $detail->value = $data[$det->detailsid];
            $car->attatchments()->save($detail);
        }

        if ($req->id) {
            return redirect()->to('users')->with(['status' => 'تمت إضافة منشور سيارة بنجاح']);
        } else {
            return redirect()->to('cars')->with(['status' => 'تمت إضافة المنشور بنجاح']);
        }
    }

    public function delete(Request $req)
    {
        $car = Car::find($req->id);
        // $attatchment = $car->attatchments;
        // $details = $car->details;


        $car->is_deleted = 1;
        $car->save();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //  return $data;

        $car = Car::findOrFail($req->id);
        if ($req->mainphoto) {
            $car->mainphoto = $data['mainphoto'];
            $car->save();
        }

        if ($req->attachment) {
            foreach ($req->file('attachment') as $attach) {

                $attachment = new CarAttatchment;
                $attachment->carid = $car->carid;
                $attachment->attachmentlink = $attach;
                $car->attatchments()->save($attachment);
            }
        }
        //return   'h';

        if ($req->del_img != null) {
            $del_img = explode(",", $req->del_img);
            foreach ($del_img as $id) {

                $attachment = CarAttatchment::findOrfail($id);
                $attachment->delete();
            }
        }


        $details = CarTypeDetail::get();
        foreach ($car->details as $det) {

            $detail = CarDetail::where('detailsid', $det->detailsid)
                ->where('carid', $req->id)->first();
            // $detail->carid = $car->carid;
            // $detail->detailsid = $det->detailsid;
            $detail->value = $data[$det->detailsid];
            $detail->save();
            // if ($data[$det->detailsid] == null) {
            //     $detail->value = 'غير مذكور';
            // } else
            //     $detail->value = $data[$det->detailsid];
            //$car->attatchments()->save($detail);
        }

        $car = Car::where('carId', $req->id)
            ->update([
                'cartitle' => $data['cartitle'],
                'cartypeid' => $data['cartypeid'],
                'carmanufactureid' => $data['manufacture'],
                'modelid' => $data['model'],
                'manufactureyear' => $data['manufactureyear'],
                'registeryear' => $data['registeryear'],
                'km' => $data['km'],
                'price' => $data['price'],
                'currency' => $data['currency'],
                'mainphoto' =>$data['mainphoto'],
                //'mainphoto' => $data['mainphoto'],
                'descriptions' => $data['description'],
                'operationtypeid' => $data['operation'],
                'cityid' => $data['city'],
                'address' => $data['address'],
                //'isactive' => 1,
            ]);
        //return back();
        return redirect()->to('cars')->with(['status' => 'تم تعديل المنشور بنجاح']);
    }

    public function active(Request $req)
    {
        $car = Car::find($req->id);
        $toggle = $car->isactive;
        if ($toggle == 1)
            $toggle = 0;
        else
            $toggle = 1;



        $car->isactive = $toggle;
        $car->save();
        return 'empty';
    }

    public function modelByManufacture($id)
    {

        $models = CarModel::where('manufactureid', $id)->get();


        return $models;
    }

    public function cityByCountry($id)
    {

        $citys = City::where('country_id', $id)->get();
        return $citys;
    }
}
