<?php

namespace App\Http\Controllers\Api\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Http\Requests\Admin\Order\OrderRequest;
use App\Http\Queries\Order\OrderQuery;
use DB;
class OrderController extends Controller
{
    public function index(Request $request, OrderQuery $settingQuery)
    {
        $orders = $settingQuery->paginate(config('app.page_size'));
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request, Order $order)
    {
        DB::transaction(function()use($order,$request){
            $order->fill($request->all());
            $order->client()->associate($request->client_id);
            $order->save();

            // 遍历用户提交的 SKU
            $items       = $request->input('items');
            $totalAmount = $expenseAmount = 0;
            foreach ($items as $data) {
                $sku  = Product::find($data['product_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'name' => $sku?$sku->title:$data['name'],
                    'amount' => $data['amount'],
                    'price'  => $data['price'],
                ]);
                $totalAmount+=$data['price'] *$data['amount'];//总计
                $item->product()->associate($data['product_id']);
                $item->save();
            }

            //支出
            $expenses = $request->expenses;
            if($expenses){
                foreach($expenses as $data){
                    $expense = $order->expenses()->make([
                        'expense_name' => $data['name'],
                        'fee' => $data['fee'],
                        'remark' => $data['remark'],
                    ]);
                    $expense->save();
                    $expenseAmount += $data['fee'];
                }
            }
            $order->update([
                'total_amount'=>$totalAmount,
                'rmb_total_amount'=>$totalAmount * $request->exchange_rate,
            ]);

        });



        return response(null,201);
    }

    public function show($id, OrderQuery $settingQuery)
    {
        $order = $settingQuery->findOrFail($id);
        return new OrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return new OrderResource($order);
    }

    public function destroy(Request $request, Order $order)
    {
        $order->delete();
        return response(null, 204);
    }
}
