<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarDetail extends Model
{
    use HasFactory;
    protected $table = 'cardetails';
    protected $primaryKey = 'cardetailsid';
    protected $guarded = [];
    public  $timestamps = false;
}
