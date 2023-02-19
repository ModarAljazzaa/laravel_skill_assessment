<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductRecordHistory;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::filter()->get();
        return $this->sendResponse('Successful', ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();
        $productResult = Product::create($validated);
        if ($productResult)
            return $this->sendResponse('Successful', new ProductResource($productResult), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return $this->sendResponse('Successful', new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        Product::findOrFail($id)->update($request->validated());
        return $this->sendResponse('Successful updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return $this->sendResponse('Successful');
    }

    public function getHistoryListById($id)
    {

        $productHistoryList = ProductRecordHistory::where('product_id', $id)->get();
        return $this->sendResponse($productHistoryList);
    }
    public function getHistoryList()
    {
        $productHistoryList = ProductRecordHistory::all();
        return $this->sendResponse($productHistoryList);
    }
}
