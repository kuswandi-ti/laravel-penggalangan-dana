<?php

namespace App\Models;

use App\Models\Bank;
use App\Models\MyModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends MyModel
{
    use HasFactory;

    public function bank_settings()
    {
        return $this->belongsToMany(Bank::class, 'bank_settings', 'setting_id')
            ->withPivot('account', 'name')
            ->withTimestamps();;
    }
}
