<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <h2><b>{{ $title }}</b></h2>
                    <a href="/aplikasikasir/penerbit/create" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>

                    <table class="table mt-1" id="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Penerbit</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($penerbit as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/aplikasikasir/penerbit/{{ $item->id }}/edit" class="btn btn-info btn-sm m-1"><i class="fas fa-edit"></i></a>
                                    <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
                                    <form action="/aplikasikasir/penerbit/{{ $item->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function(){
            $('#table').DataTable();
        });
    </script>
@endpush
