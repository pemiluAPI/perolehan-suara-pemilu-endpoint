<?php

class Pemilu extends \Eloquent{
    protected $fillable = array('id','name','description');
    protected $hidden = array('created_at', 'updated_at');
    protected $table = 'pemilus';

    public function voices()
    {
        return $this->hasMany('Voice', 'pemilu_id');
    }

    public function allPemilusPaged($limit, $offset, $params=array())
    {
        return Pemilu::limit($limit)->offset($offset)->get()->toArray();
    }

    public function OnePemilu($pemilu_id)
    {
        return 1;
    }
}
