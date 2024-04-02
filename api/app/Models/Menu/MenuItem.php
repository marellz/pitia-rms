<?php

namespace App\Models\Menu;

use App\Models\Serving\Serving;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'menu_item_category_id',
        'image',
        'description',
        'price', // todo: protect
        'sale_price', // todo: protect
    ];
}
