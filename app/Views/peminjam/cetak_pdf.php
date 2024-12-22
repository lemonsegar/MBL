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

        .text-center {
            text-align: center;
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
        <h2>LAPORAN DATA PEMINJAMAN MOBIL</h2>
        <h3>RENTAL MOBIL BAGINDO</h3>
    </div>

    <div class="info">
        <table style="width: 100%; border: none;">
            <tr>
                <td style="border: none; width: 120px;">Tanggal Cetak</td>
                <td style="border: none; width: 10px;">:</td>
                <td style="border: none;"><?= $tgl_cetak ?></td>
            </tr>
            <tr>
                <td style="border: none;">Periode</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $periode ?></td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="10%">No Faktur</th>
                <th width="10%">Tanggal</th>
                <th width="20%">Pelanggan</th>
                <th width="20%">Mobil</th>
                <th class="text-center" width="5%">Lama</th>
                <th class="text-right" width="15%">Total</th>
                <th width="15%">Tgl Kembali</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total = 0;
            foreach ($peminjaman as $row):
                $total += $row['total'];
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $row['faktur'] ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['merek'] ?> - <?= $row['noplat'] ?></td>
                    <td class="text-center"><?= $row['lama'] ?> Hari</td>
                    <td class="text-right">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggalkembali'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($total, 0, ',', '.') ?></strong></td>
                <td></td>
            </tr>
        </tfoot>
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