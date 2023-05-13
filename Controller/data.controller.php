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
}

?>