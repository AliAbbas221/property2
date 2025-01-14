<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    protected $table = 'cartype';
    protected $primaryKey = 'cartypeid';
    protected $guarded = [];
    public  $timestamps = false;

    public function typedetails()
    {
        return $this->hasOne(CarTypeDetail::class,'typeid','cartypeid');
    }
}
