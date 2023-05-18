<?php

class DataController extends DataModel
{
    public function get_Data()
    {
        return $this->findAll();
    }

    public function get_Data_Index()
    {
        return $this->findAllIndex();
    }

    public function get_jumlah_layak_diminum()
    {
        return $this->airLayakMinum();
    }

    public function get_detail_layak_diminum()
    {
        return $this->airLayakMinum();
    }
    
    public function get_jumlah_tidak_layak_diminum()
    {
        return $this->airTidakLayakMinum();
    }

    public function get_detail_tidak_layak_diminum()
    {
        return $this->airTidakLayakMinum();
    }
}

?>