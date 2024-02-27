<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AdminTransaksiController extends Controller
{

    public function dibayarkan(Request $request, $id)
    {
            $request->validate([
                'dibayarkan' => 'required|numeric',
            ]);

            $transaksi = Transaksi::findOrfail($id);
            $totalBelanja = $transaksi->total;
            $dibayarkan = $request->input('dibayarkan');
            $kembalian = $dibayarkan - $totalBelanja;

            // simpan nilai kembalian ke dalam entri kembalian
            $transaksi->dibayarkan = $dibayarkan;
            $transaksi->kembalian = $kembalian;
            $transaksi->save();

            return response()->json([
                'success' => true,
                'kembalian' => $kembalian,
            ]);
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $query = Transaksi::orderBy('created_at', 'DESC');

        // Jika tanggal mulai dan akhir disertakan, tambahkan kondisi whereBetween
        if ($start_date && $end_date) {
            // Tambahkan waktu selesai pada akhir tanggal untuk mencakup seluruh hari yang dipilih
            $end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }
    
        $data = [
            'title' => 'Transaksi',
            'subTitle' => 'Atur Transaksi dengan Lebih Mudah',
            'transaksi' => $query->get(), // Ganti Model dengan model yang sesuai
            'transaksi_detail' => TransaksiDetail::get(),
            'content' => 'admin/transaksi/index'
        ];
        
    
        return view('admin.layouts.wrapper', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $data = [
            'user_id' => auth()->user()->id,
            'kasir_name' => auth()->user()->name,
            'total' => 0,
            'dibayarkan' => 0,
            'kembalian' => 0,
        ];
        $transaksi = Transaksi::create($data);
        return redirect('/aplikasikasir/transaksi/'.$transaksi->id.'/edit');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::get();

        $produk_id = request('produk_id');
        $p_detail = Produk::find($produk_id);

        $transaksi_detail = TransaksiDetail::whereTransaksiId($id)->get();

        $act = request('act');
        $qty = request('qty');
        if($act == 'min'){
            if($qty <= 1){
                $qty= 1;
            }else{
                $qty = $qty - 1;
            }
        }else{
            $qty = $qty + 1;
        }
        
        $subtotal = 0;
        if($p_detail){
            $subtotal = $qty * $p_detail->harga;
        }

        $transaksi = Transaksi::find($id);

        $dibayarkan = request('dibayarkan');
        $kembalian = $dibayarkan - $transaksi->total;

        
        
        $data= [
            'title'   => 'Tambah Transaksi',
            'produk' => $produk,
            'p_detail' => $p_detail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'transaksi_detail' => $transaksi_detail,
            'transaksi' => $transaksi,
            'kembalian' => $kembalian,
            'content' => 'admin/transaksi/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        Alert::success('Sukses', 'Data berhasil dihapus!!');
        return redirect()->back();
    }

    public function print($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi_detail = TransaksiDetail::where('transaksi_id', $id)->get();
        $pdf = Pdf::loadView('admin.transaksi.print', compact('transaksi', 'transaksi_detail'));
        return $pdf->stream();
    }

     

    public function lapor(Request $request)
    {
        // Validasi input tanggal
        $request->validate([

            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

   
        // Cek apakah tanggal awal kurang dari atau sama dengan tanggal akhir
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);


        if ($start_date->gt($end_date)) {

            // Tampilkan alert jika tanggal tidak valid
            return redirect()->back();
            Alert::error('Kesalahan', 'Tanggal awal tidak boleh lebih besar dari tanggal akhir.');
        }

   

        // Ambil data transaksi detail berdasarkan rentang tanggal
        $transaksiDetails = TransaksiDetail::whereBetween('created_at', [
            $start_date,
            $end_date->endOfDay(),
        ])->get();

   

        // Pass the transaction details data to the PDF view
        $data = [
            'transaksiDetails' => $transaksiDetails,
            'start_date' => $start_date,
            'end_date' => $end_date,
        ];


        // Load the PDF view
        $pdf = Pdf::loadView('admin.pdf.laporan', $data);

        // Return the PDF content for showing in the browser
        return $pdf->stream('laporan-transaksi.pdf');

    }
}
