<?php

namespace App\Models;

use App\Enums\Product\StatusEnum;
use App\Enums\Product\TypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'status',
        'type',
        'user_id'
    ];


    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'status' => StatusEnum::class,
        'type' => TypeEnum::class,
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => StatusEnum::PENDING,
        'type' => TypeEnum::ITEM,
    ];

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function scopeFilter($query)
    {
        if (request('product_name')) {
            $query->where('name', request('product_name'));
        }

        if (request('user_id')) {
            $query->where('user_id', request('user_id'));
        }

        return $query;
    }

    public function history()
    {
        return $this->morphMany(ProductRecordHistory::class, 'products', 'product_id');
    }
}
