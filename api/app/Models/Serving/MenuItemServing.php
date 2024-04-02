<?php

namespace App\Models\Serving;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemServing extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "menu_item_id",
        "serving_id",
    ];
}
