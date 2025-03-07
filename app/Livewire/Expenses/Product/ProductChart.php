<?php

namespace App\Livewire\Expenses\Product;

use App\Enums\TransactionTypeEnum;
use App\Models\Payment;
use App\Models\Product;
use Carbon\Carbon;
use IcehouseVentures\LaravelChartjs\Builder;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ProductChart extends Component
{
    public Product $product;

    public function getPayments(): Collection|Payment|array
    {
        return Payment::with('merchant', 'transactionType')
            ->where('product_id', $this->product->id)
            ->orderBy('payment_date')
            ->get();
    }

    public function chart(): Builder
    {
        $payments = $this->getPayments();
        $paymentDates = $payments->pluck('payment_date')->unique()->sort()->toArray();

        $paymentsByType = $payments->groupBy('transactionType.slug');
        $datasets = [];

        foreach ([TransactionTypeEnum::INCOMING->value => '#28a745', TransactionTypeEnum::OUTGOING->value => '#dc3545'] as $type => $color) {
            if ($paymentsByType->has($type)) {
                $typePayments = $paymentsByType[$type];
                
                $multiplier = $type === TransactionTypeEnum::OUTGOING->value ? -1 : 1;
                $dateToPrice = $typePayments
                    ->mapWithKeys(function ($payment) use ($multiplier) {
                        return [
                            Carbon::parse($payment->payment_date)->toDateTimeString() => (float)$payment->price * $multiplier
                        ];
                    })
                    ->toArray();

                $showFirstPointRadius = true;
                $showLastPointRadius = true;

                $prices = array_map(function ($date) use ($dateToPrice) {
                    return $dateToPrice[Carbon::parse($date)->toDateTimeString()] ?? null;
                }, $paymentDates);

                // Move the first occurring non-null element
                if (count($prices) > 0) {
                    if ($prices[0] === null) {
                        for ($i = 1; $i < count($prices); $i++) {
                            if ($prices[$i] !== null) {
                                $prices[0] = $prices[$i];
                                $showFirstPointRadius = false;
                                break;
                            }
                        }
                    }

                    // Move the last occurring non-null element
                    $lastIndex = count($prices) - 1;
                    if ($prices[$lastIndex] === null) {
                        for ($i = $lastIndex - 1; $i >= 0; $i--) {
                            if ($prices[$i] !== null) {
                                $prices[$lastIndex] = $prices[$i];
                                $showLastPointRadius = false;
                                break;
                            }
                        }
                    }
                }

                $datasets[] = [
                    'label' => ucfirst($type),
                    'data' => $prices,
                    'backgroundColor' => $color,
                    'borderColor' => $color,
                    'pointBorderColor' => $color,
                    'pointBackgroundColor' => $color,
                    'pointHoverBackgroundColor' => "#fff",
                    'pointHoverBorderColor' => "rgba(220,220,220,1)",
                    'pointRadius' => array_map(function ($value, $index) use ($prices, $showFirstPointRadius, $showLastPointRadius) {
                        $isFirst = ($index === 0);
                        $isLast = ($index === count($prices) - 1);

                        return ($isFirst && !$showFirstPointRadius) || ($isLast && !$showLastPointRadius) ? 0 : 4;
                    }, $prices, array_keys($prices)),
                    'tension' => 0.3,
                    'fill' => false,
                    'spanGaps' => true,
                ];
            }
        }

        $paymentDates = collect($paymentDates)->map(function ($item) {
            return Carbon::parse($item)->format('Y-m-d');
        })->toArray();

        // Calculate the max value for y-axis scale
        $maxValue = max(
            abs(collect($datasets)->pluck('data')->flatten()->filter()->max()),
            abs(collect($datasets)->pluck('data')->flatten()->filter()->min())
        );

        return Chartjs::build()
            ->name('lineProductChart')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels($paymentDates)
            ->datasets($datasets)
            ->options([
                'spanGaps' => true,
                'scales' => [
                    'x' => [
                        'ticks' => [
                            'minRotation' => 40,
                        ]
                    ],
                    'y' => [
                        'suggestedMin' => -$maxValue,
                        'suggestedMax' => $maxValue,
                        'grid' => [
                            'zeroLineColor' => '#777777',
                            'zeroLineWidth' => 1
                        ]
                    ]
                ]
            ]);
    }

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        $chart = $this->chart();
        return view('livewire.components.chart', compact('chart'));
    }
}
