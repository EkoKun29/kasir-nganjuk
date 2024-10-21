<?php

namespace App\Http\Controllers;

use App\Models\API\Barang;
use App\Models\Audit;
use App\Models\OpnameGlobal;
use Illuminate\Http\Request;

class AuditController extends Controller
{
      //AUDIT 1
      public function index(){

        $item = collect([
            ['penyetok' => 'PAK KIS'],
            ['penyetok' => 'SULISTYONO'],
            ['penyetok' => 'AZIZ'],
            ['penyetok' => 'PAK RIDWAN'],
        ]);

        $kategori = 1;
        if($kategori == 1){
        $data = Audit::where('kategori',1)->orderBy('id','desc')->paginate(10);
        }

        $barang = Barang::all();
        return view('audit1.index',compact('data', 'barang', 'kategori', 'item'));
    }

    public function create(Request $request){

        $nama = $request->nama_barang;
        $isi_perdus =Barang::where('nama',$nama)->first();
        $total = $request->duz * $isi_perdus->isi + $request->btl;

        // $opname=OpnameGlobal::where('nama_barang',$nama)->first();

        // if($opname !=null){
        //     $sumTotal = $opname->
        //     total + $total;
        //     $opname->total = $sumTotal;
        //     $opname->save();

        //     $data = new Audit;
        //     $data->id_opname_global=$opname->id;
        //     $data->nama_barang = $request->nama_barang;
        //     $data->duz= $request->duz;
        //     $data->btl= $request->btl;
        //     $data->penyetok = $request->penyetok;
        //     $nama = $request->nama_barang;
        //     $isi_perdus =Barang::where('nama',$nama)->first();
        //     $data->update([
        //         'total' => $data->duz * $isi_perdus->isi + $data->btl
                
        //     ]);
        //     $data->total=$data->duz * $isi_perdus->isi + $data->btl;

        //     $data->kategori=$request->kategori;
        //     $data->save();
        //     return redirect()->route('audit1.index')->with('success', 'Data Berhasil Ditambahkan');

        // }else{
        //     $global = new OpnameGlobal;
        //     $global->nama_barang = $request->nama_barang;
        //     $global->total = $total;
        //     $global->audit = $request->kategori;
        //     $global->save();

            $data = new Audit;
            // $data->id_opname_global=$global->id;
            $data->nama_barang = $request->nama_barang;
            $data->duz= $request->duz;
            $data->btl= $request->btl;
            $data->penyetok = $request->penyetok;
            $nama = $request->nama_barang;
            $isi_perdus =Barang::where('nama',$nama)->first();
            $data->update([
                'total' => $data->duz * $isi_perdus->isi + $data->btl
                
            ]);
            $data->total=$data->duz * $isi_perdus->isi + $data->btl;
            $data->kategori=$request->kategori;
            $data->save();
            return redirect()->route('audit1.index')->with('success', 'Data Berhasil Ditambahkan');
        
    }

    public function detailAudit($id){
        $item = collect([
            ['penyetok' => 'PAK KIS'],
            ['penyetok' => 'SULISTYONO'],
            ['penyetok' => 'AZIZ'],
            ['penyetok' => 'PAK RIDWAN'],
        ]);
        $barang = Barang::all();
        $audit = Audit::where('id_opname_global', $id)->get();
        $global = OpnameGlobal::where('id',$id)->first();

        $kategori = Audit::where('id_opname_global', $id)->first()->kategori;


        if($kategori == 1){
        $data = Audit::where('nama_barang',$global->nama_barang)->orderBy('id','desc')->paginate(10);
        return view('audit1.index',compact('data', 'barang', 'kategori', 'global'));
        }
        elseif($kategori == 2){
            $data = Audit::where('nama_barang',$global->nama_barang)->orderBy('id','desc')->paginate(10);
        return view('audit2.index',compact('data', 'barang', 'kategori', 'global'));
        }
        else{
            $data = Audit::where('nama_barang',$global->nama_barang)->orderBy('id','desc')->paginate(10);
        return view('audit3.index',compact('data', 'barang', 'kategori', 'global'));
        }
        
    }

    public function edit($id){
        $data = Audit::find($id);
        $barang = Barang::all();
        return view('audit1.edit',compact('data', 'barang'));
    }

    public function update(Request $request, $id){
        $data = Audit::find($id);
        $data->update($request->except('_token', '_method'));
        $nama = $request->nama_barang;
        $isi_perdus =Barang::
        where('nama',$nama)->first();
        
        
        $data->update([
            'total' => $data->duz * $isi_perdus->isi + $data->btl
            
        ]);
        return redirect()->route('audit1.index')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id){
        $data = Audit::find($id);
        $data->delete();
        return redirect()->route('audit1.index')->with('success', 'Data Berhasil Dihapus');
    }


    //AUDIT 2
    public function index2(){

        $item = collect([
            ['penyetok' => 'PAK KIS'],
            ['penyetok' => 'SULISTYONO'],
            ['penyetok' => 'AZIZ'],
            ['penyetok' => 'PAK RIDWAN'],
        ]);

        $kategori = 2;
        if($kategori == 2){
        $data = Audit::where('kategori',2)->orderBy('id','desc')->paginate(10);
        }
        $barang = Barang::all();
        return view('audit2.index',compact('data', 'barang','kategori', 'item'));
    }

