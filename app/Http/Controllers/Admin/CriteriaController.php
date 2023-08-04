<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CriteriaStoreRequest;
use App\Http\Requests\Admin\CriteriaUpdateRequest;
use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.kriteria.data', [
            'title'     => 'Data Kriteria',
            'criterias' => Criteria::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.kriteria.create', [
            'title' => 'Buat Kriteria Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriteriaStoreRequest $request)
    {
        $validatedData = $request->validated();

        $request['slug'] = Str::slug($request->name, '-');

        Criteria::create($validatedData);

        return redirect('/dashboard/kriteria')
            ->with('success', 'Kriteria baru telah ditambahkan!');
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
        $kriterium = Criteria::FindOrFail($id);

        return view('pages.admin.kriteria.edit', [
            'title' => "Edit kriteria $kriterium->name",
            'criteria' => $kriterium,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CriteriaUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name'], '-');

        $item = Criteria::findOrFail($id);
        $item->update($data);

        return redirect('/dashboard/kriteria')
            ->with('success', 'Kriteria yang dipilih telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriterium = Criteria::findOrFail($id);
        $kriterium->delete();

        return redirect('/dashboard/kriteria')
            ->with('success', 'Kriteria yang dipilih telah dihapus!');
    }
}
