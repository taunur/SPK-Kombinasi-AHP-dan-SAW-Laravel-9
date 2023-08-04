<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.user.data', [
            'title' => 'Data Pengguna',
            'users' => User::whereNot('id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create', [
            'title' => 'Buat Pengguna',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $validate = $request->validated();

        $validate['password'] = Hash::make($validate['password']);

        User::create($validate);

        return redirect('/dashboard/users')
            ->with('success', 'Pengguna baru telah ditambahkan!');
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
    public function edit(User $user)
    {
        return view('pages.admin.user.edit', [
            'title' => 'Edit Pengguna',
            'user'  => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validate = $request->validated();

        if ($validate['password'] ?? false) {
            $validate['password'] = Hash::make($validate['password']);
        }

        User::where('id', $user->id)
            ->update($validate);

        return redirect('/dashboard/users')
            ->with('success', 'Pengguna yang dipilih telah dihapus!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = User::findOrFail($id);
        $kelas->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Pengguna yang dipilih telah dihapus!');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file')->store('temp');

        try {
            $import = new UsersImport;
            $import->import($file);

            return redirect('/dashboard/users')->with('success', 'File Pengguna Berhasil Diimpor!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}
