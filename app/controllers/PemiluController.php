<?php

class PemiluController extends BaseController {

    protected $pemilu;

    public function __construct(Pemilu $pemilu)
    {
        $this->pemilu = $pemilu;
    }

    public function getAll()
    {
        $limit = Input::get('limit', 100);
        $offset = Input::get('offset', 0);
        $params = array();

        return XApi::parser($this->pemilu->allPemiluPaged($limit, $offset, $params), false);
    }

    public function getOne($id)
    {
        return XApi::parser($this->pemilu->OnePemilu($id), false);
    }
}
