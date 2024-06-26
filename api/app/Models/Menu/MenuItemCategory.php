<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemCategory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name'
    ];

    public function items ()
    {
        return $this->hasMany(MenuItem::class, 'menu_item_category_id');
    }
}
