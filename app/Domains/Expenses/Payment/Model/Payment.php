<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Model;

use App\Domains\Expenses\Merchant\Models\Merchant;
use App\Domains\Expenses\Payment\Factories\PaymentFactory;
use App\Domains\Expenses\PaymentMethod\Models\PaymentMethod;
use App\Domains\Expenses\Product\Models\Product;
use App\Domains\Expenses\TransactionType\Enums\TransactionTypeEnum;
use App\Domains\Expenses\TransactionType\Models\TransactionType;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Payment extends Pivot
{
    use HasFactory;

    protected $table = 'payments';

    protected $casts = [
        'discounted' => 'boolean',
    ];

    protected $fillable = [
        'price',
        'product_id',
        'merchant_id',
        'user_id',
        'transaction_type_id',
        'payment_method_id',
        'payment_date',
        'discounted',
        'payment_number',
    ];

    public static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }

    protected function discounted(): Attribute
    {
        return new Attribute(
            get: fn ($value) => boolval($value),
            set: fn ($value) => boolval($value),
        );
    }

    protected function price(): Attribute
    {
        return new Attribute(
            get: fn ($value) => $value / 100,
            set: fn ($value) => $value * 100
        );
    }

    public function merchant(): BelongsTo
    {
        return $this->belongsTo(Merchant::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user associated with the payment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transaction type associated with the payment.
     */
    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class);
    }

    /**
     * Get the payment method associated with the payment.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function scopeOutgoing(Builder $query): Builder
    {
        return $query->whereRelation('transactionType', 'slug', TransactionTypeEnum::OUTGOING->value);
    }
}
