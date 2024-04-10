<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyOperationType extends Model
{
    use HasFactory;
    protected $table = 'propertyoperationtype';
    protected $primaryKey = 'propertyoperationtypeid';
    protected $guarded = [];
    public  $timestamps = false;
}
