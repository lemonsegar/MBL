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
                        <h4 class="mt-0 header-title">Data Peminjam Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" data-target="#addModalpeminjam" data-toggle="modal">Tambah Data</button>
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
            <button type="button"
                class="btn btn-info btn-sm btn-edit"
                data-id="<?= $val['idpeminjam']; ?>"
                data-tanggal="<?= $val['tanggal']; ?>"
                data-idpel="<?= $val['idpel']; ?>"
                data-nama="<?= $val['nama']; ?>"
                data-idmobil="<?= $val['idmobil']; ?>"
                data-nolpat="<?= $val['noplat']; ?>"
                data-hrgsewa="<?= $val['hrgsewa']; ?>"
                data-lama="<?= $val['lama']; ?>"
                data-total="<?= trim($val['total']); ?>">
                <i class="fa fa-tags"></i>
            </button>

                <button type="button" class="btn btn-danger btn-sm btn-delete" data-target="#deleteModalpeminjam" 
                data-toggle="modal" data-id="<?= $val['idpeminjam']; ?>">
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
</div> <!-- end col -->
</div> <!-- end row -->
</div>
</div>

<!-- Form Tambah -->

<!-- edit modal -->
<form action="/Peminjam/update" method="post">
    <div class="modal fade" id="editModalpeminjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peminjaman Mobil</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="col-sm-12">
                        <input type="text" class="form-control id" name="id" >
                    </div>
                <div class="col-sm-12">
                        <label>Tanggal</label>
                        <input type="date" class="form-control tanggal" name="tanggal" >
                    </div>
                    <div class="col-md-12">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Pelanggan</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_pelanggan" 
                                    class="btn btn-xs btn-primary">Pelanggan</button>
                                </div>
                            </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="idpel" readonly id="idpel" class="form-control idpel">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" readonly id="nama" class="form-control nama">
                    </div>
                    </div>
                    </div>
                    </div>
                       
                    <div class="col-md-12">
                         <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Data Mobil</label>
                                    <button type="button" data-toggle="modal" data-target="#modal_mobil" 
                                    class="btn btn-xs btn-primary">Mobil</button>
                                </div>
                            </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>ID</label>
                        <input type="text" name="idmobil" readonly id="idmobil" class="form-control idmobil">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>No Plat</label>
                        <input type="text" readonly id="noplat" class="form-control noplat">
                    </div>
                    </div>
                    <div class="col-md-5">
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="text" readonly id="hrgsewa" class="form-control hrgsewa">
                    </div>
                    </div>
                    </div>
                    </div>

                    <div class="col-md-12">
                        <label>Lama</label>
                        <input type="text" class="form-control lama" ket name="lama" >
                    </div>
                    <div class="col-md-12">
                        <label>Total</label>
                        <input type="text" class="form-control total"  name="total" >
                    </div>
                    
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</form>




<script>



$(document).ready(function() {
        $('#datapeminjam').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });

    $('.btn-delete').on('click', function() {
        const id = $(this).data('id');
        $('.id').val(id);
        $('#deleteModalpeminjam').model('show');
    });

   // Script untuk edit data
$('.btn-edit').on('click', function() {
    const id = $(this).data('id');
    const tanggal = $(this).data('tanggal');
    const idpel = $(this).data('idpel');
    const nama = $(this).data('nama');
    const idmobil = $(this).data('idmobil');
    const noplat = $(this).data('noplat');
    const hrgsewa = $(this).data('hrgsewa');
    const lama = $(this).data('lama');
    const total = $(this).data('total');

    $('.id').val(id);
    $('.tanggal').val(tanggal);
    $('.idpel').val(idpel);
    $('.nama').val(nama);
    $('.idmobil').val(idmobil);
    $('.noplat').val(noplat);
    $('.hrgsewa').val(hrgsewa);
    $('.lama').val(lama);
    $('.total').val(total).trigger('change'); // Pastikan class sesuai
    $('#editModalpeminjam').modal('show');
});


</script>

<?= $this->endSection('') ?>