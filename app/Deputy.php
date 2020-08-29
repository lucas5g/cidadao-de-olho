<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deputy extends Model
{

    public function get()
    {
        $deputies = $this::orderBy('name')
            ->get();

        return $deputies;
      
    }

    // public function month()
    // {
    //     // return $this->belongsTo(Indemnity::class, 'id');
    //     return $this->hasOne(Indemnity::class)
    //         ->select('deputy_id', Indemnity::raw('sum(value) as value'))
    //         ->groupBy('deputy_id')
    //         ->orderByDesc('value')
    //         ;
    // }

 
    public function create($data)
    {
        $this::truncate();
        return $this::insert($data);
    }
}
