<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{

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

    protected $fillable = [
        'start',
        'end',
        'active',
    ];
}
