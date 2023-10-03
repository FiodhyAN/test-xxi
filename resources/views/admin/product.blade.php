@extends('layouts.main')
@section('container')
    <form id="produk_form" action="/addProduk" method="POST">
        @csrf
        <div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="tambahProdukModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahProdukModalLabel">Tambah Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kode_produk" class="form-label">Kode Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan Kode Produk..."
                                    name="kode_produk" id="kode_produk">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Produk..."
                                    name="nama_produk" id="nama_produk">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expired_date" class="form-label">Expired Date</label>
                                <input type="date" class="form-control" placeholder="Masukkan Expired Date..."
                                    name="expired_date" id="expired_date">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" placeholder="Masukkan Harga Satuan..."
                                    name="harga_satuan" id="harga_satuan">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori" class="form-select">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    <option value="coffee">Coffee</option>
                                    <option value="non-coffee">Non-Coffee</option>
                                    <option value="snack">Snack</option>
                                    <option value="main course">Main Course</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" placeholder="Masukkan Foto Produk..."
                                    name="foto" id="foto">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- <form id="editForm" action="/updatePegawai" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data Pegawai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id_pegawai" name="id">
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">NIP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NIP..." name="nip"
                                    id="nip_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama..." name="nama"
                                    id="nama_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Lahir..."
                                    name="tempat_lahir" id="tempat_lahir_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" placeholder="Masukkan Tanggal Lahir..."
                                    name="tanggal lahir" id="tanggal_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="disabledTextInput" class="form-label">Alamat</label>
                                <textarea class="form-control" placeholder="Masukkan Alamat..." rows="3" name="alamat" id="alamat_edit"></textarea>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin_laki_edit" value="L">
                                    <label class="form-check-label" for="jenis_kelamin_laki">Laki-laki</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                        id="jenis_kelamin_perempuan_edit" value="P">
                                    <label class="form-check-label" for="jenis_kelamin_perempuan">Perempuan</label>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="golongan" class="form-label">Golongan</label>
                                <select class="form-select" name="golongan" id="golongan_edit">
                                    <option selected disabled value="">Pilih Golongan</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="tingkatan" class="form-label">Tingkatan</label>
                                <select class="form-select" id="tingkatan_edit" name="tingkatan">
                                    <option selected disabled value="">Pilih Tingkatan</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="eselon" class="form-label">Eselon</label>
                                <select class="form-select" id="eselon_edit" name="eselon">
                                    <option selected disabled value="">Pilih Eselon</option>
                                    <option value="I">I</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="V">V</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" placeholder="Masukkan Jabatan..."
                                    name="jabatan" id="jabatan_edit">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="tempat_tugas">Tempat Tugas</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Tugas..."
                                    name="tempat_tugas" id="tempat_tugas_edit">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <input type="text" class="form-control" placeholder="Masukkan Agama..."
                                    name="agama" id="agama_edit">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" placeholder="Masukkan No. HP..."
                                    name="no_hp" id="no_hp_edit">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="npwp" class="form-label">NPWP</label>
                                <input type="text" class="form-control" placeholder="Masukkan NPWP..." name="npwp"
                                    id="npwp_edit">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="formFile" class="form-label">Upload Foto</label>
                                <input class="form-control" type="file" id="formFile" name="foto"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </div>
            </div>
        </div>
    </form> --}}

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Produk</h6>
                <button class="btn btn-success float-right mr-2" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
                    <i class="fas fa-plus"></i>
                    Tambah Produk</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Expired Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#dataTable').DataTable();
    </script>
@endsection
