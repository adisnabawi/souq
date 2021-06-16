<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $primaryKey = 'like_id';

    public function ads()
    {
        return $this->hasOne(Ads::class, 'ad_id', 'ad_id');
    }
}
