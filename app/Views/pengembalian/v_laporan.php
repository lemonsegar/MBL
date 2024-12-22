<?= $this->extend('layout/main') ?>
<?= $this->section('isi') ?>

<div class="col-sm-12">
    <div class="page-content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h4 class="mt-0 header-title">Laporan Data Pengembalian</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>Dari Tanggal</label>
                                <input type="date" id="tanggal_awal" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>Sampai Tanggal</label>
                                <input type="date" id="tanggal_akhir" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label><br>
                                <button id="btnFilter" class="btn btn-primary">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="<?= site_url('pengembalian/cetakpdf') ?>" target="_blank" class="btn btn-danger">
                                    <i class="fa fa-file-pdf"></i> PDF
                                </a>
                            </div>
                        </div>

                        <div id="viewdata">
                            <div class="table-responsive">
                                <table class="table table-sm table-striped" id="datapengembalian">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Faktur</th>
                                            <th>Tgl Pinjam</th>
                                            <th>Tgl Kembali</th>
                                            <th>Tgl Dikembalikan</th>
                                            <th>Pelanggan</th>
                                            <th>Mobil</th>
                                            <th>Total Sewa</th>
                                            <th>Denda</th>
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 0;
                                        foreach ($pengembalian as $val) {
                                            $no++; ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td><?= $val['faktur'] ?></td>
                                                <td><?= date('d/m/Y', strtotime($val['tanggal'])) ?></td>
                                                <td><?= date('d/m/Y', strtotime($val['tanggalkembali'])) ?></td>
                                                <td><?= date('d/m/Y', strtotime($val['tgldikembalikan'])) ?></td>
                                                <td><?= $val['nama_pelanggan'] ?></td>
                                                <td><?= $val['merek'] ?> - <?= $val['noplat'] ?></td>
                                                <td>Rp <?= number_format($val['total'], 0, ',', '.') ?></td>
                                                <td>Rp <?= number_format($val['denda'], 0, ',', '.') ?></td>
                                                <td>Rp <?= number_format($val['total'] + $val['denda'], 0, ',', '.') ?></td>
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
        // Inisialisasi DataTable
        let dataTable = $('#datapengembalian').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ hingga _END_ dari _TOTAL_ data"
            }
        });

        // Event handler untuk filter
        $('#btnFilter').click(function() {
            let tanggal_awal = $('#tanggal_awal').val();
            let tanggal_akhir = $('#tanggal_akhir').val();

            if (!tanggal_awal || !tanggal_akhir) {
                alert('Silakan pilih tanggal awal dan akhir');
                return;
            }

            $.ajax({
                type: "POST",
                url: "<?= site_url('Pengembalian/filter') ?>",
                data: {
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir
                },
                dataType: "json",
                beforeSend: function() {
                    $('#btnFilter').prop('disabled', true);
                    $('#btnFilter').html('<i class="fa fa-spin fa-spinner"></i> Loading...');
                },
                success: function(response) {
                    if ($.fn.DataTable.isDataTable('#datapengembalian')) {
                        $('#datapengembalian').DataTable().destroy();
                    }

                    $('#datapengembalian tbody').empty();

                    let html = '';
                    if (response.data && response.data.length > 0) {
                        response.data.forEach(function(row, index) {
                            let totalBayar = parseFloat(row.total) + parseFloat(row.denda);
                            html += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${row.faktur}</td>
                                <td>${formatDate(row.tanggal)}</td>
                                <td>${formatDate(row.tanggalkembali)}</td>
                                <td>${formatDate(row.tgldikembalikan)}</td>
                                <td>${row.nama_pelanggan}</td>
                                <td>${row.merek} - ${row.noplat}</td>
                                <td>Rp ${formatNumber(row.total)}</td>
                                <td>Rp ${formatNumber(row.denda)}</td>
                                <td>Rp ${formatNumber(totalBayar)}</td>
                            </tr>
                        `;
                        });
                    } else {
                        html = `
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data yang ditemukan</td>
                        </tr>
                    `;
                    }

                    $('#datapengembalian tbody').html(html);

                    $('#datapengembalian').DataTable({
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
            let tanggal_awal = $('#tanggal_awal').val();
            let tanggal_akhir = $('#tanggal_akhir').val();

            let url = "<?= site_url('pengembalian/cetakpdf') ?>";
            if (tanggal_awal && tanggal_akhir) {
                url += `?tanggal_awal=${tanggal_awal}&tanggal_akhir=${tanggal_akhir}`;
            }

            window.open(url, '_blank');
        });

        // Fungsi helper untuk format tanggal
        function formatDate(date) {
            let d = new Date(date);
            let day = String(d.getDate()).padStart(2, '0');
            let month = String(d.getMonth() + 1).padStart(2, '0');
            let year = d.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Fungsi helper untuk format angka
        function formatNumber(num) {
            return new Intl.NumberFormat('id-ID').format(num);
        }
    });
</script>
<?= $this->endSection() ?>