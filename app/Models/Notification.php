<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    protected $primaryKey = 'notificationsid';
    public  $timestamps = false;
    protected $guarded = [''];

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'ownerid', 'ownerId');
    }
}
