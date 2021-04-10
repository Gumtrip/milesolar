<?php

namespace App\Http\Controllers\Api\Admin\Order;

use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\OrderOfferRequest;
use App\Http\Queries\Order\OrderOfferQuery;
use App\Http\Resources\Order\OrderOfferResource;
use App\Models\Order\OrderOffer;

class OrderOfferController extends Controller
{
    public function index(Request $request, OrderOfferQuery $offerQuery)
    {
        $orders = $offerQuery->paginate(config('app.page_size'));
        return OrderOfferResource::collection($orders);
    }

    public function show($id, OrderOfferQuery $offerQuery)
    {
        $orderOffer = $offerQuery->findOrFail($id);
        return new OrderOfferResource($orderOffer);
    }

    public function store(OrderOfferRequest $request, OrderOffer $orderOffer)
    {

        return new OrderOfferResource($orderOffer);
    }

    public function update(OrderOfferRequest $request, OrderOffer $orderOffer)
    {
        return new OrderOfferResource($orderOffer);

    }

    public function destroy(OrderOffer $orderOffer)
    {
        $orderOffer->delete();
        return response(null, 204);
    }
}
