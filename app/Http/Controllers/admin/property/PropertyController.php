<?php

namespace App\Http\Controllers\admin\property;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Owner;
use App\Models\Property;
use App\Models\PropertyAttachments;
use App\Models\PropertyDetailsValues;
use App\Models\PropertyExtraFields;
use App\Models\PropertyOperationType;
use App\Models\PropertyRegistrationType;
use App\Models\PropertyType;
use App\Models\PropertyTypeDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.property.index');
    }

    public function add()
    {
        $types = PropertyType::whereNot('is_deleted', 1)->get();
        $registrations = PropertyRegistrationType::whereNot('is_deleted', 1)->get();
        $currency = Currency::get();
        $country = Country::get();
        $operations = PropertyOperationType::whereNot('is_deleted', 1)->get();
        $details = PropertyTypeDetail::get();


        return view('admin.property.add', ['types' => $types, 'currencys' => $currency, 'countrys' => $country, 'operations' => $operations, 'details' => $details, 'registrations' => $registrations]);
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $types = PropertyType::whereNot('is_deleted', 1)->get();
        $registrations = PropertyRegistrationType::whereNot('is_deleted', 1)->get();
        $currency = Currency::get();
        $country = Country::get();
        $operations = PropertyOperationType::whereNot('is_deleted', 1)->get();
        $details = PropertyTypeDetail::get();
        $fields = $property->extrafields;
        $ccountry = Country::where('id', $property->city->country->id)->first();
        $citys = City::where('country_id', $ccountry->id)->get();

        return view(
            'admin.property.edit',
            [
                'property' => $property, 'types' => $types,
                'currencys' => $currency, 'registrations' => $registrations,
                'countrys' => $country, 'operations' => $operations,
                'details' => $details, 'fields' => $fields,
                'ccountry' => $ccountry, 'citys' => $citys
            ]
        );
    }

    public function view($id)
    {
        $property = Property::findOrFail($id);
        $types = PropertyType::whereNot('is_deleted', 1)->get();
        $registrations = PropertyRegistrationType::whereNot('is_deleted', 1)->get();
        $currency = Currency::get();
        $country = Country::get();
        $operations = PropertyOperationType::whereNot('is_deleted', 1)->get();
        $details = PropertyTypeDetail::get();
        $fields = $property->extrafields;
        $ccountry = Country::where('id', $property->city->country->id)->first();
        $citys = City::where('country_id', $ccountry->id)->get();


        return view(
            'admin.property.view',
            [
                'property' => $property, 'types' => $types,
                'currencys' => $currency, 'registrations' => $registrations,
                'countrys' => $country, 'operations' => $operations,
                'details' => $details, 'fields' => $fields,
                'ccountry' => $ccountry, 'citys' => $citys
            ]
        );
    }

    public function get_data(Request $request)
    {

        $data = Property::with([
            'attatchments', 'extrafields',
            'details', 'operationtype', 'type', 'registration', 'owner', 'city'
        ])
            ->whereNot('is_deleted', 1);

        return DataTables::eloquent($data)
            ->addColumn('mainphoto', function ($data) {
                return '<img src="' . $data->mainPhoto . '" style="    width: 100px;
                aspect-ratio: 1/1;" />';
            })
            ->addColumn('action', function ($data) {
                if ($data->isApproved == 1) {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                <a onclick="toggle_active(' . $data->propertyId . ')" class="btn text-dark p-1"> 
                
                <i class="fa-solid fa-toggle-on"></i></a>
            <a href="property/' . $data->propertyId . '/edit" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
            <a href="property/' . $data->propertyId . '/view" class="text-dark p-1"> 
            <i class="fa-solid fa-eye"></i></a>                    
            <a href="#delModal" data-toggle="modal" onclick="opendel_property(' . $data->propertyId . ')" class="text-dark p-1"> 
            <i class="fas fa-trash "></i></a></div>';
                } else {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                <a onclick="toggle_active(' . $data->propertyId . ')" class="btn text-dark p-1"> 
                
                <i class="fa-solid fa-toggle-off"></i></a>
            <a href="property/' . $data->propertyId . '/edit" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
            <a href="property/' . $data->propertyId . '/view" class="text-dark p-1"> 
            <i class="fa-solid fa-eye"></i></a>                    
            <a href="#delModal" data-toggle="modal" onclick="opendel_property(' . $data->propertyId . ')" class="text-dark p-1"> 
            <i class="fas fa-trash "></i></a></div>';
                }
                return $actionBtn;
            })
            ->rawColumns(['mainphoto', 'action'])

            ->make(true);
    }

    public function create(Request $req)
    {
        $data = $req->all();
       //  return $data['coordinates'];

        // $validator =  Validator::make($data, []);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput($data);
        // }

        if ($req->id) {
            $owner_id = $req->id;
        } else {
            $owner_id =  Owner::where('email', Auth::user()->email)->first()->ownerId;
        }

        $property = Property::create([
            'title' => $data['title'],
            'publishDate' => Carbon::now()->format('y-m-d'),
            'operationTypeId' => $data['operationtypeid'],
            'propertyTypeId' => $data['typeid'],
            'location' => $data['location'],
            'cityId' => $data['city'],
           // 'coordinates' =>  $data['coordinates'][0] . ',' . $data['coordinates'][1],

            'price' => $data['price'],
            'currency' => $data['currency'],
            //'mainphoto' => $data['mainphoto'],
            'areasize' => $data['areasize'],
            'status' => $data['status'],
            'notes' => $data['notes'],
            'property_regestration_type_id' => $data['registration'],
            'isApproved' => 1,
            'ownerId' => $owner_id,
            'is_deleted'=>0,
            'is_sold'=>0,
            //'sale_date'=>null,
            'sale_price'=>0,
            'old_property_id'=> $data['typeid'],
        ]);

        if ($req->mainphoto) {
            $property->mainphoto = $data['mainphoto'];
            $property->save();
        }
        if ($data['coordinates'][0]!=null) {
            $property->coordinates =  $data['coordinates'][0] . ',' . $data['coordinates'][1];
            $property->save();
        }

        if ($req->attachment) {
            foreach ($req->file('attachment') as $attach) {

                $attachment = new PropertyAttachments;
                $attachment->propertyid = $property->propertyId;
                $attachment->url = $attach;
                $property->attatchments()->save($attachment);
            }
        }
        //   return $property;
        // $property = Property::find(70);
        $details = PropertyTypeDetail::get();
        foreach ($details as $det) {
            $detail = new PropertyDetailsValues;
            $detail->propertyid = $property->propertyId;
            $detail->detailsid = $det->propertytypedetailsid;

            if ($data[$det->propertytypedetailsid] == null) {
                $detail->detailvalue = 'غير مذكور';
            } else
                $detail->detailvalue = $data[$det->propertytypedetailsid];
            $property->attatchments()->save($detail);
        }

        if ($req->labels) {
            foreach ($data['labels'] as $key => $value) {
                $field = new PropertyExtraFields;
                $field->propertyid = $property->propertyId;
                $field->fieldname = $data['labels'][$key];
                $field->fieldvalue = $data['values'][$key];
                $property->extrafields()->save($field);
            }
        }
       
        if ($req->id) {
            return redirect()->to('users')->with(['status' => 'تمت إضافة منشور عقار بنجاح']);
        } else {
            return redirect()->to('property')->with(['status' => 'تمت إضافة المنشور بنجاح']);
        }
    }

    public function delete(Request $req)
    {
        $property = Property::find($req->id);
        // $attatchment = $property->attatchments;
        // $details = $property->details;


        $property->is_deleted = 1;
        $property->save();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        // return $data;

        $property = Property::findOrFail($req->id);
        if ($req->mainphoto) {
            $property->mainPhoto = $data['mainphoto'];
            $property->save();
        }

        if ($req->attachment) {
            foreach ($req->file('attachment') as $attach) {

                $attachment = new PropertyAttachments;
                $attachment->propertyid = $property->propertyId;
                $attachment->url = $attach;
                $property->attatchments()->save($attachment);
            }
        }


        if ($req->del_img != null) {
            $del_img = explode(",", $req->del_img);
            foreach ($del_img as $id) {

                $attachment = PropertyAttachments::findOrfail($id);
                $attachment->delete();
            }
        }


        $details = PropertyTypeDetail::get();
        if (!$property->details->isEmpty()) {
            foreach ($details as $det) {

                $detail = PropertyDetailsValues::where('detailsid', $det->propertytypedetailsid)
                    ->where('propertyid', $req->id)->first();

                $detail->detailvalue = $data[$det->propertytypedetailsid];

                $detail->save();
            }
        }


        if ($req->labels) {
            foreach ($property->extrafields as $key => $value) {
                $value;
                // $field =  PropertyExtraFields::where('detailsid', $det->propertytypedetailsid)
                // ->where('propertyid', $req->id)->first();

                $value->fieldname = $data['labels'][$key];
                $value->fieldvalue = $data['values'][$key];
                $value->save();
                //$property->extrafields()->save($field);
            }
        }

        if ($req->newlabels) {
            foreach ($data['newlabels'] as $key => $value) {
                $field = new PropertyExtraFields;
                $field->propertyid = $property->propertyId;
                $field->fieldname = $data['newlabels'][$key];
                $field->fieldvalue = $data['newvalues'][$key];
                $property->extrafields()->save($field);
            }
        }

        if ($req->del_field != null) {
            $del_field = explode(",", $req->del_field);
            foreach ($del_field as $id) {

                $field = PropertyExtraFields::findOrfail($id);
                $field->delete();
            }
        }

        $property = Property::where('propertyId', $req->id)
            ->update([
                'title' => $data['title'],

                'operationTypeId' => $data['operationtypeid'],
                'propertyTypeId' => $data['typeid'],
                'location' => $data['location'],
                'cityId' => $data['city'],
                'coordinates' =>  $data['coordinates'][0] . ',' . $data['coordinates'][1],

                'price' => $data['price'],
                'currency' => $data['currency'],
                //'mainphoto' => $data['mainphoto'],
                'areasize' => $data['areasize'],
                'status' => $data['status'],
                'notes' => $data['notes'],
                'property_regestration_type_id' => $data['registration'],
            ]);

        // return back();
        return redirect()->to('property')->with(['status' => 'تم تعديل المنشور بنجاح']);
    }

    public function active(Request $req)
    {
        $property = Property::find($req->id);
        $toggle = $property->isApproved;
        if ($toggle == 1)
            $toggle = 0;
        else
            $toggle = 1;



        $property->isApproved = $toggle;
        $property->save();
        return 'empty';
    }
}
