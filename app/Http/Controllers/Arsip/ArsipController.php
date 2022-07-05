<?php

namespace App\Http\Controllers\Arsip;

//use datatables;
use Yajra\DataTables\DataTables;
use App\Models\Unit;
use App\Models\User;
use App\Models\Arsip;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JenisArsip;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $jeniss = Jenis::all();
        $jenis_arsip = JenisArsip::all();
        $units = Unit::all();
        
        $alluser = User::with('unit')->has('unit')->get();

        return view('arsip.index', compact('user', 'jeniss' , 'units', 'alluser', 'jenis_arsip'));
    }
    
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jenis_arsip_id' => 'required',
            'judul_arsip' => 'required',
            'lokasi_arsip' => 'required',
            'jenis_id' => 'required',
            'no_berkas' => 'required',
            'tahun' => 'required',
            'pencipta_arsip' => 'required',
            'uraian_arsip' => 'required',
            'user_id' => 'required',
            'file_arsip' => 'required',
        ]);
        
        //nama file_arsip di rubah
        $namaFile = time()."-".str_replace(' ', '-', $request->file_arsip->getClientOriginalName());

        //user yang sedang login
        //ambil tahun
        $tahun = $request->tahun;
        //ambil unit user
        $unit = User::with('unit')->find($request->user_id);
        //ambil jenis arsip
        $jenis =Jenis::where('id', $request->jenis_id)->first()->name;
        //ambil nama user
        
        $user = Auth::user()->name;

        //buat folder per user dengan nama unit
        $folderUser = $unit->unit->name;
        $request->file_arsip->move(public_path()."/upload/$folderUser/$tahun/". $jenis ,$namaFile);

        //inisialisasi nama file_arsip
        $validateData['file_arsip'] = $namaFile;

        //simpan arsip ke database
        Arsip::create($validateData);

        return redirect()->route('arsip.index')->with('success', 'Data berhasil ditambahkan');
       
        // $all = User::with('unit')->find($request->user_id);
        // dd($all->unit->name);
       
    }

    public function data(Request $request)  
    {
        //ambil id user
        $user = Auth::user()->id;
        //jika user super admin 
        if (Auth::user()->roles->pluck('name')->contains('super admin') || Auth::user()->roles->pluck('name')->contains('admin')) {
                if ($request->ajax()) {
                    $arsip = Arsip::with(['user','jenis', 'jenis_arsip'])->get();
                    return Datatables::of($arsip)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn = '<div class="d-flex">';
                                $btn = $btn. '<a href="'. route('arsip.detail', $row->id) .'" class="btn btn-info btn-sm">Detail</a>&nbsp;';
                                $btn = $btn.' <a href="'. route('arsip.edit', $row->id) .'" class="btn btn-primary btn-sm">Edit</a>&nbsp;';
                                $btn = $btn. '<form action="' .route('arsip.delete', $row->id) . '}" method="POST">
                                            '.csrf_field().'
                                             '.method_field("DELETE").'
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm(\'Are You Sure Want to Delete?\')">Hapus</button>
                                            </form>';
                                $btn = $btn. '</div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }

                return view('arsip.data');

        }else{
                if ($request->ajax()) {
                    $arsip = Arsip::with('jenis')->where('user_id', $user)->get();
                    return Datatables::of($arsip)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                                $btn = '<div class="d-flex">';
                                $btn = $btn. '<a href="'. route('arsip.detail', $row->id) .'" class="btn btn-info btn-sm">Detail</a>&nbsp;';
                                $btn = $btn.' <a href="'. route('arsip.edit', $row->id) .'" class="edit btn btn-primary btn-sm">Edit</a>&nbsp;';
                                $btn = $btn.' <form action="' .route('arsip.delete', $row->id) . '}" method="POST">
                                            '.csrf_field().'
                                            '.method_field("DELETE").'
                                            <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm(\'Are You Sure Want to Delete?\')">Hapus</button>
                                            </form>';
                                $btn = $btn. '</div>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
                return view('arsip.data');
        }        
    }

    public function edit(Arsip $arsip)
    {   
        $user = Auth::user();
        $units = Unit::all();
        $unit = User::with('unit')->find($arsip->user_id);
        $jenis = Jenis::all();
        $jenis_arsip = JenisArsip::all();
        $alluser = User::with('unit')->has('unit')->get();
        

        //$user = $arsip->user->id;
        return view('arsip.edit', compact('arsip', 'user', 'units', 'alluser', 'jenis', 'unit', 'jenis_arsip'));
    }

    public function detail(Arsip $arsip)
    {
        //user super admin
        if (Auth::user()->roles->pluck('name')->contains('super admin') || Auth::user()->roles->pluck('name')->contains('admin')) {
                $data = Arsip::with(['user', 'jenis', 'jenis_arsip'])->findOrFail($arsip->id);
                $unit = User::with('unit')->findorFail($arsip->user_id);
                return view('arsip.detail', compact('data', 'unit'));
                //$data = Arsip::with('jenis_arsip')->findOrFail($arsip->id);
                //dd($data);
            
        }else{
            //user biasa
            //keamanan url
            $id = Auth::user()->id;
            if ($id != $arsip->user_id) {
                // /echo "<script>alert('Mau Ngedit Punya Siapa Hayoo ????')</script>";
                abort(404);
                
            }else{
                $data = Arsip::with(['user', 'jenis'])->find($arsip->id);
                $unit = User::with('unit')->findorFail($arsip->user_id);
                return view('arsip.detail', compact('data', 'unit'));
                
            }
        }
    }

    public function download(Arsip $arsip)
    {
        $data = Arsip::with(['user', 'jenis'])->find($arsip->id);
        $unit = User::with('unit')->find($arsip->user_id);

        $folderUnit = $unit->unit->name;
        $tahun = $arsip->tahun;
        $jenis = $data->jenis->name;
        $file = $data->file_arsip;


        $file_path = public_path()."/upload/$folderUnit/$tahun/$jenis/$file";
        return response()->download($file_path);
        //dd($data);
    }

    public function update(Request $request, Arsip $arsip)
    {
        $validateData = $request->validate([
            'jenis_arsip_id' => 'required',
            'judul_arsip' => 'required',
            'lokasi_arsip' => 'required',
            'jenis_id' => 'required',
            'no_berkas' => 'required',
            'tahun' => 'required',
            'pencipta_arsip' => 'required',
            'uraian_arsip' => 'required',
            'user_id' => 'required',
        ]);

        if (Auth::user()->roles->pluck('name')->contains('super admin') || Auth::user()->roles->pluck('name')->contains('admin')) {
            // $tahunsblm = $arsip->tahun;
            // $jenissblm = $arsip->jenis->name;
            // $unit = User::with('unit')->find($arsip->user_id)->unit->name;
            // dd($unit);
            if ($request->hasFile('file_arsip')) {
                //ambil data sebelumnya
                $namaFileSblm = $arsip->file_arsip;
                $tahunsblm = $arsip->tahun;
                $jenissblm = $arsip->jenis->name;

                //nama file_arsip di rubah
                $namaFile = time()."-".str_replace(' ', '-', $request->file_arsip->getClientOriginalName());

                //user yang sedang login
                $tahun = $request->tahun;

                //ambil unit user
                $unit = User::with('unit')->find($arsip->user_id)->unit->name;
                //ambil jenis arsipnya
                $jenis =Jenis::where('id', $request->jenis_id)->first()->name;
                //ambil nama user
                $user = Auth::user()->name;

                //buat folder per user
                $folderUser = $unit;

                 //ambil data arsip sebelumnya
                $file_path = public_path()."/upload/$folderUser/$tahunsblm/$jenissblm/$namaFileSblm";

                unlink($file_path);
                $request->file_arsip->move(public_path()."/upload/$folderUser/$tahun/". $jenis ,$namaFile);

                //inisialisasi nama file_arsip
                $validateData['file_arsip'] = $namaFile;
                //dd($file_path);

            }   
             //dd($request->tahun);
            $arsip->update($validateData);
            return redirect()->route('arsip.index')->with('success', 'Data berhasil diubah');
            
        }else {
            //keamanan url
            $id = Auth::user()->id;
            if ($id != $arsip->user_id) {
                //echo "<script>alert('Mau Ngedit Punya Siapa Hayoo ????')</script>";
                abort(404);
                
            }else{
               
                if ($request->hasFile('file_arsip')) {
                    //ambil data sebelumnya
                    $namaFileSblm = $arsip->file_arsip;
                    $tahunsblm = $arsip->tahun;
                    $jenissblm = $arsip->jenis->name;
    
                    //nama file_arsip di rubah
                    $namaFile = time()."-".str_replace(' ', '-', $request->file_arsip->getClientOriginalName());
    
                    //user yang sedang login
                    $tahun = $request->tahun;
    
                    //ambil unit user
                    $unit = Auth::user()->unit->name;
                    //ambil jenis arsipnya
                    $jenis =Jenis::where('id', $request->jenis_id)->first()->name;
                    //ambil nama user
                    $user = Auth::user()->name;
    
                    //buat folder per user
                    $folderUser = $unit;
    
                     //ambil data arsip sebelumnya
                    $file_path = public_path()."/upload/$folderUser/$tahunsblm/$jenissblm/$namaFileSblm";
    
                    unlink($file_path);
                    $request->file_arsip->move(public_path()."/upload/$folderUser/$tahun/". $jenis ,$namaFile);
    
                    //inisialisasi nama file_arsip
                    $validateData['file_arsip'] = $namaFile;
                    //dd($file_path);
    
                }   
                 //dd($request->tahun);
                $arsip->update($validateData);
                return redirect()->route('arsip.index')->with('success', 'Data berhasil diubah');   
            }
        }
        
    }

    public function destroy(Arsip $arsip)
    {
        $namaFile = $arsip->file_arsip;

        $tahun = $arsip->tahun;
        //ambil unit user
        $unit = User::with('unit')->find($arsip->user_id);
        //ambil jenis arsip
        $jenis =Jenis::where('id', $arsip->jenis_id)->first()->name;
         //buat folder per user dengan nama unit
         $folderUser = $unit->unit->name;
        //dd(public_path()."/upload/$folderUser/$tahun/$jenis/$namaFile");
        $arsip->delete();
        unlink(public_path()."/upload/$folderUser/$tahun/$jenis/$namaFile");
        return redirect()->route('arsip.data')->with('pesan', "Hapus $arsip->nama berhasil");
    }
}
