<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreBallanceHistory extends Model
{
    use UUID;

    protected $fillable = ['store_balance_id', 'type', 'amount', 'remarks', 'reference_id', 'reference_type'];

    public function storeBalance(): BelongsTo
    {
        return $this->belongsTo(StoreBallance::class);
    }

    public function storeBallanceHistories()
    {
        return $this->hasMany(StoreBallanceHistory::class);
    }
}
