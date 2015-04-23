<?php

class Wilayah extends \Eloquent{
    protected $fillable = array('id', 'province_id', 'name','full_name', 'english_name');
    protected $hidden = array('created_at', 'updated_at', 'full_name');
    protected $table = 'wilayahes';

    public function province()
    {
        $this->belongsTo('Province');
    }

    public function allWilayahPaged($limit, $offset, $params=array())
    {
        return 2;
    }

    public function OneWilayah($anggaran_id)
    {
        return 1;
    }
}
