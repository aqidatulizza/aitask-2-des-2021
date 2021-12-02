<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'deadline',
        'project_id',
        'user_id',
        'company_id',
        'status_id',
        'file',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function tasksUsers(){
        return $this->hasMany('App\TaskUser');
    }

    public function itemChecklist(){
        return $this->hasMany('App\ItemChecklist');
    }


    //polymorphic relationship
    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }
}
