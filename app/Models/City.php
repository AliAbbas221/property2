<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'city';
    protected $primaryKey = 'cityId';
    protected $guarded = [];
    public  $timestamps = false;
 protected $fillable = [
        'country_name'
,'name','phone1','phone2','phone3','country_id'


    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
