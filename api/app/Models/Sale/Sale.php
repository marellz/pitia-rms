<?php

namespace App\Models\Sale;

use App\Models\Sale\SaleMenuItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "created_by",
        "status",
        "complete",
        "amount",

        // todo: protect relevant
    ];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(SaleMenuItem::class);
    }
}
