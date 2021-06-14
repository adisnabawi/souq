<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;
    protected $table = 'ads';
    protected $primaryKey = 'ad_id';

    public function image()
    {
        return $this->hasMany(Image::class, 'ad_id', 'ad_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'cat_id', 'cat_id');
    }

    public function poster()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function subcategory()
    {
        return $this->hasOne(Subs::class, 'sub_id', 'sub_id');
    }

    public function location()
    {
        return $this->hasOne(Location::class, 'loc_id', 'loc_id');
    }
}
