<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
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

        .text-right {
            text-align: right;
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
        <h2>LAPORAN DATA MOBIL</h2>
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
                <th width="10%">ID Mobil</th>
                <th width="10%">Merk</th>
                <th width="10%">Tahun</th>
                <th width="10%">No Polisi</th>
                <th width="10%">Status</th>
                <th width="15%">Harga Sewa</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($mobil as $row):
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['idmobil'] ?></td>
                    <td><?= $row['merek'] ?></td>
                    <td><?= $row['tahun'] ?></td>
                    <td><?= $row['noplat'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td class="text-right"><?= number_format($row['hrgsewa'], 0, ',', '.') ?></td>
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