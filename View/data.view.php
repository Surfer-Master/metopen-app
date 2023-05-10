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
                    <td><?php echo $no ?></td>
                    <td><?php echo $data['created_at'] = date("H:i:s") ?></td>
                    <td><?php echo $data['ph_air'] ?></td>
                    <td><?php echo $data['suhu_air'] ?></td>
                    <td><?php echo $data['kekeruhan'] ?></td>
                    <td><?php echo $data['suhu_lingkungan'] ?></td>
                    <td><?php echo $data['kelembaban_lingkungan'] ?></td>
                    <td><?php echo $data['asal_air'] ?></td>
                    <td><?php echo $data['status'] ?></td>
                    <td><?php echo
                        "<a class='text-decoration-none' href='grafik.php' data-id=" . $data['id'] . ">
                        <i class='bi bi-journal-text me-2'></i>Tampilkan                                                                                        
                    </a>" ?>
                    </td>
                </tr>
<?php
            }
        }
    }
}
?>