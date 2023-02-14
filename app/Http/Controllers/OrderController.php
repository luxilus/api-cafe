<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController
{
    public function addPosition()
    {
        return "Добавление позиций из меню в заказ";
    }

    public function removePosition()
    {
        return "Удаление позиций из заказа";
    }

    public function changeStatus(Order $id)
    {
        return 'Изменение статуса заказа N' . $id['id'];
    }

    public function show()
    {
        return "Просмотр конкретного заказа";
    }

    public function store()
    {
        return "Создание заказа для определенного столика";
    }

    public function takenOrders()
    {
        return "Просмотр всех принятых заказов со смены";
    }
}
