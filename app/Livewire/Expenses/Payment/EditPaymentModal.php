<?php

namespace App\Livewire\Expenses\Payment;

use App\Livewire\Forms\PaymentForm;
use App\Models\Payment;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class EditPaymentModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    public $payment;

    public function mount($payment): void
    {
        $this->payment = $payment;
        $this->form->fill($payment);
    }

    public function form(Form $form): Form
    {
        return $form->schema(fn() => PaymentForm::schema())
            ->statePath('formData')
            ->model(Payment::class);
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.expenses.payment.edit-payment-modal')->layout('layouts.expenses');
    }

    public function update(): void
    {
        if (Payment::where("id", $this->payment['id'])->update([
            'price' => $this->formData['price'],
            'discounted' => $this->formData['discounted'],
            'transaction_type_id' => $this->formData['transaction_type_id'],
            'payment_method_id' => $this->formData['payment_method_id'],
            'product_id' => $this->formData['product_id'],
            'merchant_id' => $this->formData['merchant_id'],
            'payment_date' => $this->formData['payment_date'],
            'note' => $this->formData['note'],
        ])) {
            $this->dispatch('refreshPaymentsTable');
            $this->forceClose()->closeModal();
        }
    }
}
