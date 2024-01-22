<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><b>{{ $title }}</b></h2>

                    @isset($produk)
                        <form action="/admin/produk/{{ $produk->id }}" method="POST">
                            @method('put')
                    @else
                    <form action="/admin/produk" method="POST">
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
                            <label for=""><b>Stok</b></label>
                            <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                            placeholder="Stok" value="{{ isset($produk) ? $produk->stok : old('stok') }}">
                            @error('stok')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        

                        <a href="/admin/produk" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>