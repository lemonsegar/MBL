<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo session()->getFlashdata('error'); ?>
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
                        <h4 class="mt-0 header-title">Form Edit Pengembalian Mobil</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('Pengembalian/update') ?>" method="post">
                            <input type="hidden" name="idkembali" value="<?= $pengembalian['idkembali'] ?>">
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Faktur Peminjaman</label>
                                <div class="col-sm-6">
                                    <input type="text" name="faktur" id="faktur" class="form-control" value="<?= $pengembalian['faktur'] ?>" readonly>
                                </div>
                            </div>

                            <!-- Detail Peminjaman -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Detail Peminjaman</label>
                                <div class="col-sm-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Nama Pelanggan:</strong> <span id="detail_nama"><?= $pengembalian['nama'] ?></span></p>
                                                    <p><strong>No. Plat:</strong> <span id="detail_noplat"><?= $pengembalian['noplat'] ?></span></p>
                                                    <p><strong>Tanggal Pinjam:</strong> <span id="detail_tglpinjam"><?= $pengembalian['tanggal'] ?></span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Lama Sewa:</strong> <span id="detail_lama"><?= $pengembalian['lama'] ?></span> hari</p>
                                                    <p><strong>Total Bayar:</strong> Rp <span id="detail_total"><?= number_format($pengembalian['total'],0,',','.') ?></span></p>
                                                    <p><strong>Tanggal Kembali:</strong> <span id="detail_tglkembali"><?= $pengembalian['tanggalkembali'] ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Dikembalikan</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="tgldikembalikan" id="tgldikembalikan" value="<?= $pengembalian['tgldikembalikan'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Denda</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="denda" id="denda" value="<?= $pengembalian['denda'] ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?= base_url('pengembalian') ?>" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
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
    $('#tgldikembalikan').change(function() {
        var tglKembali = $('#detail_tglkembali').text();
        var tglDikembalikan = $(this).val();
        hitungDenda(tglKembali, tglDikembalikan);
    });
});

function hitungDenda(tglKembali, tglDikembalikan) {
    // Konversi string tanggal ke objek Date
    var date1 = new Date(tglKembali + 'T00:00:00');
    var date2 = new Date(tglDikembalikan + 'T00:00:00');

    // Hitung selisih hari
    var diffTime = Math.abs(date2 - date1);
    var diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
    
    var denda = 0;
    // Hitung denda jika tanggal pengembalian lebih dari tanggal kembali yang ditentukan
    if(date2 > date1) {
        denda = diffDays * 50000; // Denda per hari Rp 50.000
    }
    
    $('#denda').val(denda);
}
</script>
<?= $this->endSection() ?>

