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
        <h2>LAPORAN DATA PENGEMBALIAN MOBIL</h2>
        <h3>PT. NAMA PERUSAHAAN</h3>
        <p>Jl. Alamat Perusahaan No. XX, Kota</p>
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
                <th class="text-center" width="4%">No</th>
                <th width="10%">No Faktur</th>
                <th width="8%">Tgl Pinjam</th>
                <th width="8%">Tgl Kembali</th>
                <th width="8%">Tgl Dikembalikan</th>
                <th width="15%">Pelanggan</th>
                <th width="15%">Mobil</th>
                <th class="text-right" width="11%">Total Sewa</th>
                <th class="text-right" width="10%">Denda</th>
                <th class="text-right" width="11%">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_sewa = 0;
            $total_denda = 0;
            $total_bayar = 0;
            foreach ($pengembalian as $row):
                $total_sewa += $row['total'];
                $total_denda += $row['denda'];
                $total_bayar += ($row['total'] + $row['denda']);
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $row['faktur'] ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tanggalkembali'])) ?></td>
                    <td><?= date('d/m/Y', strtotime($row['tgldikembalikan'])) ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                    <td><?= $row['merek'] ?> - <?= $row['noplat'] ?></td>
                    <td class="text-right">Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                    <td class="text-right">Rp <?= number_format($row['denda'], 0, ',', '.') ?></td>
                    <td class="text-right">Rp <?= number_format($row['total'] + $row['denda'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right"><strong>Total</strong></td>
                <td class="text-right"><strong>Rp <?= number_format($total_sewa, 0, ',', '.') ?></strong></td>
                <td class="text-right"><strong>Rp <?= number_format($total_denda, 0, ',', '.') ?></strong></td>
                <td class="text-right"><strong>Rp <?= number_format($total_bayar, 0, ',', '.') ?></strong></td>
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