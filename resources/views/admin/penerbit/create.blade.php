<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><b>{{ $title }}</b></h2>

                    @isset($penerbit)
                        <form action="/aplikasikasir/penerbit/{{ $penerbit->id }}" method="POST">
                            @method('put')
                    @else
                    <form action="/aplikasikasir/penerbit" method="POST">
                    @endisset
                    
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Nama Penerbit</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Nama Penerbit" value="{{ isset($penerbit) ? $penerbit->name : old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <a href="/aplikasikasir/penerbit" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>