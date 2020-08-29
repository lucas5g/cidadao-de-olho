<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indemnity extends Model
{
    public function get($year, $month)
    {
        return  $this::with('deputy')
        ->where('dateReference', 'LIKE', "{$year}-{$month}%")
        ->select($this::raw('deputy_id, sum(value) as monthValue'))
        ->groupBy('deputy_id')
        ->orderByDesc('monthValue')
        ->get();   
    }

    public function deputy()
    {
        return $this->belongsTo(Deputy::class);
    }
}
