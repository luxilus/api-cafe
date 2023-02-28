<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseRequest;
use App\Http\Requests\OpenRequest;
use App\Http\Requests\WorkShiftRequest;
use App\Http\Resources\WorkShiftResource;
use App\Models\User;
use App\Models\WorkShift;
use Illuminate\Support\Facades\DB;

class WorkShiftController
{
    public function store(WorkShiftRequest $request)
    {
        $workShift = WorkShift::create($request->all());
        return new WorkShiftResource($workShift);
    }

    public function open(WorkShift $id, OpenRequest $openRequest)
    {
        $workShift = new WorkShiftResource($id->open());
        return response()->json([
            'data' => [
                'id' => $workShift->id,
                'start' => $workShift->start,
                'end' => $workShift->end,
                'active' => $workShift->active,
            ]
        ]);
    }

    public function close(WorkShift $id, CloseRequest $closeRequest)
    {
        $workShift = new WorkShiftResource($id->close());
        return response()->json([
            'data' => [
                'id' => $workShift->id,
                'start' => $workShift->start,
                'end' => $workShift->end,
                'active' => $workShift->active,
            ]
        ]);
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
