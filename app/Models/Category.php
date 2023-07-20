<?php

namespace App\Models;

use App\Models\MyModel;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends MyModel
{
    use HasFactory;

    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'user_id', 'id');
    }
}
