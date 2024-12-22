<form action="/karyawan/save" method="post">
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

    <div class="modal fade" id="addModalkaryawan" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="addModalLabel">Tambah Data Karyawan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="id" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Karyawan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>No HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nohp" required>
                    </div>
                    <div class="form-group">
                        <label>No Identitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="nointitas" required>
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

<form action="/karyawan/delete" method="post">
    <div class="modal fade" id="deleteModalkaryawan" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="deleteModalLabel">Hapus Data Karyawan</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h4 class="mb-4">Apakah anda yakin ingin menghapus data ini?</h4>
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


<form action="/karyawan/update" method="post">
    <div class="modal fade" id="editModalkaryawan" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit Data Karyawan</h5>
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
                        <label>Nama Karyawan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>No HP <span class="text-danger">*</span></label>
                        <input type="text" class="form-control nohp" name="nohp" required>
                    </div>
                    <div class="form-group">
                        <label>No Identitas <span class="text-danger">*</span></label>
                        <input type="text" class="form-control nointitas" name="nointitas" required>
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