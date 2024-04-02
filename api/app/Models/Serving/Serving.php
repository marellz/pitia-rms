<?php

namespace App\Models\Serving;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serving extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "name",
        "stock_id",
        "supply_id",
        "description",
        "units", // todo: protect
        "unit_type", 
    ];
}
