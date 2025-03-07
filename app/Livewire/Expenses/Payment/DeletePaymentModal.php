<?php

namespace App\Livewire\Expenses\Payment;

use App\Models\Payment;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class DeletePaymentModal extends ModalComponent
{
    public $payment;

    public function render(): View|Factory|Application|\Illuminate\View\View
    {
        return view('livewire.expenses.payment.delete-payment-modal');
    }

    public function delete(): void
    {
        Payment::where("id", $this->payment['id'])->delete();
        $this->dispatch('refreshPaymentsTable');
        $this->forceClose()->closeModal();
    }
}
