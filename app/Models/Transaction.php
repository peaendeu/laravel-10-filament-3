<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;
  protected $guarded = ['id'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function scopeExpenses($query)
  {
    return $query->whereHas('category', function ($query) {
      $query->where('is_expense', true);
    });
  }

  public function scopeIncomes($query)
  {
    return $query->whereHas('category', function ($query) {
      $query->where('is_expense', 0);
    });
  }
}
