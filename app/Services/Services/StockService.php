<?php

namespace App\Services\Services;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Models\Product;
use App\Http\Resources\StockResource;
use App\Services\Constructors\StockConstructor;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StockService implements StockConstructor
{
    // Method to calculate the total price
    private function calculateTotalPrice(StockRequest $request): float
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            throw new ModelNotFoundException('Product not found.');
        }

        return $product->price * $request->quantity;
    }

    public function index(): AnonymousResourceCollection
    {
        return StockResource::collection(
            Stock::orderBy('created_at', 'desc')->get()
        );
    }

    public function show(Stock $stock): StockResource
    {
        return StockResource::make($stock);
    }

    public function store(StockRequest $request): StockResource
    {
        $total_price = $this->calculateTotalPrice($request);

        $stock = Stock::create(array_merge(
            $request->validated(),
            [
                'total_price' => $total_price,
            ]
        ));

        return StockResource::make($stock);
    }

    public function update(StockRequest $request, Stock $stock): StockResource
    {
        $total_price = $this->calculateTotalPrice($request);

        $stock->update(array_merge(
            $request->validated(),
            [
                'total_price' => $total_price,
            ]
        ));

        return StockResource::make($stock);
    }

    public function delete(Stock $stock): StockResource
    {
        $stock->delete();

        return StockResource::make($stock);
    }
}
