<?php

namespace App\Observers;

use App\Models\HourWork;

class HourWorkObserver
{
    public function creating(HourWork $hourWork): void
    {
        $hourWork->amount = $hourWork->hour * config('main_setting.payment_per_hour');
    }
}
