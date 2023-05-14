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

    public function get_layak_diminum()
    {
        return $this->scoreBoxLayakMinum();
    }

    public function get_Tidak_layak_diminum()
    {
        return $this->scoreBoxTidakLayakMinum();
    }
}

?>