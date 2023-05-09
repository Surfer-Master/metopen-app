<?php

class DataModel extends Connection
{
    // protected untuk kebutuhan variabel
    protected $ph_air;
    protected $suhu_air;
    protected $kekeruhan;
    protected $suhu_lingkungan;
    protected $kelembaban_lingkungan;
    protected $asal_air;
    protected $status;

    protected function findAll()
    {
        $sql = "SELECT * FROM data";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }
}

?>