<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h2><b>{{ $title }}</b></h2>
                    <a href="/aplikasikasir/user/create" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>

                    <table class="table mt-1" id="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->level }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/aplikasikasir/user/{{ $item->id }}/edit" class="btn btn-info btn-sm m-1"><i class="fas fa-edit"></i></a>
                                    <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
                                    <form action="/aplikasikasir/user/{{ $item->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm m1-1"><i class="fas fa-trash"></i></button>
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
