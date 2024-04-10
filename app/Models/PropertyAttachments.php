<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class PropertyAttachments extends Model
{
    use HasFactory;
    protected $table = 'propertyattachments';
    protected $primaryKey = 'propertyattachmentsid';
    protected $guarded = [];
    public  $timestamps = false;

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function ($file) {
                if (is_string($file)) {
                    return URL::asset($file);
                } else {
                    $file_name = time() . '_' . $file->getClientOriginalName();
                    $path = "images/properties/" ;
                    $file_full_name = $path  . $file_name;
                    $file->storeAs($path, $file_name,'public');

                    return asset('storage/' . $file_full_name);
                }
            }
        );
    }
}