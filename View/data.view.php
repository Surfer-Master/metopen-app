<?php

class DataView extends DataController
{
    public function show()
    {
        $datas = $this->get_Data();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Diminum";
                } else {
                    $keterangan = "Tidak Layak Diminum";
                }
                ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['created_at']/* = date("H:i:s") */ ?></td>
                    <td><?php echo $data['ph_air'] ?></td>
                    <td><?php echo $data['suhu_air'] ?></td>
                    <td><?php echo $data['kekeruhan'] ?></td>
                    <td><?php echo $data['suhu_lingkungan'] ?></td>
                    <td><?php echo $data['kelembaban_lingkungan'] ?></td>
                    <td><?php echo $data['asal'] ?></td>
                    <td><?php echo $data['status'] ?></td>
                    <td><?php echo $keterangan ?></td>
                    <td>
                        <?php echo
                        "<a class='text-decoration-none' href='grafik.php?asal-air=" . $data['asal'] . "'>
                                <button class='btn btn-sm btn-info'>
                                    <i class='bi bi-journal-text me-2'></i>Tampilkan
                                </button>
                            </a>";
                        ?>
                    </td>
                </tr>
            <?php
            }
        }
    }

    public function showIndex()
    {
        $datas = $this->get_Data_Index();
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Diminum";
                } else {
                    $keterangan = "Tidak Layak Diminum";
                }
                ?>
                <tr>
                    <td><?php echo $data['asal_air_asal'] ?></td>
                    <td><?php echo $data['created_at']?></td>
                    <td><?php echo $data['ph_air'] ?></td>
                    <td><?php echo $data['suhu_air'] ?></td>
                    <td><?php echo $data['kekeruhan'] ?></td>
                    <td><?php echo $data['suhu_lingkungan'] ?></td>
                    <td><?php echo $data['kelembaban_lingkungan'] ?></td>
                    <td><?php echo $data['status_air_status'] ?></td>
                    <td>
                        <span class="bg-success fw-bold text-white p-1 border-0 border-bottom rounded-2 ps-2 pe-2">
                            <?php echo $keterangan ?>
                        </span>
                    </td>
                </tr>
            <?php
            }
        }
    }

    public function jumlahAirLayakMinum()
    {
        $datas = $this->get_jumlah_layak_diminum();
        $jumlah = count($datas);
        if ($datas != null) { ?>
            <span><?= $jumlah ?></span>
        <?php
        }
    }

    public function jumlahAirTidakLayakMinum()
    {
        $datas = $this->get_jumlah_tidak_layak_diminum();
        $jumlah = count($datas);
        if ($datas != null) { ?>
            <span><?= $jumlah ?></span>
            <?php
        }
    }

    public function detailLayakMinum()
    {
        $datas = $this->get_detail_layak_diminum();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Diminum";
                } else {
                    $keterangan = "Tidak Layak Diminum";
                }
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['asal_air_asal'] ?></td>
                    <td><?php echo $data['status_air_status'] ?></td>
                    <td><?php echo $keterangan ?></td>
                    <td><?php echo $data['created_at'] ?></td>
                    <td>
                        <?php echo
                        "<a class='text-decoration-none' href='rincian-air-layak-diminum.php?asal-air=" . $data['asal_air_asal'] . "'>
                                <button class='btn btn-sm btn-info'>
                                    <i class='bi bi-eye-fill me-2'></i></i>Rincian
                                </button>
                            </a>";
                        ?>
                    </td>
                </tr>
                <?php $no++ ?>
            <?php
            }
        }
    }

    public function detailTidakLayakMinum()
    {
        $datas = $this->get_detail_tidak_layak_diminum();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <?php
                if ($data['kelayakan'] == true) {
                    $keterangan = "Layak Diminum";
                } else {
                    $keterangan = "Tidak Layak Diminum";
                }
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['asal_air_asal'] ?></td>
                    <td><?php echo $data['status_air_status'] ?></td>
                    <td><?php echo $keterangan ?></td>
                    <td><?php echo $data['created_at'] ?></td>
                    <td> <?php echo
                            "<a class='text-decoration-none' href='rincian-air-tidak-layak-diminum.php?asal-air=" . $data['asal_air_asal'] . "'>
                                <button class='btn btn-sm btn-info'>
                                    <i class='bi bi-eye-fill me-2'></i></i>Rincian
                                </button>
                            </a>";
                            ?> </td>
                </tr>
                <?php $no++ ?>
<?php
            }
        }
    }
}
?>