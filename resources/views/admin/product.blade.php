@extends('layouts.main')
@section('container')
    <form id="produk_form" action="/addProduct" method="POST">
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
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto_produk" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" placeholder="Masukkan Foto Produk..."
                                    name="foto_produk" id="foto" accept="image/*">
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

    <form id="editForm" action="/updateProduct" method="POST">
        @csrf
        @method('PUT')
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Ubah Data Pegawai</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="id" name="id">
                            <div class="col-md-6 mb-3">
                                <label for="kode_produk" class="form-label">Kode Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan Kode Produk..."
                                    name="kode_produk" id="kode_produk_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Produk..."
                                    name="nama_produk" id="nama_produk_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="expired_date" class="form-label">Expired Date</label>
                                <input type="date" class="form-control" placeholder="Masukkan Expired Date..."
                                    name="expired_date" id="expired_date_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" placeholder="Masukkan Harga Satuan..."
                                    name="harga_satuan" id="harga_satuan_edit">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori" id="kategori_edit" class="form-select">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    <option value="coffee">Coffee</option>
                                    <option value="non-coffee">Non-Coffee</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="foto_produk" class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" placeholder="Masukkan Foto Produk..."
                                    name="foto_produk" id="foto" accept="image/*">
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
    </form>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Produk</h6>
                <button class="btn btn-success float-right mr-2" data-bs-toggle="modal"
                    data-bs-target="#tambahProdukModal">
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
        let table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/getProduct',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'kode_produk',
                    name: 'kode_produk'
                },
                {
                    data: 'nama_produk',
                    name: 'nama_produk'
                },
                {
                    data: 'kategori',
                    name: 'kategori'
                },
                {
                    data: 'harga_satuan',
                    name: 'harga_satuan'
                },
                {
                    data: 'expired_date',
                    name: 'expired_date'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });

        $('#tambahProdukModal').on('hidden.bs.modal', function(e) {
            $('#produk_form').trigger('reset');
        });

        $('#produk_form').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Loading',
                html: 'Mohon Tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            })
            let formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(data) {
                    $('#tambahProdukModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil ditambahkan'
                    });
                },
                error: function(data) {
                    let text = data.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        table.on('click', '#deleteBtn', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Loading',
                        html: 'Mohon Tunggu',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                    })
                    $.ajax({
                        url: '/deleteProduct',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(data) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil dihapus'
                            });
                        },
                        error: function(data) {
                            let text = data.responseJSON.message;
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: text
                            });
                        }
                    });
                }
            });
        })

        table.on('click', '#editBtn', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/getProductById',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#editModal').modal('show');
                    $('#id').val(data.product.id);
                    $('#kode_produk_edit').val(data.product.kode_produk);
                    $('#nama_produk_edit').val(data.product.nama_produk);
                    $('#expired_date_edit').val(data.product.expired_date);
                    $('#harga_satuan_edit').val(data.product.harga);
                    $('#kategori_edit').val(data.product.kategori);
                    $('#kategori_edit').trigger('change');
                },
                error: function(data) {
                    let text = data.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    });
                }
            });
        })

        $('#editForm').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Loading',
                html: 'Mohon Tunggu',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                },
            })
            let formData = new FormData(this);
            $.ajax({
                url: '/updateProduct',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                success: function(data) {
                    $('#editModal').modal('hide');
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diubah'
                    });
                },
                error: function(data) {
                    let text = data.responseJSON.message;
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: text
                    });
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
@endsection
