<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Homepage;

use App\Domains\Expenses\Payment\Services\PaymentService;
use Carbon\Carbon;
use Chartjs;
use IcehouseVentures\LaravelChartjs\Builder;
use Illuminate\Contracts\Container\BindingResolutionException;
use Livewire\Component;

class MonthlySpendingChart extends Component
{
    private PaymentService $paymentService;

    /**
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->paymentService = app()->make(PaymentService::class);
    }

    public function render()
    {
//        dd($this->filters());
        $chart = $this->chart();
        dd($chart);

        return view('livewire.domains.expenses.homepage.monthly-spending-chart');
    }

    private function filters():array{
        $startDate = Carbon::now()->startOfMonth()->toDateTimeString();
        $endDate = Carbon::now()->endOfMonth()->toDateTimeString();

        return [
            'payment_date_from' => $startDate,
            'payment_date_to' => $endDate,
        ];
    }
    public function chart()
    {

        return $this->paymentService->getPayments(filters: $this->filters(), perPage: false);
//        dd($startDate, $endDate);

        return Chartjs::build()
            ->name('UserRegistrationsChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'label' => 'User Registrations',
                    'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                    'borderColor' => 'rgba(38, 185, 154, 0.7)',
                    'data' => $data,
                ],
            ]);
    }
}
