<?php

declare(strict_types=1);

namespace App\Livewire\Domains\Expenses\Homepage;

use App\Domains\Expenses\Payment\Services\PaymentService;
use App\Domains\Expenses\TransactionType\Enums\TransactionTypeEnum;
use Carbon\Carbon;
use Chartjs;
use IcehouseVentures\LaravelChartjs\Builder;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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

    public function render(): Factory|Application|View|\Illuminate\View\View
    {
        $chart = $this->chart();

        return view('livewire.domains.expenses.homepage.monthly-spending-chart', compact('chart'));
    }

    private function filters(): array
    {
        $startDate = Carbon::now()->startOfMonth()->toDateTimeString();
        $endDate = Carbon::now()->endOfMonth()->toDateTimeString();

        return [
            'payment_date_from' => $startDate,
            'payment_date_to' => $endDate,
            'sort_field' => 'payment_date',
            'sort_direction' => 'asc',
            'transaction_type' => TransactionTypeEnum::OUTGOING,
        ];
    }

    public function chart(): Builder
    {
        $payments = $this->paymentService->getPayments(filters: $this->filters(), perPage: false);

        $daysInMonth = Carbon::now()->daysInMonth;
        $labels = collect(range(1, $daysInMonth))->map(fn ($day) => Carbon::now()->startOfMonth()->addDays($day - 1)->format('Y-m-d'))->toArray();

        $dailySpendings = array_fill_keys($labels, null);

        foreach ($payments as $payment) {
            $date = Carbon::parse($payment->payment_date)->format('Y-m-d');
            $dailySpendings[$date] = $payment->price;
        }

        $data = [];
        $pointRadius = [];

        $total = 0;
        foreach ($dailySpendings as $day => $amount) {

            if ($amount != null) {
                $total += $amount;

                $data[] = $total;
            } else {
                $data[] = $amount;
            }

            $pointRadius[] = $amount !== null ? 4 : 0;
        }

        if ($data[0] == null) {
            $data[0] = 0;
        }

        if ($data[$daysInMonth - 1] === null) {
            $filteredArray = array_filter($data, function ($value) {
                return $value !== null;
            });

            $data[$daysInMonth - 1] = end($filteredArray);
        }

        return Chartjs::build()
            ->name('spending_chart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($labels)
            ->datasets([
                [
                    'label' => 'This month\'s spending',
                    'backgroundColor' => 'rgba(38, 185, 154, 0.31)',
                    'borderColor' => 'rgba(38, 185, 154, 0.7)',
                    'data' => $data,
                    'pointBorderColor' => 'rgba(38, 185, 154, 0.7)',
                    'pointBackgroundColor' => 'rgba(38, 185, 154, 0.7)',
                    'pointHoverBackgroundColor' => '#fff',
                    'pointHoverBorderColor' => 'rgba(220,220,220,1)',
                    'pointRadius' => $pointRadius,
                    'fill' => false,
                    'spanGaps' => true,
                    'tension' => 0.1,
                ],
            ]);
    }
}
