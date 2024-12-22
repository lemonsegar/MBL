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
                        <h4 class="mt-0 header-title">Data Peminjam Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <a type="button" class="btn btn-sm btn-primary" href="<?= site_url('Peminjam/tambah') ?>">
                                Tambah Data
                            </a>
                        </div>
                        <br>
                        <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-sm table-striped" id="datapeminjam">
                                        <thead>
                                            <tr role="row">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Id Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Id Mobil</th>
                                                <th>No Polisi</th>
                                                <th>Harga Sewa</th>
                                                <th>Lama Sewa</th>
                                                <th>Total Bayar</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($peminjam as $val) {
                                                $no++; ?>
                                                <tr role="row" class="odd">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $val['tanggal'] ?></td>
                                                    <td><?= $val['idpel'] ?></td>
                                                    <td><?= $val['nama'] ?></td>
                                                    <td><?= $val['idmobil'] ?></td>
                                                    <td><?= $val['noplat'] ?></td>
                                                    <td><?= $val['hrgsewa'] ?></td>
                                                    <td><?= $val['lama'] ?></td>
                                                    <td><?= $val['total'] ?></td>
                                                    <td>
                                                        <a class="btn btn-info btn-sm btn-edit" href="<?= site_url('Peminjam/edit/' . $val['idpeminjam']) ?>">
                                                            <i class="fa fa-tags"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                                            data-target="#deleteModalpeminjam"
                                                            data-toggle="modal"
                                                            data-id="<?= $val['idpeminjam']; ?>" ,
                                                            data-idmobil="<?= $val['idmobil']; ?>">
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
        var idpeminjam = $(this).data('id');
        var idmobil = $(this).data('idmobil');
        $('#idpeminjam ').val(idpeminjam);
        $('#idmobil').val(idmobil);
    });
</script>
<?= $this->endSection() ?>