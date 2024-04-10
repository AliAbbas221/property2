<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDetailsValues extends Model
{
    use HasFactory;
    protected $table = 'propertydetailsvalues';
    protected $primaryKey = 'propertydetailsvaluesid';
    protected $guarded = [];
    public  $timestamps = false;
}
