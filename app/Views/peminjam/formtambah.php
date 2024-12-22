<?= $this->extend('layout/main') ?>

<?= $this->section('isi') ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        <hr>
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<div class="col-sm-12">
    <div class="card" style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <div class="card-header">
            <h4>Form Tambah Peminjaman</h4>
        </div>
        <div class="card-body">
            <form action="/Peminjam/save" method="post">
                

                
                <div class="row mb-3">

                    <div class="col-md-3">
                        <label for="faktur" class="form-label">Faktur</label>
                        <input type="text" class="form-control" name="faktur" id="faktur" value="<?= $faktur ?>" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Pelanggan</label>
                        <div class="input-group">
                            <button type="button" data-toggle="modal" data-target="#modal_pelanggan" class="btn btn-primary">Pilih Pelanggan</button>
                            <input type="text" name="idpel" id="idpel" placeholder="ID Pelanggan" class="form-control" readonly>
                            <input type="text" id="nama" placeholder="Nama Pelanggan" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Mobil</label>
                        <div class="input-group">
                            <button type="button" data-toggle="modal" data-target="#modal_mobil" class="btn btn-primary">Pilih Mobil</button>
                            <input type="text" name="idmobil" id="idm" placeholder="ID Mobil" class="form-control" readonly>
                            <input type="text" id="noplat" placeholder="No Plat" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="hrgsewa" class="form-label">Harga Sewa</label>
                        <input type="text" id="hrgsewa" class="form-control" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="lama" class="form-label">Lama (Hari)</label>
                        <input type="number" class="form-control" name="lama" id="lama" placeholder="Lama Penyewaan" required>
                    </div>
                    <div class="col-md-3">
                        <label for="hrgsewa" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" name="tglkembali" id="tglkembali" placeholder="Tanggal Kembali" required readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="total" class="form-label">Total Bayar</label>
                        <input type="number" class="form-control" name="total" id="total" placeholder="Total Bayar" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="/peminjam" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>

<script>
    $('#lama, #hrgsewa').on('input', function() {
        let harga = $('#hrgsewa').val();
        let lama = $('#lama').val();
        $('#total').val(lama * harga);

        // Hitung tanggal kembali
        let tglPinjam = new Date($('#tanggal').val());
        let tglKembali = new Date(tglPinjam);
        tglKembali.setDate(tglPinjam.getDate() + parseInt(lama));
        
        // Format tanggal ke YYYY-MM-DD untuk input date
        let dd = String(tglKembali.getDate()).padStart(2, '0');
        let mm = String(tglKembali.getMonth() + 1).padStart(2, '0');
        let yyyy = tglKembali.getFullYear();
        $('#tglkembali').val(yyyy + '-' + mm + '-' + dd);
    })


    
</script>

<?= $this->endSection() ?>