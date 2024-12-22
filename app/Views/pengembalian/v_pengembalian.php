<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Pengembalian Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <a type="button" class="btn btn-sm btn-primary" href="<?= site_url('Pengembalian/tambah') ?>">
                                Tambah Data
                            </a>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapengembalian">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Faktur</th>
                                                <th>Nama Pelanggan</th>
                                                <th>No Polisi</th>
                                                <th>Tgl Dikembalikan</th>
                                                <th>Denda</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($pengembalian as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['faktur'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['noplat'] ?></td>
                                                    <td><?= date('d/m/Y', strtotime($val['tgldikembalikan'])) ?></td>
                                                    <td>Rp <?= number_format($val['denda'],0,',','.') ?></td>
                                                    <td>
                                                        <a type="button" class="btn btn-info btn-sm btn-edit" href="<?= site_url('Pengembalian/edit/' . $val['idkembali']) ?>">
                                                            <i class="fa fa-tags"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModalpengembalian"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['idkembali']; ?>">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>


<?= $this->section('js') ?>

<script>
    $(document).ready(function() {
        $('#datapeminjam').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });
    });

    $('.btn-delete').on('click', function() {
        var idkembali = $(this).data('id');
        $('#idkembali').val(idkembali);
    });
</script>
<?= $this->endSection() ?>