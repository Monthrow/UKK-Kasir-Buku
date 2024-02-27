@php
use App\Http\Controllers\AdminProdukController;
@endphp

<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><b>{{ $title }}</b></h2>

                    @isset($produk)
                        <form action="/aplikasikasir/produk/{{ $produk->id }}" method="POST">
                            @method('put')
                    @else
                    <form action="/aplikasikasir/produk" method="POST">
                    @endisset
                    
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Buku</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama Buku" value="{{ isset($produk) ? $produk->name : old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Kode</b></label>
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode"
                            placeholder="Kode" value="{{ isset($produk) ? $produk->kode : old('kode') }}">
                            @error('kode')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for=""><b>Nama Penerbit</b></label>
                            <select name="penerbit_id" class="form-control @error('penerbit_id') is-invalid @enderror" id="">
                                <option value="">Penerbit</option>
                                @foreach ($penerbit as $item)
                                    <option value="{{ $item->id }}" {{ isset($produk) ? $item->id == $produk->penerbit_id ? 'selected' : '' : '' }}>{{ $item->name }}</option> 
                                @endforeach
                            </select>
                            @error('penerbit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Genre</b></label>
                            <select name="publisher_id" class="form-control @error('publisher_id') is-invalid @enderror" id="">
                                <option value="">Genre</option>
                                @foreach ($publisher as $item)
                                    <option value="{{ $item->id }}" {{ isset($produk) ? $item->id == $produk->publisher_id ? 'selected' : '' : '' }}>{{ $item->name }}</option> 
                                @endforeach
                            </select>
                            @error('publisher_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Nama Kategori</b></label>
                            <select name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror" id="">
                                <option value="">Kategori</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}" {{ isset($produk) ? $item->id == $produk->kategori_id ? 'selected' : '' : '' }}>{{ $item->name }}</option> 
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Tahun Terbit</b></label>
                            <select name="tahun_terbit" class="form-control @error('tahun_terbit') is-invalid @enderror" id="">
                                <option value="">Tahun</option>
                                @for ($i = date('Y'); $i >= 1990; $i--)
                                    <option value="{{ $i }}" {{ isset($produk) && $i == $produk->tahun_terbit ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tahun_terbit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Harga</b></label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga"
                            placeholder="Harga" value="{{ isset($produk) ? $produk->harga : old('harga') }}">
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for=""><b>Diskon</b></label>
                            <input type="number" class="form-control @error('diskon') is-invalid @enderror" name="diskon"
                            placeholder="Diskon" value="{{ isset($produk) ? $produk->diskon : old('diskon') }}">
                            @error('diskon')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for=""><b>Stok</b></label>
                            <select name="stok" class="form-control @error('stok') is-invalid @enderror" id="">
                                <option value="">---</option>
                                @for ($i = 0; $i <= 100; $i++)
                                    <option value="{{ $i }}" {{ isset($produk) && $i == $produk->stok ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> -->
                        <div class="form-group">
                            <label for=""><b>Stok</b></label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                            placeholder="Stok" value="{{ isset($produk) ? $produk->stok : old('stok') }}" min="0">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        

                        <a href="/aplikasikasir/produk" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>