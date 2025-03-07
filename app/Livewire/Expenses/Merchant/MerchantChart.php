<?php

namespace App\Livewire\Expenses\Merchant;

use App\Models\Merchant;
use App\Models\Payment;
use Carbon\Carbon;
use IcehouseVentures\LaravelChartjs\Builder;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;

class MerchantChart extends Component
{
    public Merchant $merchant;

    public function render(): Application|Factory|View|\Illuminate\View\View
    {
        $chart = $this->generateChart();

        return view('livewire.components.chart', compact('chart'));
    }

    private function getPayments(): Payment|Collection
    {
        return Payment::where('payment_date', '>=', Carbon::now()->subYears(3)->startOfMonth())
            ->get();
    }

    private function generateChart(): Builder
    {
        $months = collect(range(1, 36))->mapWithKeys(fn($i) => [
            Carbon::now()->subMonths($i)->format("M 'y") => 0
        ]);

        $payments = $this->getPayments()
            ->groupBy(fn($payment) => Carbon::parse($payment->payment_date)->format("M 'y"))
            ->map(fn($group) => $group->sum('price'));

        $data = $months->map(fn($value, $month) => $payments->get($month, 0))->values()->toArray();
        $labels = array_keys($months->toArray());

        $data = array_reverse($data);
        $labels = array_reverse($labels);

        $color = $this->merchant->accent_color;

        return Chartjs::build()
            ->name('barProductChart')
            ->size(['width' => 400, 'height' => 200])
            ->type('bar')
            ->labels($labels)
            ->datasets([
                [
                    'label' => 'Payment',
                    'data' => $data,
                    'backgroundColor' => $color,
                ]
            ])->optionsRaw("{
                    plugins: {
                        title: {
                            display: true,
                            text: '3 year report',
                            font: {
                                size: 16
                            }
                        },
                        legend: {
                            display: false,
                        },
                    }
                }");
    }
}
