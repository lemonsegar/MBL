<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>


    <li>
        <a href="<?= site_url('layout/index') ?>" class="waves-effect">
            <i class="mdi mdi-airplay"></i>
            <span>Beranda</span>
        </a>
    </li>

    <?php if (session()->get('level') == 1) { ?>
        <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> 
              <span>Master </span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('pelanggan/index')?>">Pelanggan</a></li>
                <li><a class="nav-link" href="<?= site_url('datamobil/index')?>">Data Mobil</a></li>
                <li><a class="nav-link" href="<?= site_url('karyawan/index')?>">Karyawan</a></li>
                <li><a class="nav-link" href="<?= site_url('user/index')?>">Data User</a></li>
              </ul>
            </li>
    

            <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> 
              <span>Transaksi</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('Peminjam/index')?>">Peminjan Mobil</a></li>
                <li><a class="nav-link" href="<?= site_url('datamobil/index')?>">Kembalikan Mobil</a></li>
              </ul>
            </li>

            <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> 
              <span>Laporan</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= site_url('pelanggan/index')?>">Lap Pelanggan</a></li>
                <li><a class="nav-link" href="<?= site_url('datamobil/index')?>">Lap Data Mobil</a></li>
                <li><a class="nav-link" href="<?= site_url('karyawan/index')?>">Lap Karyawan</a></li>
                <li><a class="nav-link" href="<?= site_url('user/index')?>">Lap Data User</a></li>
                <li><a class="nav-link" href="<?= site_url('pelanggan/index')?>">Lap Peminjaman Mobil</a></li>
                <li><a class="nav-link" href="<?= site_url('datamobil/index')?>">Lap Kembalian Mobil</a></li>
                <li><a class="nav-link" href="<?= site_url('karyawan/index')?>">Lap Transaksi</a></li>
              </ul>
            </li>
    <?php } ?>


    <?php if (session()->get('level') == 2) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Transaksi</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('dokter/index') ?>">Uang Masuk</a></li>
            <li><a href="charts-chartist.html">Uang Keluar</a></li>
        </ul>
    </li>
    <?php } ?>


    <?php if (session()->get('level') == 3) { ?>
    <li class="has_sub">
        <a href="javascript:void(0);" class="waves-effect">
            <i class="mdi mdi-gauge"></i>
            <span>Laporan</span>
            <span class="float-right">
                <i class="mdi mdi-chevron-right"></i>
            </span>
        </a>
        <ul class="list-unstyled">
            <li><a href="<?= site_url('dokter/index') ?>">Data Pengurus</a></li>
            <li><a href="charts-chartist.html">Data Donatur</a></li>
            <li><a href="charts-chartjs.html">Data Anak Yatim</a></li>
            <li><a href="charts-chartjs.html">Kas Masjid</a></li>
            <li><a href="charts-chartjs.html">Kas Anak Yatim</a></li>
            <li><a href="charts-chartjs.html">Kas TPQ</a></li>
        </ul>
    </li>

    <?php } ?>

<?= $this->endSection('') ?>