<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemChecklist extends Model
{
    //
    protected $fillable = [
        'item',
        'user_id',
        'task_id',
    ];

    public function task(){
        return $this->belongsTo('App\Task');
    }
}
