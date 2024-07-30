<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
  use InteractsWithPageFilters;
  protected function getStats(): array
  {
    $startDate = !is_null($this->filters['startDate'] ?? null) ?
      Carbon::parse($this->filters['startDate']) :
      null;
    $endDate = !is_null($this->filters['endDate'] ?? null) ?
      Carbon::parse($this->filters['endDate']) :
      now();

    $pemasukan = Transaction::incomes()->get()
      ->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
    $pengeluaran = Transaction::expenses()->get()
      ->whereBetween('date_transaction', [$startDate, $endDate])->sum('amount');
    $selisih = $pemasukan - $pengeluaran;

    return [
      Stat::make('Pemasukan', number_format($pemasukan)),
      Stat::make('Pengeluaran', number_format($pengeluaran)),
      Stat::make('Selisih', number_format($selisih)),
    ];
  }
}

// ->color('success')
// ->description('5.000.000 increase')
// ->descriptionIcon('heroicon-m-arrow-trending-up'),