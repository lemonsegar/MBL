<!-- Modal Pilih Pelanggan -->
<div class="modal fade" id="modal_pelanggan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Data Pelanggan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="datapelanggan">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">ID Pelanggan</th>
                                <th width="25%">Nama</th>
                                <th width="25%">Alamat</th>
                                <th width="15%">No HP</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($data_pel as $row) :
                                $no++; ?>
                                <tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><?= $row['idpel']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td><?= $row['nohp']; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="pilih_pelanggan('<?= $row['idpel'] ?>','<?= $row['nama'] ?>')">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Mobil -->
<div class="modal fade" id="modal_mobil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Data Mobil</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="datamobil">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">ID Mobil</th>
                                <th width="20%">No Plat</th>
                                <th width="20%">Merk</th>
                                <th width="15%">Harga Sewa</th>
                                <th width="10%">Status</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($data_mobil as $row) :
                                $no++; ?>
                                <tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <td><?= $row['idmobil']; ?></td>
                                    <td><?= $row['noplat']; ?></td>
                                    <td><?= $row['merek']; ?></td>
                                    <td><?= $row['hrgsewa']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="pilih_mobil('<?= $row['idmobil'] ?>','<?= $row['noplat'] ?>','<?= $row['hrgsewa'] ?>')">
                                            <i class="fa fa-check"></i> Pilih
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<form action="/Peminjam/delete" method="post">
    <div class="modal fade" id="deleteModalpeminjam" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <h5>Apakah Anda yakin ingin menghapus data peminjaman ini?</h5>
                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idpeminjam" id="idpeminjam">
                    <input type="hidden" name="idmobil" id="idmobil" class="idmobil">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
    function pilih_pelanggan(id, nama) {
        $('#idpel').val(id);
        $('#nama').val(nama);
        $('#modal_pelanggan').modal('hide');
    }

    function pilih_mobil(id, noplat, hrgsewa) {
        $('#idmobil').val(id);
        $('#noplat').val(noplat);
        $('#hrgsewa').val(hrgsewa);
        $('#modal_mobil').modal('hide');
    }

</script>