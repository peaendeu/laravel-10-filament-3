<?php

namespace App\Filament\Admin\Widgets;

use Flowframe\Trend\Trend;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class WidgetIncomesChart extends ChartWidget
{
  protected static ?string $heading = 'Pemasukan';
  protected static string $color = 'success';
  use InteractsWithPageFilters;

  protected function getData(): array
  {
    $startDate = !is_null($this->filters['startDate'] ?? null) ?
      Carbon::parse($this->filters['startDate']) :
      null;
    $endDate = !is_null($this->filters['endDate'] ?? null) ?
      Carbon::parse($this->filters['endDate']) :
      now();

    $data = Trend::query(Transaction::incomes())
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
  }

  protected function getType(): string
  {
    return 'line';
  }
}
