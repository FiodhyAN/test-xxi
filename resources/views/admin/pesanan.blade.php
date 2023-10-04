@extends('layouts.main')

@section('container')
    <div class="modal fade" id="detailTransaksiModal" tabindex="-1" aria-labelledby="detailTransaksiModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailTransaksiModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pesanan</h1>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pesanan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Transaksi</th>
                                <th>Tanggal Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->no_transaksi }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->nama_pelanggan }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp. {{ number_format($item->harga_total, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary badge badge-sm detailBtn"
                                            data-id="{{ $item->id }}" data-bs-toggle="modal"
                                            data-bs-target="#detailTransaksiModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var table = $('#dataTable').DataTable();

        $('.detailBtn').on('click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/getTransaksiById',
                method: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('.modal-title').text('Detail Transaksi ' + data[0].transaksi.no_transaksi);
                    const formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });
                    $('.modal-body').html('');
                    data.forEach(function(item) {
                        $('.modal-body').append(`
                            <div class="row align-items-center mb-5">
                                <div class="col-4">
                                    <img class="w-100 rounded-circle mb-3 mb-sm-0" src="${item.product.foto_produk}" alt="">
                                </div>
                                <div class="col-8">
                                    <h4>${item.product.nama_produk}</h4>
                                    <p class="m-0">${item.jumlah_product} x ${item.ukuran}</p>
                                    <p class="m-0">${formatter.format(item.harga_product)}</p>
                                </div>
                            </div>
                        `)
                    })
                },
                error: function(data) {
                    console.log(data);
                }
            })
        })
    </script>
@endsection
