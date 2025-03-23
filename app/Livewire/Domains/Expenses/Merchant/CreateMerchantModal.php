<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Merchant;

use App\Domains\Expenses\Merchant\Forms\MerchantForm;
use App\Domains\Expenses\Merchant\Models\Merchant;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form as FilamentForm;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class CreateMerchantModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?array $formData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form->schema(fn () => MerchantForm::schema())
            ->statePath('formData')
            ->model(Merchant::class);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        if (Merchant::create($data)) {
            //            $this->dispatch('sendNotification',
            //                title: 'Merchant',
            //                message: 'New Merchant successfully created',
            //                type: SimpleNotification::TYPE_SUCCESS,
            //            );
            $this->dispatch('refreshMerchantsTable');
            $this->forceClose()->closeModal();
        }
    }

    public function render(): View|Application|Factory|\Illuminate\View\View
    {
        return view('livewire.domains.expenses.merchant.create-merchant-modal');
    }
}
