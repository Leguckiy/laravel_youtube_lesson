<?php

namespace App\Models;

use App\Mail\SendSubscriptionsMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = [
        'email',
        'sku_id',
    ];

    public function scopeActiveBySkuId($query, $skutId)
    {
        return $query->where('status', 0)->where('sku_id', $skutId);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public static function sendEmailBySubscription(Sku $sku)
    {
        $subscriptions = self::activeBySkuId($sku->id)->get();

        foreach ($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionsMessage($sku));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
