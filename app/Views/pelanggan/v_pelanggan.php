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
    <div class="page-content-wrapper ">
        <!-- end page title and breadcrumb -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary btn-tambah" data-toggle="modal" data-target="#addModal">Tambah Data</button>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapelanggan">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>NoHP</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($pelanggan as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['idpel'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['alamat'] ?></td>
                                                    <td><?= $val['nohp'] ?></td>
                                                    <td>

                                                        <button type="button" class="btn btn-info btn-sm btn-edit" data-id="<?= $val['idpel']; ?>"
                                                            data-nama="<?= $val['nama'] ?>" data-alamat="<?= $val['alamat'] ?>"
                                                            data-nohp="<?= $val['nohp'] ?>">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModal"
                                                            data-toggle="modal" data-id="<?= $val['idpel']; ?>">
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
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
</div>


<?= $this->endSection('') ?>
<?= $this->section('js') ?>

<script>
    $(document).ready(function() {
        $('#datapelanggan').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });

        $('#addModal').on('shown.bs.modal', function() {
            $(this).find('input:first').focus();
        });

        // Reset form ketika modal ditutup
        $('#addModal').on('hidden.bs.modal', function() {
            $(this).find('form')[0].reset();
        });
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
    });


    //script untuk edit data
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const alamat = $(this).data('alamat');
        const nohp = $(this).data('nohp');

        $('.id').val(id);
        $('.nama').val(nama);
        $('.alamat').val(alamat);
        $('.nohp').val(nohp).trigger('change');
        $('#editModal').modal('show');
    });
</script>

<?= $this->endSection('') ?>