<?= $this->extend('layout/main') ?>
<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Laporan Data Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Dari ID Mobil</label>
                                <select id="idmobil_awal" class="form-control select2">
                                    <option value="">Pilih ID Mobil Awal</option>
                                    <?php foreach ($mobil as $row): ?>
                                        <option value="<?= $row['idmobil'] ?>"><?= $row['idmobil'] ?> - <?= $row['merek'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Sampai ID Mobil</label>
                                <select id="idmobil_akhir" class="form-control select2">
                                    <option value="">Pilih ID Mobil Akhir</option>
                                    <?php foreach ($mobil as $row): ?>
                                        <option value="<?= $row['idmobil'] ?>"><?= $row['idmobil'] ?> - <?= $row['merek'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label><br>
                                <button id="btnFilter" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="<?= site_url('mobil/cetakpdf') ?>" target="_blank" class="btn btn-danger">
                                    <i class="fa fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>

                        <div id="viewdata">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped" id="datamobil">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Mobil</th>
                                            <th>Merk</th>
                                            <th>Tahun</th>
                                            <th>No Polisi</th>
                                            <th>Status</th>
                                            <th>Harga Sewa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($mobil as $val) {
                                            $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $val['idmobil'] ?></td>
                                                <td><?= $val['merek'] ?></td>
                                                <td><?= $val['tahun'] ?></td>
                                                <td><?= $val['noplat'] ?></td>
                                                <td><?= $val['status'] ?></td>
                                                <td><?= number_format($val['hrgsewa'], 0, ',', '.') ?></td>
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
        $('.select2').select2({
            width: '100%',
            placeholder: 'Pilih ID Mobil',
            allowClear: true
        });

        // Inisialisasi DataTable
        let dataTable = $('#datamobil').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });

        // Event handler untuk filter
        $('#btnFilter').click(function() {
            let idmobil_awal = $('#idmobil_awal').val();
            let idmobil_akhir = $('#idmobil_akhir').val();

            if (!idmobil_awal || !idmobil_akhir) {
                alert('Silakan pilih ID Mobil awal dan akhir');
                return;
            }

            $.ajax({
                type: "POST",
                url: "<?= site_url('DataMobil/filter') ?>",
                data: {
                    idmobil_awal: idmobil_awal,
                    idmobil_akhir: idmobil_akhir
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnFilter').prop('disabled', true);
                    $('#btnFilter').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
                },
                success: function(response) {
                    if ($.fn.DataTable.isDataTable('#datamobil')) {
                        $('#datamobil').DataTable().destroy();
                    }

                    $('#datamobil tbody').empty();

                    let html = '';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(row, index) {
                            html += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${row.idmobil}</td>
                                    <td>${row.merek}</td>
                                    <td>${row.tahun}</td>
                                    <td>${row.noplat}</td>
                                    <td>${row.status}</td>
                                    <td>${new Intl.NumberFormat('id-ID').format(row.hrgsewa)}</td>
                                </tr>
                            `;
                        });
                    } else {
                        html = `
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data yang ditemukan</td>
                            </tr>
                        `;
                    }

                    $('#datamobil tbody').html(html);

                    $('#datamobil').DataTable({
                        "language": {
                            "search": "Cari:",
                            "lengthMenu": "Tampilkan _MENU_ data",
                            "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
                        }
                    });
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat memfilter data');
                    console.error(xhr.responseText);
                },
                complete: function() {
                    $('#btnFilter').prop('disabled', false);
                    $('#btnFilter').html('<i class="fa fa-filter"></i> Filter');
                }
            });
        });

        // Event handler untuk tombol PDF
        $('.btn-danger').click(function(e) {
            e.preventDefault();
            let idmobil_awal = $('#idmobil_awal').val();
            let idmobil_akhir = $('#idmobil_akhir').val();

            let url = "<?= site_url('DataMobil/cetakpdf') ?>";
            if (idmobil_awal && idmobil_akhir) {
                url += `?idmobil_awal=${idmobil_awal}&idmobil_akhir=${idmobil_akhir}`;
            }

            window.open(url, '_blank');
        });
    });
</script>
<?= $this->endSection() ?>