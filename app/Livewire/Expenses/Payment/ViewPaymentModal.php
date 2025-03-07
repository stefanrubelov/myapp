<?php

namespace App\Livewire\Expenses\Payment;

use App\Livewire\Infolists\PaymentInfoList;
use App\Models\Payment;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ViewPaymentModal extends ModalComponent implements HasForms, HasInfolists
{
    use InteractsWithInfolists, InteractsWithForms;

    public Payment $payment;

    public function infoList(Infolist $infoList): Infolist
    {
        return $infoList->schema(fn() => PaymentInfoList::schema())->record($this->payment);
    }

    public function render(): View|Factory|Application|\Illuminate\View\View
    {
        return view('livewire.expenses.payment.view-payment-modal');
    }
}
