<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class CarAttatchment extends Model
{
    use HasFactory;
    protected $table = 'carattachments';
    protected $primaryKey = 'carattachmentsid';
    protected $guarded = [];
    public  $timestamps = false;

    public function attachmentlink(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function ($file) {
                if (is_string($file)) {
                    return URL::asset($file);
                } else {
                    $name = uniqid('img_') . '.' . $file->getClientOriginalExtension();
                    $path = 'images';
                    $file->storeAs('public/' . $path, $name);
                    return URL::asset('storage/' . $path . '/' . $name);
                }
            }
        );
    }
}
