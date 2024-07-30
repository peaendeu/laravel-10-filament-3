<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Transaction;
use Flowframe\Trend\Trend;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class WidgetExpensesChart extends ChartWidget
{
  protected static ?string $heading = 'Pengeluaran';
  protected static string $color = 'danger';
  use InteractsWithPageFilters;

  protected function getData(): array
  {
    $startDate = !is_null($this->filters['startDate'] ?? null) ?
      Carbon::parse($this->filters['startDate']) :
      null;
    $endDate = !is_null($this->filters['endDate'] ?? null) ?
      Carbon::parse($this->filters['endDate']) :
      now();

    $data = Trend::query(Transaction::expenses())
      ->between(
        start: $startDate,
        end: $endDate,
      )
      ->perDay()
      ->sum('amount');

    return [
      'datasets' => [
        [
          'label' => 'Pengeluaran harian',
          'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
        ],
      ],
      'labels' => $data->map(fn (TrendValue $value) => $value->date),
    ];
    // return [
    //   'datasets' => [
    //     [
    //       'label' => 'Blog posts created',
    //       'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
    //     ],
    //   ],
    //   'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    // ];
  }

  protected function getType(): string
  {
    return 'line';
  }
}
