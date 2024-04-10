<?php

namespace App\Models\Expense;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "amount",
        "expense_type_id",
        "extra_details",
        "created_by",
        "settled",

        // todo: protect relevant
    ];

    public function creator ()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function type ()
    {
        return $this->belongsTo(ExpenseType::class, 'expense_type_id');
    }
}
