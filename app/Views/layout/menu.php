

<!-- Dashboard -->
<li class="<?= current_url(true)->getSegment(2) == 'index' ? 'active' : '' ?>">
    <a href="<?= site_url('layout/index') ?>" class="nav-link">
        <i class="fas fa-fire"></i>
        <span>Beranda</span>
    </a>
</li>

<!-- Menu untuk Admin -->
<?php if (session()->get('level') == 1) : ?>
    <li class="menu-header">Master Data</li>
    <li class="nav-item dropdown <?= current_url(true)->getSegment(2) == 'master' ? 'active' : '' ?>">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-database"></i>
            <span>Master</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('pelanggan') ?>">Pelanggan</a></li>
            <li><a class="nav-link" href="<?= site_url('datamobil') ?>">Data Mobil</a></li>
            <li><a class="nav-link" href="<?= site_url('karyawan') ?>">Karyawan</a></li>
            <li><a class="nav-link" href="<?= site_url('user') ?>">Data User</a></li>
        </ul>
    </li>

    <li class="menu-header">Transaksi</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-exchange-alt"></i>
            <span>Transaksi</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('Peminjam/index') ?>">Peminjaman Mobil</a></li>
            <li><a class="nav-link" href="<?= site_url('datamobil/index') ?>">Pengembalian Mobil</a></li>
        </ul>
    </li>

    <li class="menu-header">Laporan</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-file-alt"></i>
            <span>Laporan</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('pelanggan/index') ?>">Lap. Pelanggan</a></li>
            <li><a class="nav-link" href="<?= site_url('datamobil/index') ?>">Lap. Data Mobil</a></li>
            <li><a class="nav-link" href="<?= site_url('karyawan/index') ?>">Lap. Karyawan</a></li>
            <li><a class="nav-link" href="<?= site_url('user/index') ?>">Lap. Data User</a></li>
            <li><a class="nav-link" href="<?= site_url('pelanggan/index') ?>">Lap. Peminjaman</a></li>
            <li><a class="nav-link" href="<?= site_url('datamobil/index') ?>">Lap. Pengembalian</a></li>
            <li><a class="nav-link" href="<?= site_url('karyawan/index') ?>">Lap. Transaksi</a></li>
        </ul>
    </li>
<?php endif; ?>

<!-- Menu untuk Kasir -->
<?php if (session()->get('level') == 2) : ?>
    <li class="menu-header">Transaksi Keuangan</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-money-bill-wave"></i>
            <span>Transaksi</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('dokter/index') ?>">Uang Masuk</a></li>
            <li><a class="nav-link" href="charts-chartist.html">Uang Keluar</a></li>
        </ul>
    </li>
<?php endif; ?>

<!-- Menu untuk Pimpinan -->
<?php if (session()->get('level') == 3) : ?>
    <li class="menu-header">Laporan</li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-chart-bar"></i>
            <span>Laporan</span>
        </a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="<?= site_url('dokter/index') ?>">Data Pengurus</a></li>
            <li><a class="nav-link" href="charts-chartist.html">Data Donatur</a></li>
            <li><a class="nav-link" href="charts-chartjs.html">Data Anak Yatim</a></li>
            <li><a class="nav-link" href="charts-chartjs.html">Kas Masjid</a></li>
            <li><a class="nav-link" href="charts-chartjs.html">Kas Anak Yatim</a></li>
            <li><a class="nav-link" href="charts-chartjs.html">Kas TPQ</a></li>
        </ul>
    </li>
<?php endif; ?>

