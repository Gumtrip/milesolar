<?php

namespace App\Http\Controllers\Api\Admin\Order;

use App\Http\Resources\Order\OrderProceedResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order\OrderExpense;
use App\Http\Requests\Admin\Order\OrderExpenseRequest;
use App\Http\Resources\Order\OrderExpenseResource;
use App\Models\Order\Order;

class OrderExpenseController extends Controller
{
    //订单支出

    public function store(OrderExpenseRequest $request, OrderExpense $orderExpense)
    {
        $order = Order::findOrFail();
        return new OrderExpenseResource($orderExpense);
    }

    public function update(OrderExpenseRequest $request, OrderExpense $orderExpense)
    {
        $order = Order::findOrFail();
        return new OrderExpenseResource($orderExpense);

    }

    public function show(Request $request, OrderExpense $orderExpense)
    {

        return new OrderExpenseResource($orderExpense);
    }

    public function destroy(Request $request, OrderExpense $orderExpense)
    {
        $orderExpense->delete();
        return response(null, 204);
    }
}
