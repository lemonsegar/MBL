<div class="modal fade" id="modalPeminjaman" tabindex="-1" role="dialog" aria-labelledby="modalPeminjamanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPeminjamanLabel">Pilih Data Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped" id="tblPeminjaman">
                    <thead>
                        <tr>
                            <th>Faktur</th>
                            <th>Pelanggan</th>
                            <th>No Plat</th>
                            <th>Tgl Pinjam</th>
                            <th>Tgl Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_peminjaman as $row): ?>
                            <tr>
                                <td><?= $row['faktur'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['noplat'] ?></td>
                                <td><?= $row['tanggal'] ?></td>
                                <td><?= $row['tanggalkembali'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info"
                                        onclick="pilihPeminjaman('<?= $row['faktur'] ?>', '<?= $row['nama'] ?>', '<?= $row['noplat'] ?>', 
                                    '<?= $row['tanggal'] ?>', '<?= $row['tanggalkembali'] ?>', '<?= $row['lama'] ?>', '<?= $row['total'] ?>')">
                                        Pilih
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModalpengembalian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-trash"></i> Konfirmasi Hapus Data
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url('pengembalian/delete') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idkembali" id="idkembali">
                    <div class="text-center">
                        <i class="fa fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                        <h4>Apakah anda yakin?</h4>
                        <p>Data yang sudah dihapus tidak dapat dikembalikan!</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

