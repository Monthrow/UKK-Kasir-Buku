<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .resi-container {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .resi-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .resi-details {
            margin-bottom: 20px;
        }

        .resi-details label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .resi-details span {
            display: block;
            margin-bottom: 10px;
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
            clear: both;
        }

        .barcode img {
            max-width: 100%;
            height: auto;
        }

        .resi-sinopsis {
            border-top: 1px solid #ddd;
            padding-top: 20px;
            margin-top: 20px; /* Menambahkan margin atas pada .resi-sinopsis */
        }
    </style>
</head>
<body>
    <div class="resi-container">
        <div class="resi-header">
            <h2>Nota Pembelian</h2>
            <h3>BookHaven</h3>
            <p>Jalan Lika-Lika No. 02, RT 05 RW 06</p>
            <p>Kec. Ngawi, Kab. Sidoarjo</p>
        </div>
        <div class="resi-details">
            <label>Tanggal Pembayaran:</label> <span>{{$transaksi->created_at->timezone('Asia/Jakarta')}}</span><br>
            <table border="1" style="width: 500px; margin-bottom: 30px">
                <thead>
                    <tr>
                        <td><b>No.</b></td>
                        <td><b>Nama Buku</b></td>
                        <td><b>Jumlah</b></td>
                        <td><b>Subtotal</b></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi_detail as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->produk_name}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->subtotal}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span><b>Total:</b> Rp.{{ format_rupiah($transaksi->total) }}</span> 
            <span><b>Dibayarkan:</b> Rp.{{ format_rupiah($transaksi->dibayarkan) }}</span>
            <span><b>Kembalian:</b> Rp.{{ format_rupiah($transaksi->kembalian) }}</span> 
            <span><b>Kasir:</b> {{$transaksi->kasir_name}}</span>
            <span><b>Status:</b> {{$transaksi->status}}</span>
            <span style="vertical-align: middle;">{!! DNS1D::getBarcodeHTML('$ '. $item->buku, 'C39', 7.9, 50) !!}</span><br>
            <label style="text-align: center;"><i>"Terima Kasih Telah Berbelanja Di Toko Kami"</i></label>
        </div>
    </div>
</body>
</html>