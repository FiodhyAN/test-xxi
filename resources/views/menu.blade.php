<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cafe Bahagia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free Website Template" name="keywords">
    <meta content="Free Website Template" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assets/css/styleMenu.min.css" rel="stylesheet">
</head>

<body>
    <form action="/addToCart" method="POST" id="addToCart">
        @csrf
        <input type="hidden" id="id_product" name="id">
        <div class="modal" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="" alt="" class="w-100" id="productImage">
                            </div>
                            <div class="col-md-6">
                                <h4 class="text-primary">Harga</h4>
                                <input type="number" id="harga_produk" class="form-control mb-3" readonly
                                    name="harga_produk">
                                <h4 class="text-primary">Ukuran</h4>
                                <select name="ukuran" id="ukuran" class="form-control mb-3">
                                    <option value="S">S</option>
                                    <option value="M">M (+ Rp. 5.000)</option>
                                    <option value="L">L (+ Rp. 10.000)</option>
                                </select>
                                <h4 class="text-primary">Jumlah</h4>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary" type="button" id="minusBtn"><i
                                                class="fa fa-minus"></i></button>
                                    </div>
                                    <input type="text" class="form-control text-center" value="1" id="qty"
                                        readonly name="jumlah">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" id="plusBtn"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add To Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="/checkout" method="POST" id="checkoutForm">
        @csrf
        <div class="modal" id="cartModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="nama_pelanggan" class="text-primary">Nama Pelanggan</label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control mb-3"
                            placeholder="Masukkan Nama Anda..." required>
                        <div id="modal_body_cart">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="#" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-4 text-uppercase text-white">Cafe Bahagia</h1>
            </a>
        </nav>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 position-relative overlay-bottom">
        <div class="d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5"
            style="min-height: 400px">
            <h1 class="display-4 mb-3 mt-0 mt-lg-5 text-white text-uppercase">Menu</h1>
            <div class="d-inline-flex mb-lg-5">
                <p class="m-0 text-white"><a class="text-white" href="">Home</a></p>
                <p class="m-0 text-white px-2">/</p>
                <p class="m-0 text-white">Menu</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Menu Start -->
    <div class="container-fluid pt-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Menu & Pricing</h4>
                <h1 class="display-4">Competitive Pricing</h1>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="mb-5">Coffee</h1>
                    <!-- Coffee items -->
                    @foreach ($coffee as $item_c)
                        <button class="btn btn-block text-left mb-5 productBtn" data-id="{{ $item_c->id }}"
                            data-toggle="modal" data-target="#productModal">
                            <div class="row align-items-center mb-5">
                                <div class="col-4 col-sm-3">
                                    <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ $item_c->foto_produk }}"
                                        alt="">
                                </div>
                                <div class="col-8 col-sm-9">
                                    <h4>{{ $item_c->nama_produk }}</h4>
                                    <p class="m-0">Rp. {{ number_format($item_c->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-5">Non Coffee</h1>
                    <!-- Non-coffee items -->
                    @foreach ($non_coffee as $item_n)
                        <button class="btn btn-block text-left mb-5 productBtn" data-id="{{ $item_n->id }}"
                            data-toggle="modal" data-target="#productModal">
                            <div class="row align-items-center mb-5">
                                <div class="col-4 col-sm-3">
                                    <img class="w-100 rounded-circle mb-3 mb-sm-0" src="{{ $item_n->foto_produk }}"
                                        alt="">
                                </div>
                                <div class="col-8 col-sm-9">
                                    <h4>{{ $item_n->nama_produk }}</h4>
                                    <p class="m-0">Rp. {{ number_format($item_n->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
            <!-- Checkout button -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <button class="btn btn-primary btn-lg" id="checkoutBtn" data-toggle="modal"
                        data-target="#cartModal">Checkout</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/lib/easing/easing.min.js"></script>
    <script src="/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="/assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/assets/mail/jqBootstrapValidation.min.js"></script>
    <script src="/assets/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/assets/js/mainMenu.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('.productBtn').on('click', function() {
            var id = $(this).data('id');

            $.ajax({
                url: '/getProductById',
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    function updatePrice() {
                        var qty = parseInt($('#qty').val(), 10);
                        var ukuran = $('#ukuran').val();
                        var price_satuan = data.product.harga;

                        if (ukuran === 'M') {
                            price_satuan += 5000;
                        } else if (ukuran === 'L') {
                            price_satuan += 10000;
                        }

                        var price = price_satuan * qty;
                        $('#harga_produk').val(price);
                    }

                    $('#qty').val(1);
                    updatePrice();

                    $('#plusBtn').off('click').on('click', function() {
                        var qty = parseInt($('#qty').val(), 10);
                        qty++;
                        $('#qty').val(qty);
                        updatePrice();
                    });

                    $('#minusBtn').off('click').on('click', function() {
                        var qty = parseInt($('#qty').val(), 10);
                        qty = Math.max(qty - 1, 1);
                        $('#qty').val(qty);
                        updatePrice();
                    });

                    $('#ukuran').on('change', function() {
                        updatePrice();
                    });

                    $('.modal-title').html(data.product.nama_produk);
                    $('#productImage').attr('src', data.product.foto_produk);
                    $('#id_product').val(data.product.id);
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

        $('#productModal').on('hidden.bs.modal', function() {
            $('#ukuran').val('S');
            $('#ukuran').trigger('change');
        })

        $('#addToCart').on('submit', function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                url: '/addToCart',
                type: 'POST',
                data: data,
                success: function(data) {
                    $('#productModal').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message
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
        });

        $('#checkoutBtn').on('click', function() {
            $.ajax({
                url: '/getCart',
                type: 'GET',
                success: function(data) {
                    $('#modal_body_cart').html('');
                    var total_harga = 0;
                    const formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });
                    data.forEach(function(item) {
                        $('#modal_body_cart').append(`
                            <div class="row align-items-center mb-5">
                                <div class="col-4">
                                    <img class="w-100 rounded-circle mb-3 mb-sm-0" src="${item.foto_produk}" alt="">
                                </div>
                                <div class="col-5">
                                    <h4>${item.nama_produk}</h4>
                                    <p class="m-0">${item.quantity} x ${item.ukuran}</p>
                                    <p class="m-0">${formatter.format(item.harga)}</p>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-danger btn-sm btn-block deleteCartBtn" data-id="${item.id}" data-ukuran="${item.ukuran}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        `);
                        var hargaNumber = parseInt(item.harga);
                        total_harga += hargaNumber;
                    });
                    console.log(total_harga)
                    $('#modal_body_cart').append(`
                        <div class="row align-items-center mb-5">
                            <div class="col-12">
                                <h4 class="text-center">Total Harga: ${formatter.format(total_harga)}</h4>
                            </div>
                        </div>
                    `);

                },
                error: function(data) {
                    console.log(data)
                }
            });
        })

        $('#cartModal').on('click', '.deleteCartBtn', function() {
            var id = $(this).data('id');
            var ukuran = $(this).data('ukuran');

            $.ajax({
                url: '/deleteCart',
                type: 'POST',
                data: {
                    id: id,
                    ukuran: ukuran
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#modal_body_cart').html('');
                    var total_harga = 0;
                    const formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });
                    data.forEach(function(item) {

                        $('#modal_body_cart').append(`
                            <div class="row align-items-center mb-5">
                                <div class="col-4">
                                    <img class="w-100 rounded-circle mb-3 mb-sm-0" src="${item.foto_produk}" alt="">
                                </div>
                                <div class="col-5">
                                    <h4>${item.nama_produk}</h4>
                                    <p class="m-0">${item.quantity} x ${item.ukuran}</p>
                                    <p class="m-0">${formatter.format(item.harga)}</p>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-danger btn-sm btn-block deleteCartBtn" data-id="${item.id}" data-ukuran="${item.ukuran}"><i class="fa fa-trash"></i></button>
                                </div>
                            </div>
                        `);
                        var hargaNumber = parseInt(item.harga);
                        total_harga += hargaNumber;
                    });

                    $('#modal_body_cart').append(`
                        <div class="row align-items-center mb-5">
                            <div class="col-12">
                                <h4 class="text-center">Total Harga: ${formatter.format(total_harga)}</h4>
                            </div>
                        </div>
                    `);
                },
                error: function(data) {
                    console.log(data)
                }
            });
        })
    </script>
</body>

</html>
