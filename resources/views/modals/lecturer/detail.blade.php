<div class="modal fade" id="lecturerDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="detailPhoto" class="img-fluid w-100"
                    src="{{ asset('storage/images/lecturers/Zaza_1572852195_5dbfd1e38906d') }}" alt="Photo"></th>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>NIP</th>
                            <td id="detailPersonalId"></td>
                        </tr>
                        <tr>
                            <th>NIDN</th>
                            <td id="detailLecturerId"></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td id="detailName"></td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td id="detailPhoneNumber"></td>
                        </tr>
                        <tr>
                            <th>E-mail</th>
                            <td id="detailEmail"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="detailStatus"></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td id="detailPosition"></td>
                        </tr>
                        <tr>
                            <th>Pendidikan Terakhir</th>
                            <td id="detailEducation"></td>
                        </tr>
                        <tr>
                            <th>Bidang Minat</th>
                            <td id="">
                                <ul id="detailTopic">

                                </ul>
                            </td>
                        </tr>
                    </table>

                    <label>Status Pembimbing</label>
                    <table class="table table-bordered mb-3">
                        <tr>
                            <th>Dosen Pembimbing Pertama</th>
                            <td id="supervisor"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
