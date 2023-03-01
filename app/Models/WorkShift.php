<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    protected $fillable = [
        'start',
        'end',
        'active'
    ];

    public function open()
    {
        $this->active = true;
        $this->save();
        return $this;
    }

    public function close()
    {
        $this->active = false;
        $this->save();
        return $this;
    }

    public function workers()
    {
        return $this->belongsToMany(User::class, 'shift_workers');
    }

    public function hasUser(User $user)
    {
        return $this->workers()->where(['user_id' => $user->id])->exists();
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, ShiftWorker::class);
    }

}
