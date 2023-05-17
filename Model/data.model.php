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
        $sql = "SELECT data.*, asal_air.asal, status_air.status FROM data LEFT OUTER JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id";
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
        $sql = "SELECT created_at, asal, ph_air, suhu_air, kekeruhan, suhu_lingkungan, kelembaban_lingkungan, status, kelayakan FROM data LEFT OUTER JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id ORDER BY created_at DESC LIMIT 1";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }

    protected function airLayakMinum()
    {
        $sql = "SELECT data.*, asal_air.asal AS asal_air_asal, status_air.status AS status_air_status FROM data JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id JOIN (SELECT asal_air_id, MAX(created_at) AS max_created_at FROM data WHERE kelayakan = true GROUP BY asal_air_id ) AS max_created ON data.asal_air_id = max_created.asal_air_id AND data.created_at = max_created.max_created_at";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }
    protected function airTidakLayakMinum()
    {
        $sql = "SELECT data.*, asal_air.asal AS asal_air_asal, status_air.status AS status_air_status FROM data JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id JOIN (SELECT asal_air_id, MAX(created_at) AS max_created_at FROM data WHERE kelayakan = false GROUP BY asal_air_id ) AS max_created ON data.asal_air_id = max_created.asal_air_id AND data.created_at = max_created.max_created_at";
        $result = $this->connect()->query($sql);
        if($result->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $datas[] = $data;
            }
            return $datas;
        }
    }
    // protected function scoreBoxLayakMinum()
    // {
    //     $sql = "SELECT COUNT(kelayakan) AS layak_diminum FROM data WHERE kelayakan = true";
    //     $result = $this->connect()->query($sql);
    //     if($result->num_rows > 0) {
    //         while ($data = mysqli_fetch_assoc($result)) {
    //             $datas[] = $data;
    //         }
    //         return $datas;
    //     }
    // }

    // protected function detailScoreBoxLayakMinum()
    // {
    //     $sql = "SELECT data.*, asal_air.asal, status_air.status FROM data LEFT OUTER JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id WHERE kelayakan = true";
    //     $result = $this->connect()->query($sql);
    //     if($result->num_rows > 0) {
    //         while ($data = mysqli_fetch_assoc($result)) {
    //             $datas[] = $data;
    //         }
    //         return $datas;
    //     }
    // }
    
    // protected function scoreBoxTidakLayakMinum()
    // {
    //     $sql = "SELECT COUNT(kelayakan) AS tidak_layak_diminum FROM data WHERE kelayakan = false";
    //     $result = $this->connect()->query($sql);
    //     if($result->num_rows > 0) {
    //         while ($data = mysqli_fetch_assoc($result)) {
    //             $datas[] = $data;
    //         }
    //         return $datas;
    //     }
    // }

    // protected function detailScoreBoxTidakLayakMinum()
    // {
    //     $sql = "SELECT data.*, asal_air.asal, status_air.status FROM data LEFT OUTER JOIN asal_air ON data.asal_air_id = asal_air.id JOIN status_air ON data.status_air_id = status_air.id WHERE kelayakan = false";
    //     $result = $this->connect()->query($sql);
    //     if($result->num_rows > 0) {
    //         while ($data = mysqli_fetch_assoc($result)) {
    //             $datas[] = $data;
    //         }
    //         return $datas;
    //     }
    // }
}

