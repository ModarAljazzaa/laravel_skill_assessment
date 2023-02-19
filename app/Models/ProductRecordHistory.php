<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductRecordHistory extends Model
{
    use HasFactory;

    protected $table = "product_record_history";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'product_id',
        'user_id',
        'old_value',
        'new_value',
        'description',
    ];
}
