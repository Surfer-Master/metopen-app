<?php

class DataModel extends Connection
{
    // protected untuk kebutuhan variabel
    protected $ph_air;
    protected $suhu_air;
    protected $kekeruhan;
    protected $suhu_lingkungan;
    protected $kelembaban_lingkungan;
    protected $asal_air_id;
    protected $status;

    protected function findAll()
    {
        $sql = "SELECT data.*, asal_air.asal FROM data LEFT OUTER JOIN asal_air ON data.asal_air_id = asal_air.id";
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