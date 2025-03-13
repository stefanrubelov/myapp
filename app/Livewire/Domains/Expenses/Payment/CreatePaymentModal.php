<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Payment;

use App\Domains\Expenses\Payment\Forms\PaymentForm;
use App\Domains\Expenses\Payment\Helpers\PaymentNumberGenerator;
use App\Domains\Expenses\Payment\Services\PaymentService;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreatePaymentModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.domains.expenses.payment.create-payment-modal')->layout('layouts.expenses');
    }

    public function form(Form $form): Form
    {
        return $form->schema(fn () => PaymentForm::schema())
            ->columns(2)
            ->statePath('formData');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $data['payment_number'] = PaymentNumberGenerator::generate();
        $data['user_id'] = auth()->id();

        if ($this->paymentService->processPayment($data)) {
            $this->dispatch('refreshPaymentsTable');
            $this->forceClose()->closeModal();
        }
    }
}
