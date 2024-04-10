<?php

namespace App\Models\Expense;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "name",
        "description",
    ];
}
