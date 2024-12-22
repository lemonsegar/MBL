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
                        <h4 class="mt-0 header-title">Form Pengembalian Mobil</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('Pengembalian/save') ?>" method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Faktur Peminjaman</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPeminjaman">
                                            Pilih Peminjaman
                                        </button>
                                        <input type="text" name="faktur" id="faktur" class="form-control" readonly>
                                    </div>
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
                                                    <p><strong>Nama Pelanggan:</strong> <span id="detail_nama">-</span></p>
                                                    <p><strong>No. Plat:</strong> <span id="detail_noplat">-</span></p>
                                                    <p><strong>Tanggal Pinjam:</strong> <span id="detail_tglpinjam">-</span></p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Lama Sewa:</strong> <span id="detail_lama">-</span> hari</p>
                                                    <p><strong>Total Bayar:</strong> Rp <span id="detail_total">-</span></p>
                                                    <p><strong>Tanggal Kembali:</strong> <span id="detail_tglkembali">-</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Dikembalikan</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" name="tgldikembalikan" id="tgldikembalikan" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Denda</label>
                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="denda" id="denda" value="0" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    $('#tblPeminjaman').DataTable();

    $('input[name="tgldikembalikan"]').change(function() {
        var tglKembali = $('#faktur').data('tglkembali');
        var tglDikembalikan = $(this).val();
        
        if(tglKembali) {
            hitungDenda(tglKembali, tglDikembalikan);
        }
    });
});

function pilihPeminjaman(faktur, nama, noplat, tglPinjam, tglKembali, lama, total) {
    $('#faktur').val(faktur);
    $('#faktur').data('tglkembali', tglKembali);
    
    // Update detail peminjaman
    $('#detail_nama').text(nama);
    $('#detail_noplat').text(noplat);
    $('#detail_tglpinjam').text(tglPinjam);
    $('#detail_tglkembali').text(tglKembali);
    $('#detail_lama').text(lama);
    $('#detail_total').text(new Intl.NumberFormat('id-ID').format(total));

    $('#modalPeminjaman').modal('hide');

    var tglDikembalikan = $('input[name="tgldikembalikan"]').val();
    if(tglDikembalikan) {
        hitungDenda(tglKembali, tglDikembalikan);
    }
}

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
        denda = diffDays * 50000; // Denda per hari Rp 100.000
    }
    
    $('#denda').val(denda);
}

$(document).ready(function() {
    $('#tgldikembalikan').change(function() {
        var tglKembali = $('#faktur').data('tglkembali');
        var tglDikembalikan = $(this).val();
        hitungDenda(tglKembali, tglDikembalikan);
    });
});


</script>
<?= $this->endSection() ?>
