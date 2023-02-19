<?php

namespace App\Http\Middleware;

use App\Models\Product;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CreateDefaultUserAndProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        User::firstOrCreate(
            ['email' => 'user1@email.com'],
            ['password' => 'password', 'name' => 'User1',],

        );
        Product::firstOrCreate(
            ["name" => "Product1"],
            [
                "price" => "100.0",
                "status" => "pending",
                "type" => "item",
                "user_id" => 1
            ]
        );

        return $next($request);
    }
}
