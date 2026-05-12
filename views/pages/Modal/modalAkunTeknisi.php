<!-- MODAL PREVIEW TEKNISI -->
<div class="modal fade" id="modalTeknisi" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content shadow-lg"
            style="border-radius:18px; border:none; background:#f5f7f6;">

            <!-- HEADER -->
            <div class="modal-header border-0 pt-4 px-4 justify-content-center position-relative">

                <div class="text-center">
                    <h4 class="fw-bold mb-1"
                        style="color:#02343F;">
                        Informasi Akun Teknisi
                    </h4>
                </div>

                <button type="button"
                    class="btn-close position-absolute top-0 end-0 mt-4 me-4"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body px-4 pb-4">

                <!-- HIDDEN ID -->
                <input type="hidden" id="editId">

                <!-- FOTO -->
                <div class="text-center mb-4">

                    <div id="uploadArea"
                        class="mx-auto d-flex align-items-center justify-content-center flex-column"
                        style="
                            width:110px;
                            height:110px;
                            border:2px dashed #22c55e;
                            border-radius:50%;
                            background:white;
                            overflow:hidden;
                            position:relative;">

                        <!-- PREVIEW FOTO -->
                        <img id="previewFoto"
                            src=""
                            style="
                                width:100%;
                                height:100%;
                                object-fit:cover;
                                display:none;">

                        <!-- ICON DEFAULT -->
                        <div id="uploadContent"
                            class="text-center">

                            <i class="bi bi-person-fill"
                                style="
                                    font-size:32px;
                                    color:#6b7280;">
                            </i>

                        </div>

                    </div>

                </div>

                <!-- NAMA -->
                <div class="mb-3">

                    <label class="fw-semibold mb-2"
                        style="font-size:13px;">
                        Nama Lengkap
                    </label>

                    <input type="text"
                        id="editNama"
                        class="form-control"
                        readonly
                        style="
                            border-radius:10px;
                            padding:11px;
                            background:#fff;">
                </div>

                <!-- EMAIL -->
                <div class="mb-3">

                    <label class="fw-semibold mb-2"
                        style="font-size:13px;">
                        Email
                    </label>

                    <input type="email"
                        id="editEmail"
                        class="form-control"
                        readonly
                        style="
                            border-radius:10px;
                            padding:11px;
                            background:#fff;">
                </div>

                <!-- TELEPON -->
                <div class="mb-3">

                    <label class="fw-semibold mb-2"
                        style="font-size:13px;">
                        No. Telepon
                    </label>

                    <input type="text"
                        id="editTelp"
                        class="form-control"
                        readonly
                        style="
                            border-radius:10px;
                            padding:11px;
                            background:#fff;">
                </div>

                <!-- JENIS KELAMIN -->
                <div class="mb-3">

                    <label class="fw-semibold mb-2"
                        style="font-size:13px;">
                        Jenis Kelamin
                    </label>

                    <div id="infoKelamin"
                        style="
                            border:1px solid #d1d5db;
                            border-radius:10px;
                            padding:12px;
                            background:white;
                            color:#374151;
                            font-weight:500;">

                        -
                    </div>

                </div>

                <!-- ALAMAT -->
                <div class="mb-3">

                    <label class="fw-semibold mb-2"
                        style="font-size:13px;">
                        Alamat
                    </label>

                    <textarea
                        id="editAlamat"
                        class="form-control"
                        rows="3"
                        readonly
                        style="
                            border-radius:10px;
                            background:#fff;"></textarea>

                </div>

                <!-- STATUS -->
                <div class="mb-3">

                    <label class="fw-semibold mb-2"
                        style="font-size:13px;">
                        Status Akun
                    </label>

                    <div class="d-flex justify-content-between align-items-center"
                        style="
                            border:1px solid #d1d5db;
                            border-radius:12px;
                            padding:14px;
                            background:white;">

                        <div>

                            <div class="fw-semibold"
                                style="font-size:14px;">
                                Aktifkan akun
                            </div>

                            <small class="text-muted"
                                style="font-size:12px;">
                                Memungkinkan akun mengakses semua sistem
                            </small>

                        </div>

                        <div class="form-check form-switch m-0">

                            <input class="form-check-input"
                                type="checkbox"
                                id="editStatus"
                                disabled
                                style="width:45px; height:22px;">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document.querySelectorAll('.btnEdit').forEach(button => {

    button.addEventListener('click', function () {

        // ID
        document.getElementById('editId').value =
            this.dataset.id;

        // NAMA
        document.getElementById('editNama').value =
            this.dataset.nama;

        // EMAIL
        document.getElementById('editEmail').value =
            this.dataset.email;

        // TELEPON
        document.getElementById('editTelp').value =
            this.dataset.telp;

        // ALAMAT
        document.getElementById('editAlamat').value =
            this.dataset.alamat;

        // FOTO
        const foto =
            this.dataset.foto;

        const previewFoto =
            document.getElementById('previewFoto');

        const uploadContent =
            document.getElementById('uploadContent');

        if (foto) {

            previewFoto.src = foto;

            previewFoto.style.display =
                'block';

            uploadContent.style.display =
                'none';

        } else {

            previewFoto.style.display =
                'none';

            uploadContent.style.display =
                'block';
        }

        // STATUS AKUN
        document.getElementById('editStatus').checked =
            this.dataset.status == 1;

        // JENIS KELAMIN
        document.getElementById('infoKelamin').innerHTML =

            this.dataset.kelamin === 'Laki-laki'

                ? '♂ Laki-laki'

                : '♀ Perempuan';

    });

});

</script>