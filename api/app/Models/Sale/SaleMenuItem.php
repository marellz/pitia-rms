<?php

namespace App\Models\Sale;

use App\Models\Menu\MenuItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleMenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "menu_item_id",
        "sale_id",
        "price",

        // todo: add quantity
    ];


    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id');
    }

}
