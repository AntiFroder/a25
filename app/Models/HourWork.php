<?php

namespace App\Models;

use App\Observers\HourWorkObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([HourWorkObserver::class])]
class HourWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hour',
        'amount',
        'paid'
    ];

    public function amount(): Attribute
    {
        return Attribute::make(
            get: fn(int $amount) => $amount / 100,
            set: fn(int|float $amount) => (int)round($amount * 100)
        );
    }

    public function scopeNotPaid(Builder $query): void
    {
        $query->where('paid', false);
    }
}
