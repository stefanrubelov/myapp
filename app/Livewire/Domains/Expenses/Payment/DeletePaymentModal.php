<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Payment;

use App\Domains\Expenses\Payment\Services\PaymentService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class DeletePaymentModal extends ModalComponent
{
    public $payment;

    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    public function render(): View|Factory|Application|\Illuminate\View\View
    {
        return view('livewire.domains.expenses.payment.delete-payment-modal');
    }

    public function delete(): void
    {
        $this->paymentService->delete($this->payment['id']);
        $this->dispatch('refreshPaymentsTable');
        $this->forceClose()->closeModal();
    }
}
