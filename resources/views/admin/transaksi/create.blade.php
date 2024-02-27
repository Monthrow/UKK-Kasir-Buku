<!-- <div class="container-fluid pt-2">
    <div class="row">

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="row mt-1">
                        <div class="col-md-4">
                            <label for="">Kode Produk</label>
                        </div>
                        <div class="col-md-8">
                            <form method="GET">
                                <div class="d-flex">
                                    <select name="produk_id" class="form-control" id="">
                                        <option value="">--{{ isset($p_detail) ? $p_detail->name : 'Nama Produk' }}--</option>
                                        @foreach ($produk as $item)
                                            <option value="{{ $item->id }}">{{ $item->id.'-'. $item->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </div>
                            </form>
                        </div>
                    </div>

                     <div class="row mt-1">
    <div class="col-md-4">
        <label for="">Kode Produk</label>
    </div>
    <div class="col-md-8">
        <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari Produk" oninput="searchProducts()">
            <div class="input-group-append">
                <button type="button" onclick="searchProducts()" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3" id="productList" style="display: none;">
    @foreach ($produk as $item)
        <div class="col-md-4 mb-3 product-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->id.'-'.$item->name }}</h5>
                    <a href="#" class="btn btn-primary">Pilih</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

                    <form action="/aplikasikasir/transaksi/detail/create" method="POST">
                        @csrf
                        <input type="hidden" name="transaksi_id" value="{{ Request::segment(3) }}">
                        <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                        <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Nama Produk</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($p_detail) ? $p_detail->name : '' }}" class="form-control" disabled name="nama_produk">
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">Harga Satuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" value="{{ isset($p_detail) ? $p_detail->harga : '' }}" class="form-control" disabled name="harga_satuan">
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label for="">QTY</label>
                            </div>
                            <div class="col-md-8">
                                <div class="d-flex">
                                    <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-minus"></i></a>
                                    <input type="number" value="{{ $qty }}" class="form-control" name="qty">
                                    <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <h5>Subtotal : Rp. {{ format_rupiah($subtotal) }}</h5>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8">
                                <a href="/aplikasikasir/transaksi" class="btn btn-info"><i class="fas fa-arrow-left"></i> Kembali </a>
                                <button type="submit" class="btn btn-primary"> Tambah <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>QTY</th>
                            <th>Subtotal</th>
                            <th>#</th>
                        </tr>

                        @foreach ($transaksi_detail as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->produk_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ 'Rp. '.format_rupiah($item->subtotal) }}</td>
                            <td>
                                <a href="/aplikasikasir/transaksi/detail/delete?id={{ $item->id }}"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>

                    <a href="" class="btn btn-info"><i class="fas fa-file"></i> Pending </a>
                    <a href="/aplikasikasir/transaksi/detail/selesai/{{ Request::segment(3) }}" class="btn btn-success"><i class="fas fa-check"></i> Selesai </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row p-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="form-group">
                            <label for="">Total Belanja</label>
                            <input type="number" value="{{ $transaksi->total }}" name="total_belanja" class="form-control" id="">
                        </div>

                        <div class="form-group">
                            <label for="">Dibayarkan</label>
                            <input type="number" name="dibayarkan" value="{{ request('dibayarkan') }}" class="form-control" id="">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block"> Hitung </button>
                    </form>
                    <hr>


                    <div class="form-group">
                        <label for="">Uang Kembalian</label>
                        <input type="number" value="{{ format_rupiah($kembalian) }}" disabled name="kembalian" class="form-control" id="">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    function searchProducts() {
        var input, filter, cards, card, title, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        cards = document.getElementsByClassName("product-card");
        productList = document.getElementById("productList");

        // Hide the product list initially
        productList.style.display = "none";

        // Check if the filter is empty or whitespace only
        if (filter.trim() === "") {
            // Show all products if the search input is empty
            for (i = 0; i < cards.length; i++) {
                card = cards[i];
                card.style.display = "";
            }
        } else {
            // Filter products based on the search input
            for (i = 0; i < cards.length; i++) {
                card = cards[i];
                title = card.querySelector(".card-title");
                txtValue = title.textContent || title.innerText;

                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "";
                    // Show the product list if there are search results
                    productList.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }
    }
</script> -->

<div class="row p-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="">Kode Produk</label>
                    </div>
                    <div class="col-md-8">
                        <form method="GET">
                            <div class="d-flex">
                                <select name="produk_id" class="form-control" id="">
                                    <option value="">--Nama Produk--</option>
                                    @foreach ($produk as $item)
                                        <option value="{{ $item->id }}">{{ $loop->iteration }}. {{$item->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary ml-2">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>

                <form action="/aplikasikasir/transaksi/detail/create" method="POST">
                    @csrf

                    <input type="hidden" name="transaksi_id" value="{{ Request::segment(3) }}">
                    <input type="hidden" name="produk_id" value="{{ isset($p_detail) ? $p_detail->id : '' }}">
                    <input type="hidden" name="produk_name" value="{{ isset($p_detail) ? $p_detail->name : '' }}">
                    <input type="hidden" name="qty" value="{{ $qty }}">
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" name="produk_stok" value="{{ isset($p_detail) ? $p_detail->stok : '' }}">

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="">Nama Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="nama_produk" value="{{ isset($p_detail) ? $p_detail->name : '' }}" disabled>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="">Harga Satuan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="harga_satuan" value="{{ isset($p_detail) ? format_rupiah($p_detail->harga) : '' }}" disabled>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="">QTY</label>
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                
                                <a href="?produk_id={{ request('produk_id') }}&act=min&qty={{ $qty }}" class="btn btn btn-primary"><i class="fas fa-minus"></i></a>
                                <input type="number" class="form-control mx-1" name="qty" value="{{ $qty }}" readonly>
                                <a href="?produk_id={{ request('produk_id') }}&act=plus&qty={{ $qty }}" class="btn btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="">Diskon</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group input-group">
                                <input type="text" class="form-control" name="diskon" value="{{ isset($p_detail) ? format_rupiah($p_detail->diskon) : '' }}" disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="">Stok Produk</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="stok_produk" value="{{ isset($p_detail) ? $p_detail->stok : '' }}" disabled>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex">
                                <h6>Subtotal : Rp {{ format_rupiah($subtotal) }}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-8">
                            
                                <a href="/aplikasikasir/transaksi" class="btn btn-info mr-2"><i class="fas fa-arrow-left mr-2"></i>Kembali</a>
                                <button type="submit" class="btn btn-primary">Tambah<i class="fas fa-arrow-right ml-2"></i></button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="body-card p-1 pt-0">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>QTY</th>
                        <th>Sub Total</th>
                        <th>#</th>
                    </tr>
                    @foreach ($transaksi_detail as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->produk_name }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ format_rupiah($item->subtotal) }},-</td>
                            <td>
                                <a href="/aplikasikasir/transaksi/detail/delete?id={{ $item->id }}"><i class="fas fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <a href="/aplikasikasir/transaksi/detail/selesai/{{ Request::segment(3) }}" id="btnSelesai" class="btn btn-succsess mr-2 {{ empty($dibayarkan) || $dibayarkan < $transaksi->total ? 'disabled' : '' }}"><i class="fas fa-check mr-2"></i>Selesai</a>
        <!-- <a href="" class="btn btn-secondary"><i class="fas fa-file mr-2"></i>Pending</a> -->
    </div>
</div>

<div class="row p-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="formDibayarkan" method="POST">
                    @csrf
                    <!-- Input for total belanja -->
                    <div class="form-group">
                        <label for="total_belanja">Total Belanja</label>
                        <div class="input-group">
                            <!-- Disabled input field for displaying total belanja -->
                            <input type="number" value="{{ $transaksi->total }}" name="total_belanja" class="form-control" disabled>
                        </div>
                    </div>
                    <!-- Input for dibayarkan -->
                    <div class="form-group">
                        <label for="dibayarkan">Dibayarkan</label>
                        <div class="input-group">
                            <!-- Buttons for preset dibayarkan values -->
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(50000)">Rp 50,000</button>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(100000)">Rp 100,000</button>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(150000)">Rp 150,000</button>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(200000)">Rp 200,000</button>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(250000)">Rp 250,000</button>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <button type="button" class="btn btn-primary btn-block" onclick="setDibayarkan(300000)">Rp 300,000</button>
                                </div>
                            </div>
                            <!-- Input field for custom dibayarkan value -->
                            <div class="input-group-prepend mt-2">
                                <span class="input-group-text white">Rp</span>
                            </div>
                            <input type="number" name="dibayarkan" id="dibayarkan" value="{{ request('dibayarkan') }}" class="form-control mt-2">
                        </div>
                    </div>
                    <!-- Hidden input field for storing dibayarkan value -->
                    <input type="hidden" name="dibayarkan_hidden" value="{{ isset($transaksi) ? format_rupiah($transaksi->dibayarkan) : '' }}">
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mt-2 mb-2" onclick="hitungKembalian()">Hitung</button>
                </form>                
            
            <script>
                function hitungKembalian() {
                    var dibayarkan = parseInt(document.getElementById('dibayarkan').value);
                    var totalBelanja = {{ $transaksi->total }};
                    var kembalian = dibayarkan - totalBelanja;

                    document.getElementById('kembalian').value = kembalian;

                    // Memeriksa apakah jumlah uang yang dibayarkan mencukupi
                    if (dibayarkan >= totalBelanja) {
                        // Mengaktifkan tombol "Selesai"
                        document.getElementById('btnSelesai').classList.remove('disabled');
                    } else {
                        // Menonaktifkan tombol "Selesai"
                        document.getElementById('btnSelesai').classList.add('disabled');
                    }

                    if (dibayarkan == 0) {
                        document.getElementById('kembalian-info').innerText = "Masukkan total tunai yang dibayarkan.";
                    } else if (dibayarkan > 0 && dibayarkan < totalBelanja) {
                        document.getElementById('kembalian-info').innerText = "Uang yang Anda masukkan kurang.";
                    } else {
                        document.getElementById('kembalian-info').innerText = "";
                    }
                }

                document.getElementById('formDibayarkan').addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah pengiriman formulir default

                    var formData = new FormData(this);

                    // Kirim permintaan AJAX
                    fetch('/aplikasikasir/transaksi/{{ $transaksi->id }}/dibayarkan', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Tampilkan pesan sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Perhitungan berhasil.'
                            });

                            // Update nilai kembalian
                            document.getElementById('kembalian').value = data.kembalian;
                        } else {
                            // Tampilkan pesan error jika perhitungan gagal
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan dalam perhitungan.'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            </script>
            

            <div class="form-group">
                <label for="kembalian">Uang Kembalian</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text white">Rp</span>
                    </div>
                    <input type="text" value="{{ $kembalian }}" class="form-control" id="kembalian" readonly>
                </div>
                <small id="kembalian-info" class="text-danger"></small>
            </div>

        </div>
    </div>
</div>
<script>
    function setDibayarkan(value) {
        document.getElementById('dibayarkan').value = value;
    }
</script>
