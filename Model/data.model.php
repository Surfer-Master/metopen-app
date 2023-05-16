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

    protected function findAllIndex()
    {
        $sql = "SELECT created_at, asal, ph_air, suhu_air, kekeruhan, suhu_lingkungan, kelembaban_lingkungan, status FROM data LEFT OUTER JOIN asal_air ON data.asal_air_id = asal_air.id ORDER BY created_at DESC LIMIT 1";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }

    protected function scoreBoxLayakMinum()
    {
        $sql = "SELECT COUNT(status) AS layak_diminum FROM data WHERE status = 'Layak Diminum'";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }

    protected function scoreBoxTidakLayakMinum()
    {
        $sql = "SELECT COUNT(status) AS tidak_layak_diminum FROM data WHERE status = 'Tidak Layak Diminum'";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }
}

