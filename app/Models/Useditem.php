<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Useditem extends Model
{
    use HasFactory;
    protected $table = 'useditems';
    protected $primaryKey = 'useditemsid';
    public  $timestamps = false;
    protected $guarded = [''];

    public function mainphoto(): Attribute
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


    /*****************Relations*************/

    public function attatchments()
    {
        return $this->hasMany(UseditemAttachment::class, 'useditem_id', 'useditemsid');
    }
    public function type()
    {
        return $this->belongsTo(UseditemType::class, 'itemtypeid', 'useditemtypeid');
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'ownerid', 'ownerId');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'cityId');
    }
}
