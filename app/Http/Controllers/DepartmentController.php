<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q', '');
        $departments = Department::where('status', 1)
            ->where('name', 'like', '%' . $q . '%')
            ->orderBy('order_by', 'asc')
            ->paginate(10);

        $title = 'หน่วยงาน/แผนก';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => '', 'name' => $title],
        ];

        return view('departments.index', compact('departments', 'q', 'title', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'เพิ่มหน่วยงาน/แผนก';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => '', 'name' => $title],
        ];

        return view('departments.create', compact('title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order_by' => 'nullable|integer',
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->description = $request->description;
        $department->save();

        return redirect()->route('departments')->with('toast_success', 'เพิ่มหน่วยงาน/แผนกเรียบร้อยแล้ว');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        if ($department == null || $department->status != 1) {
            abort(404);
        }

        $title = 'แก้ไขหน่วยงาน/แผนก';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => '', 'name' => $title],
        ];

        return view('departments.edit', compact('department', 'title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        if ($department == null || $department->status != 1) {
            abort(404);
        }

        $department->name = $request->name;
        $department->description = $request->description;
        $department->update();

        return redirect()->route('departments')->with('toast_success', 'แก้ไขหน่วยงาน/แผนกเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $department = Department::findOrFail($id);
        if ($department == null || $department->status != 1) {
            abort(404);
        }

        $department->status = 0;
        $department->update();

        return redirect()->route('departments')->with('toast_success', 'ลบหน่วยงาน/แผนกเรียบร้อยแล้ว');
    }
}
