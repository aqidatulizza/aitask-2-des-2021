<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    //
    protected $fillable = [
        'checklist',
        'user_id',
        'task_id'
    ];
}
