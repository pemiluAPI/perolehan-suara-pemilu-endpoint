<?php

class Voice extends \Eloquent{
    protected $fillable = array('id', 'category_id', 'province_id', 'wilayah_id', 'value');
    protected $hidden = array('created_at', 'updated_at');
    protected $table = 'voices';

    public function pemilus()
    {
        return $this->belongsTo('Pemilu');
    }

    public function formulirCategories()
    {
        return $this->belongsTo('FormulirCategory');
    }

    public function provinces()
    {
        return $this->belongsTo('Province');
    }

    public function wilayahes()
    {
        return $this->belongsTo('Wilayah', 'wilayah_id', 'id');
    }

    private function getProvinceOfWilayah($id_of_wilayah)
    {
        $id_of_provinsi = Wilayah::select('province_id')->where('id', '=', $id_of_wilayah)->get()->first();

        if (!empty($id_of_provinsi))
        {
            $id_of_provinsi = $id_of_provinsi->toArray();
            $id_of_provinsi = $id_of_provinsi['province_id'];
        }
        else
        {
            return false;
        }

        return $id_of_provinsi;
    }

    private function getOneOrAllWilayahes($id_of_provinsi, $id_of_wilayah)
    {
        // IF id of wilayah is set, that means it request one wilayah.
        if ($id_of_wilayah)
        {
            $provinces_wilayahes = Wilayah::select('wilayahes.id', 'wilayahes.name')
                ->where('wilayahes.id', $id_of_wilayah)
                ->leftJoin('provinces', 'province_id', '=', 'provinces.id')
                ->get()
                ->toArray();
        }
        else
        // IF id of wilayah is not set, that means it request all wilayahes.
        {
            $provinces_wilayahes = Wilayah::select('wilayahes.id', 'wilayahes.name')
                ->where('wilayahes.province_id', $id_of_provinsi)
                ->leftJoin('provinces', 'province_id', '=', 'provinces.id')
                // ->toSql();
                ->get()
                ->toArray();
        }

        return $provinces_wilayahes;
    }

    public function allVoicesPaged($limit, $offset, $params=array())
    {
        // Assign $params as single variable for each formulir, provinsi, wilayah, pemilu
        extract($params, EXTR_PREFIX_ALL, 'id_of');

        $data_of_voices = array();

        // Check variable value

        // Get province first
        if (!$id_of_provinsi && $id_of_wilayah)
        {
            $id_of_provinsi = $this->getProvinceOfWilayah($id_of_wilayah);
            if (!$id_of_provinsi)
            {
                return "Provinsi dan wilayah tidak ditemukan.";
            }
        }

        // Check pemilu and formulir ID
        if (($id_of_pemilu > 0) && ($id_of_formulir > 0))
        {
            // Get Wilayah by Province
            $provinces = Province::where('id', $id_of_provinsi)->get()->first();

            if (empty($provinces))
            {
                return "Provinsi tidak ditemukan";
            }

            $provinces = $provinces->toArray();

            $provinces_wilayahes = $this->getOneOrAllWilayahes($id_of_provinsi, $id_of_wilayah);

            if (empty($provinces_wilayahes))
            {
                $provinces['wilayah'] = "Wilayah tidak ditemukan.";
            }
            else
            {
                $provinces['wilayah'] = $provinces_wilayahes;

                $data_of_voices = array();

                // Search each value of category by wilayah
                foreach ($provinces_wilayahes as $k_wilayah => $wilayah) {
                    $formulirCategories = FormulirCategory::select('formulir_categories.id', 'formulir_categories.name', 'formulir_categories.description', 'formulir_categories.parent_id', 'formulir_categories.has_value')
                        ->leftJoin('formulirs', 'formulir_id', '=', 'formulirs.id')
                        ->where('formulirs.id', $id_of_formulir)
                        ->get()
                        ->toArray();

                    $voice_in_categories = array();

                    // get voice per category
                    foreach ($formulirCategories as $k_formulirCategory => $formulirCategory) {
                        $voice_of_category = Voice::where('category_id', $formulirCategory['id'])
                            ->where('province_id', $id_of_provinsi)
                            ->where('wilayah_id', $wilayah['id'])
                            ->where('pemilu_id', $id_of_pemilu)
                            ->get()
                            ->toArray();

                        $formulirCategories[$k_formulirCategory]['value'] = (!empty($voice_of_category)) ? $voice_of_category[0]['value'] : null;
                    }

                    $provinces['wilayah'][$k_wilayah]['voices'] = $formulirCategories;
                }
            }
            return $provinces;
        }
        else
        {
            return null;
        }

        return 2;
    }

    public function OneVoice($anggaran_id)
    {
        return 1;
    }
}
