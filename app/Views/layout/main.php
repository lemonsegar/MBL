<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Rental Dashboard &mdash; Stisla</title>


  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/owlcarousel2/dist/<?= base_url() ?>/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/owlcarousel2/dist/<?= base_url() ?>/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/modules/select2/dist/css/select2.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">
  <!-- Start GA -->

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">


  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <?php if (current_url() == base_url('pelanggan')): ?>
    <?php include(APPPATH . 'Views/pelanggan/modalpelanggan.php'); ?>
  <?php endif; ?>


  <?php if (current_url() == base_url('datamobil')): ?>
    <?php include(APPPATH . 'Views/datamobil/modalmobil.php'); ?>
  <?php endif; ?>

  <?php if (current_url() == base_url('karyawan')): ?>
    <?php include(APPPATH . 'Views/karyawan/modalkaryawan.php'); ?>
  <?php endif; ?>

  <?php if (current_url() == base_url('user')): ?>
    <?php include(APPPATH . 'Views/user/modaluser.php'); ?>
  <?php endif; ?>



  <?php
  $currentUrl = current_url();
  if (
    strtolower($currentUrl) == strtolower(base_url('Peminjam')) ||
    $currentUrl == base_url('Peminjam/tambah') ||
    $currentUrl == base_url('Peminjam/edit') ||
    strpos($currentUrl, base_url('Peminjam/formedit')) !== false ||
    strpos($currentUrl, '/Peminjam/edit/') !== false  // Tambahan pengecekan untuk edit dengan ID
  ): ?>
    <?php include(APPPATH . 'Views/peminjam/modalpeminjaman.php'); ?>
  <?php endif; ?>
  <?php
  $currentUrl = current_url();
  if (
    strtolower($currentUrl) == strtolower(base_url('Pengembalian')) ||
    $currentUrl == base_url('Pengembalian/tambah') ||
    $currentUrl == base_url('Pengembalian/edit') ||
    strpos($currentUrl, base_url('Pengembalian/formedit')) !== false ||
    strpos($currentUrl, '/Pengembalian/edit/') !== false  // Tambahan pengecekan untuk edit dengan ID
  ): ?>
    <?php include(APPPATH . 'Views/pengembalian/modalpengembalian.php'); ?>
  <?php endif; ?>




  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <?php include 'navbar.php' ?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Rental Mobil Bagindo</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">RM</a>
          </div>

          <!-- Menu sidebar yang benar -->
          <ul class="sidebar-menu">
            <?php include 'menu.php' ?>
          </ul>


        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <?= $this->rendersection('isi') ?>
        </section>
      </div>

      <!-- Footer section -->
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= date('Y') ?> <div class="bullet"></div> Rental Mobil Bagindo
        </div>
        <div class="footer-right">
          v1.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/popper.js"></script>
  <script src="<?= base_url() ?>/assets/modules/tooltip.js"></script>
  <script src="<?= base_url() ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/moment.min.js"></script>
  <script src="<?= base_url() ?>/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?= base_url() ?>/assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/chart.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?= base_url() ?>/assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?= base_url() ?>/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= base_url() ?>/assets/js/page/index.js"></script>

  <!-- Template JS File -->
  <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
  <script src="<?= base_url() ?>/assets/js/custom.js"></script>
  <script src="<?= base_url() ?>/assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?= $this->renderSection('js') ?>


</body>

</html>