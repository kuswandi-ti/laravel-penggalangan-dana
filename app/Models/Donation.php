<?php

namespace App\Models;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_number', 'order_number');
    }

    public function status_text()
    {
        $text = '';

        switch ($this->status) {
            case 'paid':
                $text = 'sudah dibayar';
                break;
            case 'not paid':
                $text = 'belum dibayar';
                break;
            case 'cancel':
                $text = 'dibatalkan';
            default:
                break;
        }

        return $text;
    }

    public function status_color()
    {
        $color = '';

        switch ($this->status) {
            case 'paid':
                $color = 'success';
                break;
            case 'not paid':
                $color = 'dark';
                break;
            case 'cancel':
                $color = 'danger';
                break;
            default:
                break;
        }

        return $color;
    }

    public function scopeDonatur($query)
    {
        return $query->where('user_id', auth()->id());
    }
}
