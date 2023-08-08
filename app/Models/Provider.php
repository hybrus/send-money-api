<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Provider extends Model
{
    use HasFactory;

    public function banks()
    {
        return $this->belongsToMany(Bank::class, 'bank_provider');
    }
}
