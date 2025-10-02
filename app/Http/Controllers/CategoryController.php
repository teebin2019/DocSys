<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->input('q', '');
        $categories = Category::where('status', 1)
            ->when($q, function ($query, $q) {
                return $query->where('name', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%');
            })
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        $title = 'หมวดหมู่เอกสาร';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => '', 'name' => $title],
        ];

        return view('categories.index', compact('categories', 'q', 'title', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'เพิ่มหมวดหมู่เอกสาร';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('categories'), 'name' => 'หมวดหมู่เอกสาร'],
            ['link' => '', 'name' => $title],
        ];

        return view('categories.create', compact('title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);
        if ($slug === '' || Str::length($slug) < 3) {
            $slug = Str::random(8);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('categories')->with('toast_success', 'เพิ่มหมวดหมู่เรียบร้อยแล้ว');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category == null || $category->status != 1) {
            abort(404);
        }

        $title = 'แก้ไข ' . $category->name;
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('categories'), 'name' => 'หมวดหมู่เอกสาร'],
            ['link' => '', 'name' => $title],
        ];

        return view('categories.edit', compact('category', 'title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        if ($category == null || $category->status != 1) {
            abort(404);
        }

        if ($category->slug != $request->slug) {
            $slug = Str::slug($request->slug);
            if ($slug === '' || Str::length($slug) < 3) {
                $slug = Str::random(8);
            }
            $category->slug = $slug;
        }
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();

        return redirect()->route('categories')->with('toast_success', 'อัปเดตหมวดหมู่เรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $category = Category::findOrFail($id);
        if ($category == null || $category->status != 1) {
            abort(404);
        }

        $category->status = 0;
        $category->update();

        return redirect()->route('categories')->with('toast_success', 'ลบหมวดหมู่เรียบร้อยแล้ว');
    }
}
