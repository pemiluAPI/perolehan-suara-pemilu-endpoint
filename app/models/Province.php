<?php

class Province extends \Eloquent{
    protected $fillable = array('id','name','full_name', 'english_name');
    protected $hidden = array('created_at', 'updated_at');
    protected $table = 'provinces';

    public function wilayahes()
    {
        return $this->hasMany('Wilayah');
    }

    public function allProvincesPaged($limit, $offset, $params=array())
    {
        return 2;
    }

    public function OneProvince($anggaran_id)
    {
        return 1;
    }
}
