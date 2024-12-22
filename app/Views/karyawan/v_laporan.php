<?= $this->extend('layout/main') ?>
<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Laporan Data Karyawan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Dari ID Karyawan</label>
                                <select id="idkaryawan_awal" class="form-control select2">
                                    <option value="">Pilih ID Karyawan Awal</option>
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?= $row['idkaryawan'] ?>"><?= $row['idkaryawan'] ?> - <?= $row['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Sampai ID Karyawan</label>
                                <select id="idkaryawan_akhir" class="form-control select2">
                                    <option value="">Pilih ID Karyawan Akhir</option>
                                    <?php foreach ($karyawan as $row): ?>
                                        <option value="<?= $row['idkaryawan'] ?>"><?= $row['idkaryawan'] ?> - <?= $row['nama'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label><br>
                                <button id="btnFilter" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="<?= site_url('karyawan/cetakpdf') ?>" target="_blank" class="btn btn-danger">
                                    <i class="fa fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>

                        <div id="viewdata">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped" id="datakaryawan">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Karyawan</th>
                                            <th>Nama</th>
                                            <th>No HP</th>
                                            <th>No Identitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($karyawan as $val) {
                                            $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $val['idkaryawan'] ?></td>
                                                <td><?= $val['nama'] ?></td>
                                                <td><?= $val['nohp'] ?></td>
                                                <td><?= $val['nointitas'] ?></td>
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
            placeholder: 'Pilih ID Karyawan',
            allowClear: true
        });

        // Inisialisasi DataTable
        let dataTable = $('#datakaryawan').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });

        // Event handler untuk filter
        $('#btnFilter').click(function() {
            let idkaryawan_awal = $('#idkaryawan_awal').val();
            let idkaryawan_akhir = $('#idkaryawan_akhir').val();

            if (!idkaryawan_awal || !idkaryawan_akhir) {
                alert('Silakan pilih ID Karyawan awal dan akhir');
                return;
            }

            $.ajax({
                type: "POST",
                url: "<?= site_url('Karyawan/filter') ?>",
                data: {
                    idkaryawan_awal: idkaryawan_awal,
                    idkaryawan_akhir: idkaryawan_akhir
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnFilter').prop('disabled', true);
                    $('#btnFilter').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
                },
                success: function(response) {
                    if ($.fn.DataTable.isDataTable('#datakaryawan')) {
                        $('#datakaryawan').DataTable().destroy();
                    }

                    $('#datakaryawan tbody').empty();

                    let html = '';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(row, index) {
                            html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${row.idkaryawan}</td>
                                <td>${row.nama}</td>
                                <td>${row.nohp}</td>
                                <td>${row.nointitas}</td>
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

                    $('#datakaryawan tbody').html(html);

                    $('#datakaryawan').DataTable({
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
            let idkaryawan_awal = $('#idkaryawan_awal').val();
            let idkaryawan_akhir = $('#idkaryawan_akhir').val();

            let url = "<?= site_url('karyawan/cetakpdf') ?>";
            if (idkaryawan_awal && idkaryawan_akhir) {
                url += `?idkaryawan_awal=${idkaryawan_awal}&idkaryawan_akhir=${idkaryawan_akhir}`;
            }

            window.open(url, '_blank');
        });
    });
</script>
<?= $this->endSection() ?>