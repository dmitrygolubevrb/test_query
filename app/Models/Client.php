<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'name'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function scopeCountOrderPricesLessThan(Builder $query, $insertFieldName, $count): Builder
    {
        return $query->withCount([
            "orders as $insertFieldName" => function(Builder $query) use ($count) {
                $query->where('price', '<', $count);
            },
        ]);
    }

    public function scopeCountOrderPricesMoreThan(Builder $query, $insertFieldName, $count): Builder
    {
        return $query->withCount([
            "orders as $insertFieldName" => function(Builder $query) use ($count) {
                $query->where('price', '>', $count);
            },
        ]);
    }

}
