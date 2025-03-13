<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Payment;

use App\Domains\Expenses\Payment\Forms\PaymentForm;
use App\Domains\Expenses\Payment\Model\Payment;
use App\Domains\Expenses\Payment\Services\PaymentService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class EditPaymentModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    public $payment;

    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    public function mount($payment): void
    {
        $this->payment = $payment;
        $this->form->fill($payment);
    }

    public function form(Form $form): Form
    {
        return $form->schema(fn () => PaymentForm::schema())
            ->statePath('formData')
            ->model(Payment::class);
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.domains.expenses.payment.edit-payment-modal')->layout('layouts.expenses');
    }

    public function update(): void
    {
        if ($this->paymentService->updatePayment(paymentId: $this->payment['id'], data: $this->formData)) {
            $this->dispatch('refreshPaymentsTable');
            $this->forceClose()->closeModal();
        }
    }
}
