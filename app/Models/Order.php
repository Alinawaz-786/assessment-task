<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Merchant $merchant
 * @property Affiliate $affiliate
 * @property float $subtotal
 * @property float $commission_owed
 * @property string $payout_status
 */
class Order extends Model
{
    use HasFactory;

    const STATUS_UNPAID = 'unpaid';
    const STATUS_PAID = 'paid';

    protected $fillable = [
        'merchant_id',
        'affiliate_id',
        'subtotal',
        'commission_owed',
        'payout_status',
        'customer_email',
        'created_at'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    // Convert cents to dollars when retrieving
    public function getSubTotalAttribute($value)
    {
        return $value / 100;
    }

    // Convert dollars to cents when setting
    public function setSubTotalAttribute($value)
    {
        $this->attributes['subtotal'] = $value * 100;
    }

    // Convert cents to dollars when retrieving
    public function getCommissionOwedAttribute($value)
    {
        return $value / 100;
    }

    // Convert dollars to cents when setting
    public function setCommissionOwedAttribute($value)
    {
        $this->attributes['commission_owed'] = $value * 100;
    }
}
