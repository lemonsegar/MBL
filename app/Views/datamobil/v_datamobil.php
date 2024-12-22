<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
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
                        <h4 class="mt-0 header-title">Data Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModaldatamobil" data-toggle="modal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                       

                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datamobil">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Merek</th>
                                                <th>Tahun</th>
                                                <th>No Plat</th>
                                                <th>Status</th>
                                                <th>Harga Sewa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($datamobil as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['idmobil'] ?></td>
                                                    <td><?= $val['merek'] ?></td>
                                                    <td><?= $val['tahun'] ?></td>
                                                    <td><?= $val['noplat'] ?></td>
                                                    <td>
                                                        <?php if ($val['status'] == 'Tersedia') : ?>
                                                            <span class="badge badge-success"><?= $val['status'] ?></span>
                                                        <?php else : ?>
                                                            <span class="badge badge-danger"><?= $val['status'] ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>Rp <?= number_format($val['hrgsewa'], 0, ',', '.') ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn-edit"
                                                            data-id="<?= $val['idmobil']; ?>"
                                                            data-merek="<?= $val['merek'] ?>"
                                                            data-tahun="<?= $val['tahun'] ?>"
                                                            data-noplat="<?= $val['noplat'] ?>"
                                                            data-status="<?= $val['status'] ?>"
                                                            data-hrgsewa="<?= $val['hrgsewa'] ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModaldatamobil"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['idmobil']; ?>">
                                                            <i class="fa fa-trash"></i> Hapus
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

<!-- Modal Scripts -->
<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datamobil').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 hingga 0 dari 0 data",
                "emptyTable": "Tidak ada data yang tersedia",
                "zeroRecords": "Tidak ditemukan data yang sesuai"
            }
        });
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModaldatamobil').modal('show');
    });

    // Script untuk edit data
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        const merek = $(this).data('merek');
        const tahun = $(this).data('tahun');
        const noplat = $(this).data('noplat');
        const status = $(this).data('status');
        const hrgsewa = $(this).data('hrgsewa');

        $('.id').val(id);
        $('.merek').val(merek);
        $('.tahun').val(tahun);
        $('.noplat').val(noplat);
        $('.status').val(status);
        $('.hrgsewa').val(hrgsewa).trigger('change');
        $('#editModaldatamobil').modal('show');
    });
</script>
<?= $this->endSection() ?>