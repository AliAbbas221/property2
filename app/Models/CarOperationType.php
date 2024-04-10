<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarOperationType extends Model
{
    use HasFactory;
    protected $table = 'caroperationtype';
    protected $primaryKey = 'caroperationtypeid';
    protected $guarded = [];
    public  $timestamps = false;
}
