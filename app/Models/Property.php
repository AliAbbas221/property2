<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Property extends Model
{
    use HasFactory;
    protected $table = 'property';
    protected $primaryKey = 'propertyId';
    public  $timestamps = false;
    protected $guarded = [''];





    public function mainPhoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function ($file) {
                if (is_string($file)) {
                    return URL::asset($file);
                } else {
                    $file_name = time() . '_' . $file->getClientOriginalName();
                    $path = "images/properties/" ;
                    $file_full_name = $path  . $file_name;
                    $file->storeAs($path, $file_name,'public');

                    return asset('storage/' . $file_full_name);
                }
            }
        );
    }


    /*****************Relations*************/

    public function attatchments()
    {
        return $this->hasMany(PropertyAttachments::class, 'propertyid', 'propertyId');
    }

    public function extrafields()
    {
        return $this->hasMany(PropertyExtraFields::class, 'propertyid', 'propertyId');
    }

    public function details()
    {
        return $this->belongsToMany(PropertyTypeDetail::class, 'propertydetailsvalues', 'propertyid', 'detailsid')->withPivot('detailvalue');
    }



    public function operationtype()
    {
        return $this->belongsTo(PropertyOperationType::class, 'operationTypeId', 'propertyoperationtypeid');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'propertyTypeId', 'property_type_id');
    }

    public function registration()
    {
        return $this->belongsTo(PropertyRegistrationType::class, 'property_regestration_type_id', 'property_regestration_type_id');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'ownerId', 'ownerId');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cityId', 'cityId');
    }
}
