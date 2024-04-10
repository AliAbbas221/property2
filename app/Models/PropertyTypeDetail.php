<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyTypeDetail extends Model
{
    use HasFactory;
    protected $table = 'propertytypedetails';
    protected $primaryKey = 'propertytypedetailsid';
    protected $guarded = [];
    public  $timestamps = false;


    public function property()
    {
        return $this->belongsToMany(Property::class,'propertydetailsvalues','propertyid','detailsid')->withPivot('detailvalue');
    }

    public function type()
    {
        return $this->belongsTo(PropertyType::class,'typeid','property_type_id');
    }
}
