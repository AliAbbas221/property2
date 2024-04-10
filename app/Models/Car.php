<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class Car extends Model
{
    use HasFactory;
    protected $table = 'car';
    protected $primaryKey = 'carid';
    public  $timestamps = false;
    protected $guarded = [];



    public function mainphoto(): Attribute
    {
        return Attribute::make(function ($value) {
            return $value;
        });
    }

    // public function mainphoto(): Attribute
    // {

    //     return Attribute::make(
    //         get: fn ($value) =>URL::asset( $value),

    //     );
    // }


    /*****************Relations*************/

    public function attatchments()
    {
        return $this->hasMany(CarAttatchment::class, 'carid', 'carid');
    }

    public function details()
    {
        return $this->belongsToMany(CarTypeDetail::class, 'cardetails', 'carid', 'detailsid')->withPivot('value');
    }

    public function manufacture()
    {
        return $this->belongsTo(CarManufacture::class, 'carmanufactureid', 'carmanufactureid');
    }

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'modelid', 'carmodelid');
    }

    public function operationtype()
    {
        return $this->belongsTo(CarOperationType::class, 'operationtypeid', 'caroperationtypeid');
    }

    public function type()
    {
        return $this->belongsTo(CarType::class, 'cartypeid', 'cartypeid');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'ownerid', 'ownerId');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cityid', 'cityId');
    }
}
