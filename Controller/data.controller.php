<?php

class DataController extends DataModel
{
    public function get_Data()
    {
        return $this->findAll();
    }
}

?>