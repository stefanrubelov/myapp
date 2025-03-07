<?php

namespace App\Livewire\Expenses\Payment;

use App\Helpers\PaymentNumberGenerator;
use App\Livewire\Forms\PaymentForm;
use App\Models\Payment;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class CreatePaymentModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema(fn() => PaymentForm::schema())
            ->columns(2)
            ->statePath('formData');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $data['payment_number'] = PaymentNumberGenerator::generate();
        $data['user_id'] = auth()->id();

        if (Payment::create($data)) {
            $this->dispatch('refreshPaymentsTable');
            $this->forceClose()->closeModal();
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.expenses.payment.create-payment-modal')->layout('layouts.expenses');
    }
}
