<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Repositories;

use App\Domains\Expenses\Payment\Filters\PaymentFilter;
use App\Domains\Expenses\Payment\Model\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentRepository
{
    public function __construct(private $model = new Payment) {}

    public function all(PaymentFilter $filter, int|bool $perPage): LengthAwarePaginator|Collection
    {
        $query = $this->model->with(['product', 'merchant', 'transactionType', 'paymentMethod']);

        $filter->apply($query);

        if ($perPage) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }

    public function allOutgoingByProduct(int $productId): Collection|Payment|array
    {
        return $this->model->with('merchant')
            ->where('product_id', $productId)
            ->outgoing()
            ->orderBy('payment_date')
            ->get();
    }

    public function allByProduct(int $productId): Collection|Payment|array
    {
        return $this->model->with('merchant')
            ->where('product_id', $productId)
            ->orderBy('payment_date')
            ->get();
    }

    public function create(array $data): Payment
    {
        return $this->model->create($data);
    }

    public function delete(int $paymentId): int|bool|null
    {
        return $this->model->where('id', $paymentId)->delete();
    }

    public function update(int $paymentId, array $data): bool
    {
        return $this->model->where('id', $paymentId)->update($data);
    }
}
