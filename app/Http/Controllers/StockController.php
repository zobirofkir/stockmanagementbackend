<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\Stock;
use App\Services\Facades\StockFacade;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StockFacade::index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StockRequest $request)
    {
        return StockFacade::store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return StockFacade::show($stock);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StockRequest $request, Stock $stock)
    {
        return StockFacade::update($request, $stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        return StockFacade::delete($stock);
    }
}
