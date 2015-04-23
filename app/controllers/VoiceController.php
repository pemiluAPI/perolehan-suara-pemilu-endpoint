<?php

class VoiceController extends BaseController {

    protected $voice;

    public function __construct(Voice $voice)
    {
        $this->voice = $voice;
    }

    public function getAll()
    {
        $limit = Input::get('limit', 100);
        $offset = Input::get('offset', 0);
        $params = array(
            'formulir' => Input::get('formulir', 0),
            'provinsi' => Input::get('provinsi', 0),
            'wilayah' => Input::get('wilayah', 0),
            'pemilu' => Input::get('pemilu', 0),
            );

        return XApi::parser($this->voice->allVoicesPaged($limit, $offset, $params), false);
    }

    public function getOne($id)
    {
        return XApi::parser($this->voice->OneVoice($id), false);
    }
}
