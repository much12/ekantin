<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use eKantin;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (!isAdmin()) {
            return redirect('dashboard');
        }

        $user = new User();

        $data['title'] = 'Master User';
        $data['users'] = $user->all();

        return view('user.index', $data);
    }

    public function modal_user_add()
    {
        if (!isAdmin()) {
            return redirect('dashboard');
        }

        $role = new Roles();

        $data = array();
        $data['role'] = $role->all();
        $data['type'] = 'ADD';

        return JSONResponse(array(
            'RESULT' => eKantin::OK,
            'CONTENT' => view('user.modal', $data)->render()
        ));
    }

    public function process_add_user(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(eKantin::FAILED, 'Access denied');
        }

        $nama = $request->post('nama');
        $username = $request->post('username');
        $password = $request->post('password');
        $confirmpassword = $request->post('confirmpassword');
        $role = $request->post('role');

        if ($nama == null || $username == null || $password == null || $role == null) {
            return JSONResponseDefault(eKantin::FAILED, 'Ada data yang masih kosong');
        }

        $roleCheck = Roles::find($role);
        $usernameCheck = User::find($username, array('username'));

        if ($roleCheck == null) {
            return JSONResponse(eKantin::FAILED, 'Role tidak ditemukan');
        } else if ($usernameCheck !== null) {
            return JSONResponse(eKantin::FAILED, 'Username yang anda masukkan sudah terdaftar');;
        } else if ($password !== $confirmpassword) {
            return JSONResponse(eKantin::FAILED, 'Password yang anda masukkan tidak sesuai');
        }

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->name = $nama;
        $user->roleId = $role;
        $user->balance = 0;

        $insert = $user->save();

        if ($insert) {
            return JSONResponseDefault(eKantin::OK, 'Data berhasil ditambahkan');
        } else {
            return JSONResponseDefault(eKantin::FAILED, 'Gagal menambahkan data');
        }
    }

    public function modal_user_edit(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(eKantin::FAILED, 'Access denied');
        }

        $userId = $request->post('userId');

        if ($userId == null) {
            return JSONResponseDefault(eKantin::ERROR, 'Error');
        }

        $user = User::find($userId);
        $role = new Roles();

        if ($user == null) {
            return JSONResponseDefault(eKantin::FAILED, 'User tidak ditemukan');
        }

        $data = array();
        $data['role'] = $role->all();
        $data['type'] = 'EDIT';
        $data['user'] = $user;

        return JSONResponse(array(
            'RESULT' => eKantin::OK,
            'CONTENT' => view('user.modal', $data)->render()
        ));
    }

    public function process_edit_user(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(eKantin::FAILED, 'Access denied');
        }

        $userId = $request->post('userId');
        $nama = $request->post('nama');
        $username = $request->post('username');
        $role = $request->post('role');

        if ($userId == null) {
            return JSONResponseDefault(eKantin::ERROR, 'Error');
        } else if ($nama == null || $role == null || $username == null) {
            return JSONResponseDefault(eKantin::FAILED, 'Ada data yang masih kosong');
        }

        $checkUser = User::find($userId);

        if ($checkUser == null) {
            return JSONResponseDefault(eKantin::FAILED, 'User tidak ditemukan');
        }

        $checkRole = Roles::find($role);

        if ($checkRole == null) {
            return JSONResponseDefault(eKantin::FAILED, 'Role tidak ditemukan');
        }

        $checkUsername = User::find($username, array('username'));

        if ($checkUsername !== null) {
            return JSONResponseDefault(eKantin::FAILED, 'Username yang anda masukkan sudah terdaftar');
        }

        $checkUser->username = $username;
        $checkUser->name = $nama;
        $checkUser->roleId = $role;

        $update = $checkUser->save();

        if ($update) {
            return JSONResponseDefault(eKantin::OK, 'Data berhasil diubah');
        } else {
            return JSONResponseDefault(eKantin::FAILED, 'Gagal mengubah data');
        }
    }

    public function process_delete_user(Request $request)
    {
        if (!isAdmin()) {
            return JSONResponseDefault(eKantin::FAILED, 'Access denied');
        }

        $userId = $request->post('userId');

        if ($userId == null) {
            return JSONResponseDefault(eKantin::ERROR, 'Error');
        }

        $checkUser = User::find($userId);

        if ($checkUser == null) {
            return JSONResponseDefault(eKantin::FAILED, 'User tidak ditemukan');
        }

        $delete = $checkUser->delete();

        if ($delete) {
            return JSONResponseDefault(eKantin::OK, 'Data berhasil dihapus');
        } else {
            return JSONResponseDefault(eKantin::FAILED, 'Gagal menghapus data');
        }
    }
}
