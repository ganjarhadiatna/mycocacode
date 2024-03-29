<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TagModel extends Model
{
    protected $table = 'tags';

    function scopeAddTags($query, $data)
    {
        return DB::table('tags')
        ->insert($data);
    }
    function scopeGetTagBYId($query, $idtags)
    {
        return DB::table('tags')
        ->where('tags.idtags', $idtags)
        ->value('tags.tag');
    }
    function scopeGetTags($query, $idstory)
    {
        return DB::table('tags')
        ->select('idtags', 'tag')
        ->where('tags.idstory', $idstory)
        ->orderBy('tags.idtags', 'asc')
        ->get();
    }
    function scopeDeleteTags($query, $idstory)
    {
        return DB::table('tags')
        ->where('tags.idstory', $idstory)
        ->delete();
    }
    function scopeTopTags($query, $limit)
    {
    	return DB::table('tags')
        ->select(
            'idtags',
            'tag',
            DB::raw('count(idtags) as ttl_tag')
        )
        ->groupBy('tag')
        ->orderBy('ttl_tag', 'desc')
        ->limit($limit)
        ->get();
    }
    function scopeAllTags($query)
    {
        return DB::table('tags')
        ->select(
            'idtags',
            'tag',
            DB::raw('count(idtags) as ttl_tag')
        )
        ->groupBy('tag')
        ->having('ttl_tag','>','0')
        ->orderBy('tag', 'asc')
        ->get();
    }
    function scopeTopSmallTags($query, $limit = 8)
    {
        return DB::table('tags')
        ->select(
            'idtags',
            'tag',
            DB::raw('count(idtags) as ttl_tag')
        )
        ->groupBy('tag')
        ->orderBy('ttl_tag', 'desc')
        ->limit($limit)
        ->get();
    }
    function scopeSearchTags($query, $ctr)
    {
        $searchValues = preg_split('/\s+/', $ctr, -1, PREG_SPLIT_NO_EMPTY);
        return DB::table('tags')
        ->select(
            'idtags',
            'tag',
            DB::raw('count(idtags) as ttl_tag')
        )
        ->where(function ($q) use ($searchValues)
        {
            foreach ($searchValues as $value) {
                $q->orWhere('tags.tag','like',"%$value%");
            }
        })
        ->groupBy('tag')
        ->orderBy('ttl_tag', 'desc')
        ->limit(15)
        ->get();
    }
}
