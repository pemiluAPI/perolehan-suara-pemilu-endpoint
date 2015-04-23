<?php

class FormulirController extends BaseController {

    protected $formulir;

    public function __construct(Formulir $formulir)
    {
        $this->formulir = $formulir;
    }

    public function getAll()
    {
        $limit = Input::get('limit', 100);
        $offset = Input::get('offset', 0);
        $params = array();

        return XApi::parser($this->formulir->allFormulirPaged($limit, $offset, $params), false);
    }

    public function getOne($id)
    {
        return XApi::parser($this->formulir->oneFormulir($id), false);
    }
}
