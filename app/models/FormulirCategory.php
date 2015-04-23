<?php

class FormulirCategory extends \Eloquent{
    protected $fillable = array('id','name','description', 'form_id', 'parent_id', 'master_id', 'has_value');
    protected $hidden = array('created_at', 'updated_at', 'formulir_id', 'master_id');
    protected $table = 'formulir_categories';

    public function formulirs()
    {
        return $this->belongsTo('Formulir', 'formulir_id', 'id');
    }

    public function voices()
    {
        return $this->hasMany('Voice');
    }

    public function allCategoriePaged($limit, $offset, $params=array())
    {
        return 2;
    }

    public function OneCategory($anggaran_id)
    {
        return 1;
    }
}
