<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPositionRequest;
use App\Http\Requests\AddRequest;
use App\Http\Requests\ShowRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrdersDetailResource;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\StatusOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController
{
    public function addPosition(Order $order, AddPositionRequest $request)
    {
        OrderMenu::create([
            'order_id' => $order->id,
            'menu_id' => $request->menu_id,
            'count' => $request->count,
        ]);
        return new OrdersDetailResource($order);
    }

    public function removePosition(Order $order, OrderMenu $orderMenu, RemovePositionRequest $request)
    {
        $orderMenu->delete();
        return new OrdersDetailResource($order);
    }

    public function changeStatus(Order $id)
    {
        return 'Изменение статуса заказа N' . $id['id'];
    }

    public function show(Order $order, ShowRequest $showOrderRequest)
    {
        return new OrdersDetailResource($order);
    }

    public function store(AddRequest $request)
    {
        $order = Order::create([
            'table_id' => $request->table_id,
            'number_of_person' => $request->number_of_person,
            'shift_worker_id' => Auth::user()->getShiftWorker($request->work_shift_id)->id,
            'status_order_id' => StatusOrder::where(['code' => 'taken'])->first()->id
        ]);
        return new OrderResource($order);
    }

    public function takenOrders()
    {
        return "Просмотр всех принятых заказов со смены";
    }
}
