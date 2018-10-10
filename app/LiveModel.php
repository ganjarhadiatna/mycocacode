<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LiveModel extends Model
{
	//insert
    function scopeAdd($query, $data)
    {
        return DB::table('lives')->insert($data);
    }

    //read
    function scopeGetID($query)
    {
        return DB::table('lives')
        ->orderBy('idlives', 'desc')
        ->limit(1)
        ->value('idlives');
    }
    function scopeFreshLives($query, $limit)
    {
        if (Auth::id()) {
            $id = Auth::id();
        } else {
            $id = 0;
        }
        return DB::table('lives')
        ->select(
            'lives.idlives',
            'lives.created',
            'lives.title',
            'lives.description',
            'lives.views',
            'lives.code',
            'lives.image',
            'users.id',
            'users.name',
            'users.username',
            'users.visitor',
            'users.foto'
        )
        ->join('users','users.id', '=', 'lives.id')
        ->orderBy('lives.idlives', 'desc')
        ->simplePaginate($limit);
    }
}
