<!-- Pelanggan-- >
<!-- Form Tambah -->



<form action="/Peminjam/save" method="post">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4>Periksa Entrian Form</h4>
            <hr />
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="addModalpeminjam" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Peminjam</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
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
                        <div class="col-md-6">
                            <label for="lama" class="form-label">Lama (Hari)</label>
                            <input type="number" class="form-control" name="lama" id="lama" placeholder="Lama Penyewaan" required>
                        </div>
                        <div class="col-md-6">
                            <label for="total" class="form-label">Total Bayar</label>
                            <input type="number" class="form-control" name="total" id="total" placeholder="Total Bayar" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- cari pelanggan -->






<!-- Hapus modal peminjaman -->
<form action="/Peminjam/delete" method="post">
<div class="modal fade" id="deleteModalpeminjam" tabindex="-1" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModallabel">Peminjaman Mobil</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label=Close"></button>
      </div>
      <div class="modal-body">
        <h1>Yakin Di Hapus?</h1>
        </div>
    <div class="modal-footer">
        <input type="hidden" name="idpeminjam" id="idpeminjam" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">HAPUS</button>
      </div>
    </div>
  </div>
</div>
</form>

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
