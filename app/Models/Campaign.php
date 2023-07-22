<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cashout;
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

    public function donations()
    {
        return $this->hasMany(Donation::class, 'campaign_id', 'id');
    }

    public function cashouts()
    {
        return $this->hasMany(Cashout::class, 'campaign_id', 'id');
    }

    public function cashout_latest()
    {
        return $this->hasOne(Cashout::class, 'campaign_id', 'id')
            ->latestOfMany();
    }

    public function scopeDonatur($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function status_text()
    {
        $text = '';

        switch ($this->status) {
            case 'publish':
                $text = 'publish';
                break;
            case 'pending':
                $text = 'pending';
            case 'archieve':
                $text = 'archieve';
            default:
                break;
        }

        return $text;
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
