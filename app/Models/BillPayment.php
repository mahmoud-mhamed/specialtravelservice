<?php

namespace App\Models;

use App\Observers\BillPaymentObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\BillPaymentTypeEnum;
use App\Traits\EnumCastAppendAttributeTrait;use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int bill_id
 * @property double paid_amount
 * @property int paid_currency_id
 * @property double bill_currency_equal_value
 * @property double bill_currency_equal_total
 * @property string type
 * @property string note
 * @property string payment_date
 * @property int $proof_archive_id
 * @property-read string $type_text
 * @property-read Currency paidCurrency
 * @property-read Archive proofArchive
 * @property-read Bill $bill
 */
#[ObservedBy(BillPaymentObserver::class)]
class BillPayment extends BaseModel
{
    protected $fillable = [
        'bill_id', 'paid_amount', 'paid_currency_id', 'bill_currency_equal_value', 'bill_currency_equal_total',
        'type', 'note', 'payment_date', 'proof_archive_id',
        'created_by_id', 'created_by_type', 'updated_by_id', 'updated_by_type', 'deleted_by_id', 'deleted_by_type'
    ];

    protected $casts = [
        'type' => BillPaymentTypeEnum::class,
    ];

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }
    public function paidCurrency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'paid_currency_id');
    }

    public function proofArchive(): BelongsTo
    {
        return $this->belongsTo(Archive::class, 'proof_archive_id');
    }
}
