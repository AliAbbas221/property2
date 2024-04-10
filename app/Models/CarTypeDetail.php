<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarTypeDetail extends Model
{
    use HasFactory;
    protected $table = 'cartypedetails';
    protected $primaryKey = 'detailsid';
    protected $guarded = [];
    public  $timestamps = false;


    public function car()
    {
        return $this->belongsToMany(Car::class,'cardetails','carid','detailsid')->withPivot('value');
    }

    public function type()
    {
        return $this->belongsTo(CarType::class,'typeid','cartypeid');
    }
}
