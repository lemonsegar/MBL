<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3 {
            margin: 2px 0;
        }

        .info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: right;
            font-size: 10px;
        }

        .ttd {
            float: right;
            width: 200px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LAPORAN DATA KARYAWAN</h2>
        <h3>RENTAL MOBIL BAGINDO</h3>
    </div>

    <div class="info">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="border: none; width: 120px;">Tanggal Cetak</td>
                <td style="border: none; width: 10px;">:</td>
                <td style="border: none;"><?= $tgl_cetak ?></td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">ID Karyawan</th>
                <th width="35%">Nama</th>
                <th width="20%">No HP</th>
                <th width="25%">No Identitas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($karyawan as $row):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['idkaryawan'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['nohp'] ?></td>
                    <td><?= $row['nointitas'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="ttd">
        <p>........................., <?= date('d-m-Y') ?></p>
        <p>Mengetahui,</p>
        <br><br><br>
        <p>(_________________________)</p>
        <p>Manager</p>
    </div>

    <div class="footer">
        Dicetak pada: <?= date('d-m-Y H:i:s') ?>
    </div>
</body>

</html>