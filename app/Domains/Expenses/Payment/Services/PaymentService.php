<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Services;

use App\Domains\Expenses\Payment\Filters\PaymentFilter;
use App\Domains\Expenses\Payment\Model\Payment;
use App\Domains\Expenses\Payment\Repositories\PaymentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PaymentService
{
    private PaymentRepository $repository;

    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getPayments(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $filter = new PaymentFilter($filters);

        return $this->repository->all($filter, $perPage);
    }

    public function getPaymentById(int $id): Payment
    {
        return Payment::with(['product', 'merchant', 'transactionType', 'paymentMethod'])
            ->find($id);
    }

    public function getOutgoingPaymentsByProductId(int $productId): Collection|Payment|array
    {
        return $this->repository->allOutgoingByProduct($productId);
    }

    public function getPaymentsByProductId(int $productId): Collection|Payment|array
    {
        return $this->repository->allByProduct($productId);
    }

    public function processPayment(array $data): Payment
    {
        return $this->repository->create($data);
    }

    public function delete(int $paymentId): int|bool|null
    {
        return $this->repository->delete($paymentId);
    }

    public function updatePayment(int $paymentId, array $data)
    {
        return $this->repository->update($paymentId, $data);
    }
}
