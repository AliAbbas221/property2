<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllNotification extends Model
{
    use HasFactory;
    protected $table = 'notifications_for_all';
    protected $primaryKey = 'id';
    public  $timestamps = false;
    protected $guarded = [''];
}
