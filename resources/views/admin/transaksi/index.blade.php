<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <h2><b>{{ $title }}</b></h2>
                    <a href="/admin/transaksi/create" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>

                    <table class="table mt-1">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->status }}</td>
                            <td> Rp.{{ format_rupiah($item->total) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="/admin/transaksi/{{ $item->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                    <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
                                    <form action="/admin/transaksi/{{ $item->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $transaksi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
