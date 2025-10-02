<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));

        $documents = Document::with('category')
            ->when($q !== '', function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->paginate(100);

        $title = 'ข้อมูลไฟล์เอกสาร';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => '', 'name' => $title],
        ];

        return view('documents.index', compact('documents', 'q', 'title', 'breadcrumbs'));
    }

    public function create()
    {
        $title = 'เพิ่มข้อมูลไฟล์เอกสาร';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('documents'), 'name' => 'ข้อมูลไฟล์เอกสาร'],
            ['link' => '', 'name' => $title],
        ];

        $categories = Category::where('status', 1)->orderBy('created_at', 'asc')->get();

        return view('documents.create', compact('title', 'breadcrumbs', 'categories'));
    }
}
