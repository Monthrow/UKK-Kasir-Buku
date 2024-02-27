<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><b>{{ $title }}</b></h2>

                    @isset($publisher)
                        <form action="/aplikasikasir/genre/{{ $publisher->id }}" method="POST">
                            @method('put')
                    @else
                    <form action="/aplikasikasir/genre" method="POST">
                    @endisset
                    
                        @csrf
                        <div class="form-group">
                            <label for=""><b>Genre</b></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Genre" value="{{ isset($publisher) ? $publisher->name : old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <a href="/aplikasikasir/genre" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>