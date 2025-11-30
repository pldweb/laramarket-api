<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreBalanceHistory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['store_balance_id', 'type', 'amount', 'remarks', 'reference_id', 'reference_type'];

    protected $casts = ['amount' => 'decimal:2'];

    public function storeBalance(): BelongsTo
    {
        return $this->belongsTo(StoreBalance::class);
    }

    public function storeBalanceHistories()
    {
        return $this->hasMany(StoreBalanceHistory::class);
    }
}
