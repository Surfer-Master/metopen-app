<?php

class DataView extends DataController
{
    public function show()
    {
        $datas = $this->get_Data();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
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
                    <td><?php echo "<a class='text-decoration-none' href='grafik.php?asal_air=" . $data['asal'] . "'>
                        <i class='bi bi-journal-text me-2'></i>Tampilkan
                        </a>"; ?>
                    </td>
                </tr>
<?php
            }
        }
    }

    public function showIndex()
    {
        $datas = $this->get_Data_Index();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <tr>
                    <td class="text-start"><?php echo $no++ ?></td>
                    <td class="text-start"><?php echo $data['asal'] ?></td>
                    <td class="text-start">
                        <span class="bg-success fw-bold text-white p-1 border-0 border-bottom rounded-2 ps-2 pe-2">
                            <?php echo $data['status'] ?>
                        </span>
                    </td>
                </tr>
<?php
            }
        }
    }

    public function layakMinum()
    {
        $datas = $this->get_layak_diminum();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <span><?php echo $data['layak_diminum']?></span>
<?php
            }
        }
    }

    public function tidakLayakMinum()
    {
        $datas = $this->get_tidak_layak_diminum();
        $no = 1;
        if ($datas != null) {
            foreach ($datas as $data) { ?>
                <span><?php echo $data['tidak_layak_diminum']?></span>
<?php
            }
        }
    }
}
?>