    public function create2(Request $request){

        $nama = $request->nama_barang;
        $isi_perdus =Barang::where('nama',$nama)->first();
        $total = $request->duz * $isi_perdus->isi + $request->btl;

        // $opname=OpnameGlobal::where('nama_barang',$nama)->first();

        // if($opname !=null){
        //     $sumTotal = $opname->
        //     total + $total;
        //     $opname->total = $sumTotal;
        //     $opname->save();

        //     $data = new Audit;
        //     $data->id_opname_global=$opname->id;
        //     $data->nama_barang = $request->nama_barang;
        //     $data->duz= $request->duz;
        //     $data->btl= $request->btl;
        //     $data->penyetok = $request->penyetok;
        //     $nama = $request->nama_barang;
        //     $isi_perdus =Barang::where('nama',$nama)->first();
        //     $data->update([
        //         'total' => $data->duz * $isi_perdus->isi + $data->btl
                
        //     ]);
        //     $data->total=$data->duz * $isi_perdus->isi + $data->btl;

        //     $data->kategori=$request->kategori;
        //     $data->save();
        //     return redirect()->route('audit2.index')->with('success', 'Data Berhasil Ditambahkan');

        // }else{
        //     $global = new OpnameGlobal;
        //     $global->nama_barang = $request->nama_barang;
        //     $global->total = $total;
        //     $global->audit = $request->kategori;
        //     $global->save();

            $data = new Audit;
            // $data->id_opname_global=$global->id;
            $data->nama_barang = $request->nama_barang;
            $data->duz= $request->duz;
            $data->btl= $request->btl;
            $data->penyetok = $request->penyetok;
            $nama = $request->nama_barang;
            $isi_perdus =Barang::where('nama',$nama)->first();
            $data->update([
                'total' => $data->duz * $isi_perdus->isi + $data->btl
                
            ]);
            $data->total=$data->duz * $isi_perdus->isi + $data->btl;
            $data->kategori=$request->kategori;
            $data->save();
            return redirect()->route('audit2.index')->with('success', 'Data Berhasil Ditambahkan');
        
       
    }

    public function edit2($id){
        $data = Audit::find($id);
        $barang = Barang::all();
        return view('audit2.edit',compact('data', 'barang'));
    }

    public function update2(Request $request, $id){
        $data = Audit::find($id);
        $data->update($request->except('_token', '_method'));
        return redirect()->route('audit2.index')->with('success', 'Data Berhasil Diubah');
    }

    public function delete2($id){
        $data = Audit::find($id);
        $data->delete();
        return redirect()->route('audit2.index')->with('success', 'Data Berhasil Dihapus');
    }

    //AUDIT 3
    public function index3(){

        $item = collect([
            ['penyetok' => 'PAK KIS'],
            ['penyetok' => 'SULISTYONO'],
            ['penyetok' => 'AZIZ'],
            ['penyetok' => 'PAK RIDWAN'],
        ]);

        $kategori = 3;
        if($kategori == 3){
        $data = Audit::where('kategori',3)->orderBy('id','desc')->paginate(10);
        }   
        $barang = Barang::all();
        return view('audit3.index',compact('data', 'barang', 'kategori', 'item'));
    }

    public function create3(Request $request){

        $nama = $request->nama_barang;
        $isi_perdus =Barang::where('nama',$nama)->first();
        $total = $request->duz * $isi_perdus->isi + $request->btl;

        // $opname=OpnameGlobal::where('nama_barang',$nama)->first();

        // if($opname !=null){
        //     $sumTotal = $opname->
        //     total + $total;
        //     $opname->total = $sumTotal;
        //     $opname->save();

        //     $data = new Audit;
        //     $data->id_opname_global=$opname->id;
        //     $data->nama_barang = $request->nama_barang;
        //     $data->duz= $request->duz;
        //     $data->btl= $request->btl;
        //     $data->penyetok = $request->penyetok;
        //     $nama = $request->nama_barang;
        //     $isi_perdus =Barang::where('nama',$nama)->first();
        //     $data->update([
        //         'total' => $data->duz * $isi_perdus->isi + $data->btl
                
        //     ]);
        //     $data->total=$data->duz * $isi_perdus->isi + $data->btl;

        //     $data->kategori=$request->kategori;
        //     $data->save();
        //     return redirect()->route('audit3.index')->with('success', 'Data Berhasil Ditambahkan');

        // }else{
        //     $global = new OpnameGlobal;
        //     $global->nama_barang = $request->nama_barang;
        //     $global->total = $total;
        //     $global->audit = $request->kategori;
        //     $global->save();

            $data = new Audit;
            // $data->id_opname_global=$global->id;
            $data->nama_barang = $request->nama_barang;
            $data->duz= $request->duz;
            $data->btl= $request->btl;
            $data->penyetok = $request->penyetok;
            $nama = $request->nama_barang;
            $isi_perdus =Barang::where('nama',$nama)->first();
            $data->update([
                'total' => $data->duz * $isi_perdus->isi + $data->btl
                
            ]);
            $data->total=$data->duz * $isi_perdus->isi + $data->btl;
            $data->kategori=$request->kategori;
            $data->save();
            return redirect()->route('audit3.index')->with('success', 'Data Berhasil Ditambahkan');
        

    }

    public function edit3($id){

        //edit opname
        $global = OpnameGlobal::
        where('id',$id)->first();

        //edit audit
        $data = Audit::find($id);
        $barang = Barang::all();

        return view('audit3.edit',compact('data', 'barang', 'global'));
    }

    public function update3(Request $request, $id){

        $global = OpnameGlobal::where('id',$id)->first();
        $data = Audit::find($id);
        $data->update($request->except('_token', '_method'));
        return redirect()->route('audit3.index')->with('success', 'Data Berhasil Diubah');
    }

    public function delete3($id){
        $data = Audit::find($id);
        // $global = OpnameGlobal::where
        // ('id',$data->id_opname_global)->get();
        // foreach
        // ($global as $g) {
        //     $g->delete();
        // }
        $data->delete();
        
        // $data->delete();
        return redirect()->route('audit3.index')->with('success', 'Data Berhasil Dihapus');
    }
    
}
