<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'units', // todo: protect
        'unit_type',
        'servings_per_unit', // todo: protect
        'cost_per_unit', // todo: protect
    ];
}
