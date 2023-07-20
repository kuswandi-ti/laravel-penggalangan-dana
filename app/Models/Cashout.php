<?php

namespace App\Models;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cashout extends Model
{
    use HasFactory;

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeDonatur($query)
    {
        return $query->where('user_id', auth()->id());
    }

    public function status_text()
    {
        $text = '';

        switch ($this->status) {
            case 'success':
                $text = 'dibayar';
                break;
            case 'pending':
                $text = 'belum dikonfirmasi';
                break;
            case 'canceled':
                $text = 'dibatalkan';
                break;
            case 'rejected':
                $text = 'ditolak';
                break;
            default:
                break;
        }

        return $text;
    }

    public function status_color()
    {
        $color = '';

        switch ($this->status) {
            case 'success':
                $color = 'success';
                break;
            case 'pending':
                $color = 'dark';
                break;
            case 'canceled':
                $color = 'danger';
                break;
            case 'rejected':
                $color = 'secondary';
                break;
            default:
                break;
        }

        return $color;
    }
}
