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
                        <h4 class="mt-0 header-title">Data Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalkaryawan" data-toggle="modal">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datakaryawan">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Karyawan</th>
                                                <th>No HP</th>
                                                <th>No Identitas</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($karyawan as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['idkaryawan'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['nohp'] ?></td>
                                                    <td><?= $val['nointitas'] ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-info btn-sm btn-edit"
                                                            data-id="<?= $val['idkaryawan']; ?>"
                                                            data-nama="<?= $val['nama'] ?>"
                                                            data-nohp="<?= $val['nohp'] ?>"
                                                            data-nointitas="<?= $val['nointitas'] ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModalkaryawan"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['idkaryawan']; ?>">
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



<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
    $(document).ready(function() {
        $('#datakaryawan').DataTable({
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
    });

    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const nohp = $(this).data('nohp');
        const nointitas = $(this).data('nointitas');

        $('.id').val(id);
        $('.nama').val(nama);
        $('.nohp').val(nohp);
        $('.nointitas').val(nointitas);
        $('#editModalkaryawan').modal('show');
    });
</script>
<?= $this->endSection() ?>