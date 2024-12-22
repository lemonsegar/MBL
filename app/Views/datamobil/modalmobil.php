<form action="/datamobil/save" method="post">
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h4>Periksa Entrian Form</h4>
            <hr>
            <?php echo session()->getFlashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="modal fade" id="addModaldatamobil" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addModalLabel">Tambah Data Mobil</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID Mobil <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="id" required>
                    </div>
                    <div class="form-group">
                        <label>Merek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="merek" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="tahun" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Plat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="noplat" required>
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Disewa">Disewa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="hrgsewa" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<form action="/datamobil/delete" method="post">
    <div class="modal fade" id="deleteModaldatamobil" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="deleteModalLabel">Hapus Data Mobil</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                    <h4>Apakah anda yakin ingin menghapus data ini?</h4>
                    <p class="text-muted">Data yang sudah dihapus tidak dapat dikembalikan</p>
                    <input type="hidden" name="id" class="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>


<form action="/datamobil/update" method="post">
    <div class="modal fade" id="editModaldatamobil" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Data Mobil</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control id" name="id" readonly>
                    </div>
                    <div class="form-group">
                        <label>Merek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control merek" name="merek" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun <span class="text-danger">*</span></label>
                        <input type="number" class="form-control tahun" name="tahun" required>
                    </div>
                    <div class="form-group">
                        <label>No Plat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control noplat" name="noplat" required>
                    </div>
                    <div class="form-group">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control status" name="status" required>
                            <option value="">Pilih Status</option>
                            <?php foreach ($status as $s) : ?>
                                <option value="<?= $s['status'] ?>" <?= ($s['status'] == $status) ? 'selected' : '' ?>><?= $s['status'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa <span class="text-danger">*</span></label>
                        <input type="number" class="form-control hrgsewa" name="hrgsewa" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>