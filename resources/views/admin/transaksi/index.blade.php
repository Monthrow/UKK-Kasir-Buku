<div class="container-fluid pt-2">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-body">
                    
                <!-- Date Range Search -->
                @if (auth()->user()->level=="Admin")
                        <form action="/aplikasikasir/transaksi" method="GET" class="form-inline mb-3">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <div class="form-group d-flex">
                                        <label for="start_date" class="mr-1">Mulai Tanggal :</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control mr-5">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="form-group d-flex">
                                        <label for="end_date" class="mr-1">Akhir Tanggal :</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control mr-5">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn btn-primary">Filter Tanggal</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @endif

                    <h2><b>{{ $title }}</b></h2>
                    @if(auth()->user()->level=='Kasir')
                    <a href="/aplikasikasir/transaksi/create" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah</a>
                    @endif

                    <table class="table mt-1" id="table">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @foreach ($transaksi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->status }}</td>
                            <td> Rp.{{ format_rupiah($item->total) }}</td>
                            <td>
                                <div class="d-flex">
                                    @if(auth()->user()->level=='Admin')
                                    <!-- <a href="/aplikasikasir/transaksi/{{ $item->id }}/edit" class="btn btn-info btn-sm m-1"><i class="fas fa-edit"></i></a> -->
                                    <a href="/aplikasikasir/transaksi/{{ $item->id }}/print" class="btn btn-info btn-sm m-1"><i class="fas fa-print"></i></a>
                                    <!-- <a href="" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a> -->
                                    @endif
                                    @if(auth()->user()->level=='Kasir')
                                    <form action="/aplikasikasir/transaksi/{{ $item->id }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
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






