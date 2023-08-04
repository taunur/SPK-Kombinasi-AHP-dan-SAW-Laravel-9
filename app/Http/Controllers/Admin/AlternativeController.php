<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AlternativesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlternativeStoreRequest;
use App\Http\Requests\Admin\AlternativeUpdateRequest;
use App\Imports\AlternativesImport;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;


class AlternativeController extends Controller
{
    // pagination
    protected $limit = 10;
    protected $fields = array('students.*', 'kelas.id as kelasId');
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // akses get
        if (auth()->user()->level === 'ADMIN' || auth()->user()->level === 'USER') {
            $alternatives = Alternative::with('user')->get();
        }

        // get student_id dari alternative
        $usedIds    = Alternative::select('student_id')->distinct()->get();
        $usedIdsFix = [];

        foreach ($usedIds as $usedId) {
            array_push($usedIdsFix, $usedId->student_id);
        }

        // menampilkan data alternatif
        $alternatives = Student::join('kelas', 'kelas.id', '=', 'students.kelas_id')
            ->whereIn('students.id', $usedIdsFix)
            ->orderBy('students.kelas_id')
            ->orderBy('students.name')
            ->with('alternatives');

        // dd(request('search'));
        // filter search
        if (request('search')) {
            $alternatives = Student::join('kelas', 'kelas.id', '=', 'students.kelas_id')
                ->where('students.name', 'LIKE', '%' . request('search') . '%')
                ->orWhere('kelas.kelas_name', 'LIKE', '%' . request('search') . '%')
                ->whereIn('students.id', $usedIdsFix)
                ->with('alternatives');
        }

        // @dd($alternatives);

        // student list tambah
        $studentsList = Student::join('kelas', 'kelas.id', '=', 'students.kelas_id')
            ->whereNotIn('students.id', $usedIdsFix)
            ->orderBy('kelas.id')
            ->orderBy('students.name', 'ASC')
            ->get(['students.*', 'kelas.id as kelasId'])
            ->groupBy('kelas.kelas_name');

        // Get value halaman yang dipilih dari dropdown
        $page = $request->query('page', 1);

        // Tetapkan opsi dropdown halaman yang diinginkan
        $perPageOptions = [5, 10, 15, 20, 25];

        // Get value halaman yang dipilih menggunaakan the query parameters
        $perPage = $request->query('perPage', $perPageOptions[1]);

        // Paginasi hasil dengan halaman dan dropdown yang dipilih
        $alternatives = $alternatives->paginate($perPage, $this->fields, 'page', $page);

        return view('pages.admin.alternatif.data', [
            'title'           => 'Data Alternatif',
            'alternatives'    => $alternatives,
            'criterias'       => Criteria::all(),
            'student_list'    => $studentsList,
            'perPageOptions'  => $perPageOptions,
            'perPage'         => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlternativeStoreRequest $request)
    {
        // menyimpan input siswa dengan kelas
        $pisah =  explode(" ", $request->student_id);
        // explode(" ", $request->student_id);
        $validate = $request->validated();

        // dd($pisah);
        foreach ($validate['criteria_id'] as $key => $criteriaId) {
            $data = [
                'student_id' => $pisah[0],
                'criteria_id' => $criteriaId,
                'kelas_id' => $pisah[1],
                'alternative_value' => $validate['alternative_value'][$key],
            ];
            // dd($data);
            Alternative::create($data);
        }

        return redirect('/dashboard/alternatif')
            ->with('success', 'Alternatif Baru telah ditambahkan!');
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
    public function edit(Alternative $alternatif)
    {
        // cek apakah ada kriteria baru yang belum diisi oleh pengguna
        $selectedCriteria = Alternative::where('student_id', $alternatif->student_id)->pluck('criteria_id');
        $newCriterias     = Criteria::whereNotIn('id', $selectedCriteria)->get();

        $alternatives      = Student::where('id', $alternatif->student_id)
            ->with('alternatives', 'alternatives.criteria')->first();

        // dd($alternatives);
        return view('pages.admin.alternatif.edit', [
            'title'        => "Edit Nilai $alternatives->name",
            'alternatives'  => $alternatives,
            'newCriterias' => $newCriterias
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlternativeUpdateRequest $request, Alternative $alternatif)
    {
        $pisah =  explode(" ", $request->new_student_id);
        $validate = $request->validated();

        // dd($pisah);

        // masukkan nilai alternatif baru jika ada kriteria baru
        if ($validate['new_student_id'] ?? false) {
            foreach ($validate['new_criteria_id'] as $key => $newCriteriaId) {
                $data = [
                    'student_id'        => $pisah[0],
                    'kelas_id'          => $validate['new_kelas_id'],
                    'criteria_id'       => $newCriteriaId,
                    'alternative_value' => $validate['new_alternative_value'][$key],
                ];

                Alternative::create($data);
            }
        }

        foreach ($validate['criteria_id'] as $key => $criteriaId) {
            $data = [
                'criteria_id'       => $criteriaId,
                'alternative_value' => $validate['alternative_value'][$key],
            ];

            Alternative::where('id', $validate['alternative_id'][$key])
                ->update($data);
        }

        return redirect('/dashboard/alternatif')
            ->with('success', 'Alternatif yang dipilih telah diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternative $alternatif)
    {
        Alternative::where('student_id', $alternatif->student_id)
            ->delete();

        return redirect('/dashboard/alternatif')
            ->with('success', 'Alternatif yang dipilih telah dihapus!');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        // validate
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file')->store('temp');

        try {
            Excel::import(new AlternativesImport, $file);

            return redirect('/dashboard/alternatif')->with('success', 'Alternatif berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect('/dashboard/alternatif')->with('error', 'Terjadi kesalahan saat mengimpor alternatif: ' . $e->getMessage());
        }
    }

    public function export()
    {
        // Mendapatkan data alternatif dari database
        $alternatives = Alternative::with('user')->get();

        // Memanggil kelas AlternativesExport untuk melakukan ekspor
        $export = new AlternativesExport($alternatives);

        // Menentukan nama file ekspor
        $fileName = 'Data Alternatif.xlsx';

        // Melakukan ekspor data alternatif ke file Excel
        Excel::store($export, $fileName);

        // Mengirimkan file ekspor sebagai respons
        return Response::download(storage_path('app/' . $fileName))->deleteFileAfterSend();
    }
}
