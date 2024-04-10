<?php

namespace App\Http\Controllers\admin\item;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Owner;
use App\Models\Useditem;
use App\Models\UseditemAttachment;
use App\Models\UseditemType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ItemsController extends Controller
{
    public function index()
    {
        return view('admin.used_items.index');
    }

    public function add()
    {
        $types = UseditemType::get();
        $currency = Currency::get();
        $country = Country::get();

        return view('admin.used_items.add', ['types' => $types, 'currencys' => $currency, 'countrys' => $country]);
    }

    public function edit($id)
    {
        $item = Useditem::findOrFail($id);
        $types = UseditemType::get();

        $currency = Currency::get();
        $country = Country::get();

        $ccountry = Country::where('id', $item->city->country->id)->first();
        $citys = City::where('country_id', $ccountry->id)->get();

        return view(
            'admin.used_items.edit',
            [
                'item' => $item, 'types' => $types,
                'currencys' => $currency, 'countrys' => $country,
                'ccountry' => $ccountry, 'citys' => $citys
            ]
        );
    }

    public function view($id)
    {
        $item = Useditem::findOrFail($id);
        $types = UseditemType::get();

        $currency = Currency::get();
        $country = Country::get();

        $ccountry = Country::where('id', $item->city->country->id)->first();
        $citys = City::where('country_id', $ccountry->id)->get();


        return view(
            'admin.used_items.view',
            [
                'item' => $item, 'types' => $types,
                'currencys' => $currency, 'countrys' => $country,
                'ccountry' => $ccountry, 'citys' => $citys
            ]
        );
    }

    public function get_data(Request $request)
    {

        $data = Useditem::with([
            'attatchments', 'type', 'owner'
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
                <a onclick="toggle_active(' . $data->useditemsid . ')" class="btn text-dark p-1"> 
                
                <i class="fa-solid fa-toggle-on"></i></a>
            <a href="items/' . $data->useditemsid  . '/edit" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
            <a href="items/' . $data->useditemsid  . '/view" class="text-dark p-1"> 
            <i class="fa-solid fa-eye"></i></a>                    
            <a href="#delModal" data-toggle="modal" onclick="opendel_item(' . $data->useditemsid  . ')" class="text-dark p-1"> 
            <i class="fas fa-trash "></i></a></div>';
                } else {
                    $actionBtn = '<div style="display:flex; justify-content: space-between;">
                <a onclick="toggle_active(' . $data->useditemsid . ')" class="btn text-dark p-1"> 
                
                <i class="fa-solid fa-toggle-off"></i></a>
            <a href="items/' . $data->useditemsid  . '/edit" class="text-dark p-1"> 
            <i class="fas fa-edit "></i></a>
            <a href="items/' . $data->useditemsid  . '/view" class="text-dark p-1"> 
            <i class="fa-solid fa-eye"></i></a>                    
            <a href="#delModal" data-toggle="modal" onclick="opendel_item(' . $data->useditemsid  . ')" class="text-dark p-1"> 
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
        //  return $data;



        // $validator =  Validator::make($data, []);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput($data);
        // }

        if ($req->id) {
            $owner_id = $req->id;
        } else {
            $owner_id =  Owner::where('email', Auth::user()->email)->first()->ownerId;
        }

        $item = Useditem::create([
            'title' => $data['title'],
            'itemtypeid' => $data['typeid'],
            'addeddate' => Carbon::now(),
            'price' => $data['price'],
            'currency' => $data['currency'],
            //'mainphoto' => $data['mainphoto'],
            'description' => $data['description'],
            'dimensions' => $data['dimensions'],
            'city_id' => $data['city'],
            'isactive' => 1,
            'ownerid' => $owner_id,
            'is_deleted' => 0,
        ]);
        if ($req->mainphoto) {
            $item->mainphoto = $data['mainphoto'];
            $item->save();
        }
        if ($req->attachment) {
            foreach ($req->file('attachment') as $attach) {

                $attachment = new UseditemAttachment;
                $attachment->useditem_id = $item->useditemsid;
                $attachment->url = $attach;
                $item->attatchments()->save($attachment);
            }
        }


        if ($req->id) {
            return redirect()->to('users')->with(['status' => 'تمت إضافة منشور غرض مستعمل بنجاح']);
        } else {
            return redirect()->to('items')->with(['status' => 'تم إضافة غرض جديد بنجاح']);
        }
    }

    public function delete(Request $req)
    {
        $item = Useditem::find($req->id);
        // $attatchment = $item->attatchments;
        // $details = $item->details;


        $item->is_deleted = 1;
        $item->save();
        return 'empty';
    }

    public function update(Request $req)
    {
        $data = $req->all();
        //   return $data;

        $item = Useditem::findOrFail($req->id);
        if ($req->mainphoto) {
            $item->mainphoto = $data['mainphoto'];
            $item->save();
        }

        if ($req->attachment) {
            foreach ($req->file('attachment') as $attach) {

                $attachment = new UseditemAttachment;
                $attachment->useditem_id = $item->useditemsid;
                $attachment->url = $attach;
                $item->attatchments()->save($attachment);
            }
        }
        //return   'h';

        if ($req->del_img != null) {
            $del_img = explode(",", $req->del_img);
            foreach ($del_img as $id) {

                $attachment = UseditemAttachment::findOrfail($id);
                $attachment->delete();
            }
        }



        $item = Useditem::where('useditemsid', $req->id)
            ->update([
                'title' => $data['title'],
                'itemtypeid' => $data['typeid'],
                'price' => $data['price'],
                'currency' => $data['currency'],
                //'mainphoto' => $data['mainphoto'],
                'description' => $data['description'],
                'dimensions' => $data['dimensions'],
                'city_id' => $data['city'],
                //  'isactive' => 1,

            ]);
        //  return back();
        return redirect()->to('items')->with(['status' => 'تم تعديل المنشور بنجاح']);
    }

    public function active(Request $req)
    {
        $item = Useditem::find($req->id);
        $toggle = $item->isactive;
        if ($toggle == 1)
            $toggle = 0;
        else
            $toggle = 1;



        $item->isactive = $toggle;
        $item->save();
        return 'empty';
    }
}
