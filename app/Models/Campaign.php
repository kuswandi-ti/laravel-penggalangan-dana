<?php

namespace App\Models;

use App\Models\User;
use App\Models\MyModel;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends MyModel
{
    use HasFactory;

    public function category_campaign()
    {
        return $this->belongsToMany(Category::class, 'category_campaigns');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status_color()
    {
        $color = '';

        switch ($this->status) {
            case 'publish':
                $color = 'success';
                break;

            case 'pending':
                $color = 'danger';
                break;

            case 'archieve':
                $color = 'dark';
                break;

            default:
                break;
        }

        return $color;
    }
}
