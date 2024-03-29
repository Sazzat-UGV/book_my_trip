<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded=['id'];

    public function package()
    {
        return $this->hasMany(Package::class)->where('is_active', 1);
    }

}
