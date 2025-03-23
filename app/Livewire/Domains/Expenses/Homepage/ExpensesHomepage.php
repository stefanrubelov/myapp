<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Homepage;

use App\Domains\Expenses\Payment\Services\PaymentService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ExpensesHomepage extends Component
{
    private PaymentService $paymentService;

    public function boot(): void
    {
        $this->paymentService = app(PaymentService::class);
    }

    private function getSpendings(): array
    {
        $data['current_month'] = $this->paymentService->getPayments(
            filters: [
                'payment_date_from' => Carbon::now()->startOfMonth()->toDateTimeString(),
                'payment_date_to' => Carbon::now()->endOfMonth()->toDateTimeString(),
            ],
            perPage: false
        )->sum('price');

        $data['last_month'] = $this->paymentService->getPayments(
            filters: [
                'payment_date_from' => Carbon::now()->subMonth()->startOfMonth()->toDateTimeString(),
                'payment_date_to' => Carbon::now()->subMonth()->endOfMonth()->toDateTimeString(),
            ],
            perPage: false
        )->sum('price');

        $data['current_month_last_year'] = $this->paymentService->getPayments(
            filters: [
                'payment_date_from' => Carbon::now()->subYear()->startOfMonth()->toDateTimeString(),
                'payment_date_to' => Carbon::now()->subYear()->endOfMonth()->toDateTimeString(),
            ],
            perPage: false
        )->sum('price');

        return $data;
    }

    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        $data = $this->getSpendings();

        return view('livewire.domains.expenses.homepage.expenses-homepage', compact('data'))->layout('layouts.expenses');
    }
}
