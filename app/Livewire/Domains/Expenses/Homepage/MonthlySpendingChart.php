<?php

namespace App\Livewire\Domains\Expenses\Homepage;

use Chartjs;
use IcehouseVentures\LaravelChartjs\Builder;
use Livewire\Component;

class MonthlySpendingsChart extends Component
{
    public function render()
    {
        return view('livewire.domains.expenses.homepage.monthly-spendings-chart');
    }

    public function chart(): Builder
    {
        return Chartjs::build()
    }
}
