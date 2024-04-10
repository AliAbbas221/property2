<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRegistrationType extends Model
{
    use HasFactory;
    protected $table = 'property_registration_type';
    protected $primaryKey = 'property_regestration_type_id';
    protected $guarded = [];
    public  $timestamps = false;
}
