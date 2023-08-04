<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\KelasUpdateRequest;
use App\Models\Kelas;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengurutkan
        $kelas = Kelas::orderby('kelas_name')
            ->get();

        return view('pages.admin.student.kelas.data', [
            'title'     => 'Data Kelas',
            'students' => '',
            'kelases' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.student.kelas.create', [
            'title'     => 'Buat kelas',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kelas_name' => 'required|max:30|unique:kelas',
            // 'slug' => 'required|unique:kelas',
        ]);

        $request['slug'] = Str::slug($request->kelas_name, '-');

        Kelas::create($validatedData);

        return redirect('/dashboard/student/kelas')->with('success', "Tambah kelas baru berhasil");
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
        $kelas = Kelas::FindOrFail($id);

        return view('pages.admin.student.kelas.edit', [
            'title' => "Edit data $kelas->kelas_name",
            'kelases' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(KelasUpdateRequest $request, $id)
    {
        $validatedData = $request->validated();

        $validatedData['slug'] = Str::slug($validatedData['kelas_name'], '-');
        $item = Kelas::findOrFail($id);
        $item->update($validatedData);

        return redirect('/dashboard/student/kelas')
            ->with('success', 'Kelas yang dipilih telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()
            ->route('kelas.index')
            ->with('success', 'Kelas yang dipilih telah dihapus!');
    }

    public function students(Kelas $kelas)
    {
        return view('pages.admin.student.kelas.detail', [
            'title' => $kelas->kelas_name,
            'students' => $kelas->students,
            'active' => 'kelas',
            'kelas' => $kelas->kelas_name,
        ]);
    }
}
