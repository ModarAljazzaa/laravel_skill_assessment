<?php

namespace App\Observers;

use App\Mail\AppMail;
use App\Models\Product;
use App\Models\ProductRecordHistory;
use App\Traits\SendJsonResponse;
use Illuminate\Support\Facades\Mail;

class ProductObserver
{
    use SendJsonResponse;
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        $details = [
            "to" => $product->user->email,
            "title" => "Create Product",
            "body" => "You have created product successfully"
        ];
        Mail::to($details['to'])->send(new AppMail($details));
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updated(Product $product)
    {
        try {

            $updatedFields = collect($product->getDirty())->filter(function ($value, $key) {
                return !in_array($key, ['created_at', 'updated_at']);
            });
            $updatedFields->map(function ($value, $field) use ($product) {
                return [
                    'product_id' => $product->id,
                    'user_id' => $product->user->id,
                    'old_value' => $product->getOriginal($field),
                    'new_value' => $product->$field,
                    'description' => "Updated {$field} to {$value}"
                ];
            })->each(function ($record) {
                ProductRecordHistory::create($record);
            });
        } catch (\Exception $ex) {
            return $this->sendError($ex->getMessage());
        }
    }

    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function restored(Product $product)
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function forceDeleted(Product $product)
    {
        //
    }
}
