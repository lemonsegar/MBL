<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>

<?= $this->section('isi') ?>

<head>


        <link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
         <script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
</head>

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
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalkaryawan" data-toggle="modal">Tambah Data</button>
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
        <th>NoHp</th>
        <th>No Indentitas</th>
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
            <button type="button" class="btn btn-info btn-sm btn-edit"data-id="<?= $val['idkaryawan']; ?>"
                data-nama="<?= $val['nama'] ?>"
                data-nohp="<?= $val['nohp'] ?>"data-nointitas="<?= $val['nointitas'] ?>">
                <i class="fa fa-edit"></i>Edit
            </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModalkaryawan" data-toggle="modal" data-id="<?= $val['idkaryawan']; ?>">
                    <i class="fa fa-trash"></i>Hapus
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




<!-- Modal Scripts -->
<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datamobil').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });
    });

    $(document).ready(function() {
        $('#datakaryawan').DataTable();
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModalkaryawan').model('show');
    });

    //script untuk edit data
$('.btn-edit').on('click', function() {
    const id = $(this).data('id');
    const nama = $(this).data('nama');
    const nohp = $(this).data('nohp');
    const nointitas = $(this).data('nointitas');

    $('.id').val(id);
    $('.nama').val(nama);
    $('.nohp').val(nohp);
    $('.nointitas').val(nointitas).trigger('change');
    $('#editModalkaryawan').modal('show');
});
</script>
<?= $this->endSection('') ?>