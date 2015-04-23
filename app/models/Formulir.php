<?php

class Formulir extends \Eloquent{
    protected $fillable = array('id','name','description');
    protected $hidden = array('created_at', 'updated_at');
    protected $table = 'formulirs';

    public function formulirCategories()
    {
        return $this->hasMany('FormulirCategory', 'formulir_id');
    }

    public function allFormulirPaged($limit, $offset, $params=array())
    {
        return Formulir::limit($limit)->offset($offset)->get()->toArray();
    }

    public function OneFormulir($formulir_id)
    {
        return Formulir::where('id', $formulir_id)->with(array('formulirCategories'))->get()->toArray();
    }
}
