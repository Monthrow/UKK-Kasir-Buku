<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><b>{{ $title }}</b></h2>

                    @isset($kategori)
                        <form action="/admin/kategori/{{ $kategori->id }}" method="POST">
                            @method('put')
                    @else
                    <form action="/admin/kategori" method="POST">
                    @endisset
                    
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Kategori</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama Kategori" value="{{ isset($kategori) ? $kategori->name : old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <a href="/admin/kategori" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>