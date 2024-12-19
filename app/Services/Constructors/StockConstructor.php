<?php
namespace App\Services\Constructors;

use App\Http\Requests\StockRequest;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface StockConstructor {

    /**
     * Get all stocks
     *
     * @return AnonymousResourceCollection
     */
    public function index() : AnonymousResourceCollection;

    /**
     * Show Single Stock
     *
     * @param Stock $stock
     * @return StockResource
     */
    public function show(Stock $stock) : StockResource;

    /**
     * Create New Stock
     *
     * @param StockRequest $request
     * @return StockResource
     */
    public function store(StockRequest $request) : StockResource;

    /**
     * Update Stock
     *
     * @param StockRequest $request
     * @param Stock $stock
     * @return StockResource
     */
    public function update(StockRequest $request , Stock $stock) : StockResource;

    /**
     * Delete Stock
     *
     * @param Stock $stock
     * @return StockResource
     */
    public function delete(Stock $stock) : StockResource;

}
