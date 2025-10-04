<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $title = 'ผู้ใช้งาน';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => "ผู้ดูแลระบบ"],
            ['link' => route('user'), 'name' => $title]
        ];

        $users = User::where('status', 1)
            ->where(function ($query) use ($q) {
                if ($q) {
                    $query->where('name', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('oficer_id', 'like', '%' . $q . '%');
                }
            })->paginate(20)
            ->withQueryString();
        $me = auth()->user();
        return view('user.index', compact('q', 'title', 'breadcrumbs', 'users', 'me'));
    }

    public function create()
    {
        $title = 'เพิ่มผู้ใช้งาน';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => "ผู้ดูแลระบบ"],
            ['link' => route('user'), 'name' => 'ผู้ใช้งาน'],
            ['name' => $title]
        ];

        return view('user.create', compact('title', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'officer_id' => 'required|string|max:255',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ], [
            'name.required' => 'ระบุชื่อ - สกุลที่ถูกต้อง',
            'name.max' => 'ชื่อ - สกุลยาวเกินไป',
            'email.required' => 'ระบุอีเมลที่ใช้ได้จริง',
            'email.email' => 'ระบุอีเมลให้ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีในระบบอยู่แล้ว',
            'officer_id.required' => 'ระบุรหัสพนักงาน',
            'password.required' => 'ระบุรหัสผ่านที่ปลอดภัย',
            'password.confirmed' => 'ยืนยันรหัสผ่านให้ถูกต้องตรงกัน',
            'password.min' => 'รหัสผ่านต้องมีความยาวไม่น้อยกว่า 8 ตัวอักษร',
            'password_confirmation.required' => 'ยืนยันรหัสผ่านจำเป็นต้องระบุ',
        ]);

        $google2fa = app('pragmarx.google2fa');
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->officer_id = $request->officer_id;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->_2fa_secret = $google2fa->generateSecretKey();
        $user->save();

        return redirect()->route('user')->with('toast_success', 'เพิ่มข้อมูลเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $title = 'แก้ไขผู้ใช้งาน';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => "ผู้ดูแลระบบ"],
            ['link' => route('user'), 'name' => 'ผู้ใช้งาน'],
            ['name' => $title]
        ];

        $user = User::find($id);
        if ($user == null || $user->status == 0) {
            abort(404);
        }

        return view('user.edit', compact('title', 'breadcrumbs', 'user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'officer_id' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8'
        ], [
            'name.required' => 'ระบุชื่อ - สกุลที่ถูกต้อง',
            'name.max' => 'ชื่อ - สกุลยาวเกินไป',
            'email.required' => 'ระบุอีเมลที่ใช้ได้จริง',
            'email.email' => 'ระบุอีเมลให้ถูกต้อง',
            'email.unique' => 'อีเมลนี้มีในระบบอยู่แล้ว',
            'officer_id.required' => 'ระบุรหัสพนักงาน',
            'password.confirmed' => 'ยืนยันรหัสผ่านให้ถูกต้องตรงกัน',
            'password.min' => 'รหัสผ่านต้องมีความยาวไม่น้อยกว่า 8 ตัวอักษร',
            'password_confirmation.required' => 'ยืนยันรหัสผ่านจำเป็นต้องระบุ',
        ]);

        $user = User::find($id);
        if ($user == null || $user->status == 0) {
            abort(404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->officer_id = $request->officer_id;
        $user->role = $request->role;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->update();

        return redirect()->route('user')->with('toast_success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user == null || $user->status == 0) {
            abort(404);
        }

        if ($user->id == auth()->user()->id) {
            abort(403);
        }

        $user->status = 0;
        $user->update();

        return redirect()->route('user')->with('toast_success', 'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
