<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WorkShift;
use Illuminate\Support\Facades\DB;

class WorkShiftController
{
    public function store()
    {
        DB::table('work_shifts')->insert([
            'start' => date('Y-m-d' . ' 08:00:00'),
            'end' => date('Y-m-d' . ' 18:00:00')
        ]);
        return 'Смена успешно добавленна';
    }

    public function open(WorkShift $id)
    {
        if (DB::table('work_shifts')
                ->where('id', '=', $id['id'])
                ->value('active') == '1') {
            return "Смена уже открыта";
        } else {
            DB::table('work_shifts')
                ->where('id', '=', $id['id'])
                ->update(['active' => '1']);
            return 'Смена успешно открыта';
        }
    }

    public function close(WorkShift $id)
    {
        if (DB::table('work_shifts')
                ->where('id', '=', $id['id'])
                ->value('active') == '0') {
            return "Смена уже закрыта";
        } else {
            DB::table('work_shifts')
                ->where('id', '=', $id['id'])
                ->update(['active' => '0']);
            return 'Смена успешно закрыта';
        }
    }

    public function addUser(User $id)
    {
        DB::table('shift_workers')->insert([
            'work_shift_id' => 4,
            'user_id' => $id['id']
        ]);
        return 'Сотрудник добавлен к смене';
    }

    public function orders(WorkShift $id)
    {
        return 'Просмор заказов на смену N' . $id['id'];
    }
}
