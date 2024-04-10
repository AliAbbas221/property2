<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseditemType extends Model
{
    use HasFactory;
    protected $table = 'useditemtype';
    protected $primaryKey = 'useditemtypeid';
    public  $timestamps = false;
    protected $guarded = [''];
}
