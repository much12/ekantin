<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!isSeller())
            return redirect()->back()->with("error", "Hanya penjual yang dapat mengakses halaman ini");

        $data['title'] = "Etalase";
        $data['barang'] = Barang::all();

        return view('barang.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Produk";
        return view('barang.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!isSeller())
            return redirect()->back()->with("error", "Hanya penjual yang dapat mengakses halaman ini");

        $this->validate($request,[
            'nama' => 'required|max:100',
            'kategori' => 'in:makanan,minuman|required',
            'harga' => 'required|numeric|max:99999999',
            'stock' => 'required|integer|max:9999',
            'gambar' => 'nullable|mimes:jpeg,jpg,png,gif',
            'keterangan' => 'nullable'
        ],[
            'nama.required' => 'Nama barang tidak boleh kosong',
            'kategori.required' => 'Kategori tidak boleh kosong',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga harus angka',
            'stock.required' => 'Stok tidak boleh kosong',
            'stock.integer' => 'Stok harus angka',
        ]);

        $barang = new Barang;
        $barang->namaBarang = $request->input('nama');
        $barang->kategori = $request->input('kategori');
        $barang->harga = $request->input('harga');
        $barang->stock = $request->input('stock');
        $barang->userId = getCurrentIdUser();
        $barang->gambar = "";
        $barang->keterangan = $request->input('keterangan');
        if($request->file('gambar')){
            $saveGambar = $request->file('gambar')->store('gambarBarang','public');
            $barang->gambar = $saveGambar;
        }
        $barang->save();

        return redirect()->back()->with("success", "Data berhasil di simpan");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = "Ubah Produk";
        $data['barang'] = Barang::find($id);
        return view('barang.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        if(file_exists(storage_path('/app/public/'.$barang->gambar)))
            Storage::delete($barang->gambar);
        $barang->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
