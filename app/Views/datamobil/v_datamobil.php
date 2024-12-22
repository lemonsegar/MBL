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
                        <h4 class="mt-0 header-title">Data Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModaldatamobil" data-toggle="modal">Tambah Data</button>
                        </div>
                        <br>
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
            <td><?= $val['status'] ?></td>
            <td><?= $val['hrgsewa'] ?></td>
            <td>
            <button type="button" class="btn btn-info btn-sm btn-edit"data-id="<?= $val['idmobil']; ?>"
                data-merek="<?= $val['merek'] ?>"
                data-tahun="<?= $val['tahun'] ?>"data-noplat="<?= $val['noplat'] ?>"
                data-status="<?= $val['status'] ?>"data-hrgsewa="<?= $val['hrgsewa'] ?>">
                <i class="fa fa-edit"></i>Edit
            </button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModaldatamobil" data-toggle="modal" data-id="<?= $val['idmobil']; ?>">
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
        $('#datamobil').DataTable();
    });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModal').model('show');
    });

    //script untuk edit data
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
<?= $this->endSection('') ?>