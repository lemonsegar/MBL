<?= $this->extend('layout/main') ?>
<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Laporan Data Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Dari ID Pelanggan</label>
                                <select id="idpel_awal" class="form-control select2">
                                    <option value="">Pilih ID Pelanggan Awal</option>
                                    <?php foreach ($pelanggan as $row): ?>
                                        <option value="<?= $row['idpel'] ?>"><?= $row['idpel'] ?> - <?= $row['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Sampai ID Pelanggan</label>
                                <select id="idpel_akhir" class="form-control select2">
                                    <option value="">Pilih ID Pelanggan Akhir</option>
                                    <?php foreach ($pelanggan as $row): ?>
                                        <option value="<?= $row['idpel'] ?>"><?= $row['idpel'] ?> - <?= $row['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label><br>
                                <button id="btnFilter" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="<?= site_url('pelanggan/cetakpdf') ?>" target="_blank" class="btn btn-danger">
                                    <i class="fa fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>

                        <div id="viewdata">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped" id="datapelanggan">
                                    <thead>
                                        <tr role="row">
                                            <th>No</th>
                                            <th>ID Pelanggan</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No HP</th>
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

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Pilih ID Pelanggan',
            allowClear: true
        });

        // Simpan referensi DataTable dalam variabel
        let dataTable;

        // Fungsi untuk menginisialisasi DataTable
        function initializeDataTable() {
            if ($.fn.DataTable.isDataTable('#datapelanggan')) {
                $('#datapelanggan').DataTable().destroy();
            }

            dataTable = $('#datapelanggan').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data",
                    "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
                }
            });
        }

        // Inisialisasi DataTable pertama kali
        initializeDataTable();

        // Event handler untuk filter
        $('#btnFilter').click(function() {
            let idpel_awal = $('#idpel_awal').val();
            let idpel_akhir = $('#idpel_akhir').val();

            if (!idpel_awal || !idpel_akhir) {
                alert('Silakan pilih ID Pelanggan awal dan akhir');
                return;
            }

            $.ajax({
                type: "POST",
                url: "<?= site_url('Pelanggan/filter') ?>",
                data: {
                    idpel_awal: idpel_awal,
                    idpel_akhir: idpel_akhir
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnFilter').prop('disabled', true);
                    $('#btnFilter').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
                },
                success: function(response) {
                    // Destroy existing DataTable
                    if ($.fn.DataTable.isDataTable('#datapelanggan')) {
                        $('#datapelanggan').DataTable().destroy();
                    }

                    // Clear existing table body
                    $('#datapelanggan tbody').empty();

                    // Add new data
                    let html = '';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(row, index) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${row.idpel}</td>
                                    <td>${row.nama}</td>
                                    <td>${row.alamat}</td>
                                    <td>${row.nohp}</td>
                                </tr>
                            `;
                        });
                    } else {
                        html = `
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data yang ditemukan</td>
                            </tr>
                        `;
                    }

                    $('#datapelanggan tbody').html(html);

                    // Reinitialize DataTable
                    $('#datapelanggan').DataTable({
                        "language": {
                            "search": "Cari:",
                            "lengthMenu": "Tampilkan _MENU_ data",
                            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
                        }
                    });
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat memfilter data');
                    console.error(error);
                },
                complete: function() {
                    $('#btnFilter').prop('disabled', false);
                    $('#btnFilter').html('<i class="fa fa-filter"></i> Filter');
                }
            });
        });

        // Tambahkan event handler untuk tombol PDF
        $('.btn-danger').click(function(e) {
            e.preventDefault();
            let idpel_awal = $('#idpel_awal').val();
            let idpel_akhir = $('#idpel_akhir').val();

            let url = "<?= site_url('pelanggan/cetakpdf') ?>";
            if (idpel_awal && idpel_akhir) {
                url += `?idpel_awal=${idpel_awal}&idpel_akhir=${idpel_akhir}`;
            }

            window.open(url, '_blank');
        });
    });
</script>
<?= $this->endSection() ?>