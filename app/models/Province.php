<?php

class Province extends \Eloquent{
    protected $fillable = array('id','name','full_name', 'english_name');
    protected $hidden = array('created_at', 'updated_at');
    protected $table = 'provinces';

    public function wilayah()
    {
        return $this->hasMany('Wilayah');
    }

    public function allProvincePaged($limit, $offset)
    {
        return Province::limit($limit)->offset($offset)->get()->toArray();
    }

    public function OneProvince($province_id)
    {
        $province = Province::find($province_id);

        return (!empty($province)) ? $province->with('wilayah')->first()->toArray() : "Propinsi tidak ditemukan.";
    }
}
