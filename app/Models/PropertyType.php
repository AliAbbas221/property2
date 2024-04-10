<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $table = 'property_type';
    protected $primaryKey = 'property_type_id';
    protected $guarded = [];
    public  $timestamps = false;

    public function typedetails()
    {
        return $this->hasOne(PropertyTypeDetail::class,'typeid','property_type_id');
    }
}
