<?php

class ProvinceController extends BaseController {

    protected $province;

    public function __construct(Province $province)
    {
        $this->province = $province;
    }

    public function getAll()
    {
        $limit = Input::get('limit', 100);
        $offset = Input::get('offset', 0);

        return XApi::parser($this->province->allProvincePaged($limit, $offset), false);
    }

    public function getOne($id)
    {
        return XApi::parser($this->province->OneProvince($id), false);
    }
}
