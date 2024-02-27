<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminTransaksiDetailController extends Controller
{
    function create(Request $request)
{
    // $produk_id = $request->produk_id;
    // $transaksi_id = $request->transaksi_id;
    
    // // Update stock
    // $produk = Produk::find($produk_id);
    // $newStock = $produk->stok - $request->qty;
    // $produk->update(['stok' => $newStock]);

    // $td = TransaksiDetail::whereProdukId($produk_id)->whereTransaksiId($transaksi_id)->first();
    
    // $transaksi = Transaksi::find($transaksi_id);
    // $diskonPersen = $produk->diskon; // Assuming $produk->diskon represents the discount percentage

    // if ($td == null) {
    //     $discountedAmount = $request->subtotal * $diskonPersen / 100;
    //     $newSubtotal = $request->subtotal - $discountedAmount;
 
    //     $data = [
    //         'produk_id' => $produk_id,
    //         'produk_name' => $request->produk_name,
    //         'transaksi_id' => $transaksi_id,
    //         'qty' => $request->qty,
    //         'subtotal' => $newSubtotal,
    //     ];
    //     TransaksiDetail::create($data);
    
    //     $dt = [
    //         'total' => $newSubtotal + $transaksi->total,
    //     ];
    //     $transaksi->update($dt);
    // } else {
    //     $discountedAmount = $request->subtotal * $diskonPersen / 100;
    //     $newSubtotal = $request->subtotal - $discountedAmount;

    //     $subtotal = $td->subtotal + $newSubtotal;
    //     $data = [
    //         'qty' => $td->qty + $request->qty,
    //         'subtotal' => $subtotal,
    //     ];
    //     $td->update($data);
    
    //     $dt = [
    //         'total' => $subtotal + $transaksi->total,
    //     ];
    //     $transaksi->update($dt);
    // }
    $produk_id = $request->produk_id;
    $transaksi_id = $request->transaksi_id;

    // Update stock
    $produk = Produk::find($produk_id);

// Pengecekan apakah stok mencukupi
if ($produk == null || $request->qty > $produk->stok) {
    // Handle situasi stok tidak mencukupi, misalnya dengan memberikan pesan kesalahan
    Alert::error('Sukses', 'Stok yang ada tidak mencukupi');
    return redirect()->back()->with('error', 'Stok tidak mencukupi untuk pembelian ini.');
}

$newStock = $produk->stok - $request->qty;
$produk->update(['stok' => $newStock]);

$td = TransaksiDetail::whereProdukId($produk_id)->whereTransaksiId($transaksi_id)->first();

$transaksi = Transaksi::find($transaksi_id);

// ... (bagian kode lainnya tetap sama)

    // Menghitung diskon dalam persentase
    $diskonPersen = $produk->diskon;
    if ($td == null) {
        // Perhitungan diskon saat pertama kali ditambahkan
        $subtotal = ($request->subtotal - ($request->subtotal * $diskonPersen / 100));
        $data = [
            'produk_id'    => $produk_id,
            'produk_name'  => $request->produk_name,
            'transaksi_id' => $transaksi_id,
            'qty'          => $request->qty,
            'subtotal'     => $subtotal,
        ];


        TransaksiDetail::create($data);
        $dt = [
            'total' => $subtotal + $transaksi->total,
        ];
        $transaksi->update($dt);
    } else {
        // Perhitungan diskon saat tambahan barang
        $subtotal = ($request->subtotal - ($request->subtotal * $diskonPersen / 100));
        $data = [
            'qty'      => $td->qty + $request->qty,
            'subtotal' => $td->subtotal + $subtotal,
        ];
        $td->update($data);
        $dt = [
            'total' => $transaksi->total + $subtotal,
        ];
        $transaksi->update($dt);
    }

    return redirect('/aplikasikasir/transaksi/'.$transaksi_id.'/edit');
}

    function delete(){
        $id = request('id');
    $td = TransaksiDetail::find($id);
    
    $transaksi = Transaksi::find($td->transaksi_id);

    // Update stock
    $produk = Produk::find($td->produk_id);
    $newStock = $produk->stok + $td->qty;
    $produk->update(['stok' => $newStock]);

    $data = [
        'total' => $transaksi->total - $td->subtotal,
    ];
    $transaksi->update($data);

    $td->delete();
    return redirect()->back();
    }

    function done($id)
    {
        $transaksi = Transaksi::find($id);
        $data = [
            'status' => 'selesai'
        ];
        $transaksi->update($data);
        return redirect('/aplikasikasir/transaksi')->with('berhasil', $id);
    }
}
