<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $table = 'carmodel';
    protected $primaryKey = 'carmodelid';
    protected $guarded = [];
    public  $timestamps = false;

    public function manufacture()
    {
        return $this->belongsTo(CarManufacture::class,'manufactureid','carmanufactureid');
    }
}
