<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Document;

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
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $category = Category::findOrFail($id);
        if ($category == null || $category->status != 1) {
            abort(404);
        }

        $title = $category->name;
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('categories'), 'name' => 'หมวดหมู่เอกสาร'],
            ['link' => '', 'name' => $title],
        ];

        $q = trim($request->query('q', ''));
        $documents = Document::where('category_id', $id)
            ->when($q !== '', function ($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('categories.show', compact('category', 'title', 'breadcrumbs', 'documents', 'q'));
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

    public function upload($id, Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'file'        => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,gif,webp,doc,docx,xls,xlsx,ppt,pptx,txt,rar,zip',
                'max:10240', // 10MB
            ],
        ]);

        $category = Category::findOrFail($id);
        if ($category == null || $category->status != 1) {
            abort(404);
        }

        $file = $request->file('file');

        // เก็บไฟล์ลง public/documents (ตามที่กำหนด)
        $path = $file->store('documents', 'public');

        // ใช้ extension จากชื่อไฟล์เดิม (ตามสเปคที่คุณให้มา)
        $extension = strtolower($file->getClientOriginalExtension());

        // map ประเภทไฟล์ ให้ตรงกับ logic ในคำสั่งของคุณ
        $type = match ($extension) {
            'pdf' => 'pdf',
            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'image',
            'doc', 'docx' => 'docx',
            'xls', 'xlsx' => 'xlsx',
            'ppt', 'pptx' => 'pptx',
            'txt' => 'txt',
            'rar', 'zip' => 'archive',
            default => 'other',
        };

        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $document = new Document();
        $document->title        = $request->filled('title') ? $request->title : $filename;
        $document->description  = $request->description;
        $document->category_id  = $category->id;   // จะตรงกับ $category->id
        $document->uuid = Str::uuid();
        $document->file_path    = $path;                          // public/documents/...
        $document->file_type    = $type;
        $document->file_size    = $file->getSize();
        $document->uploaded_by  = auth()->id();
        $document->save();

        // ตอบกลับให้ Dropzone
        return response()->json([
            'ok'       => true,
            'message'  => 'อัปโหลดสำเร็จ',
            'document' => [
                'id'    => $document->id,
                'title' => $document->title,
                'type'  => $document->file_type,
                'size'  => $document->file_size,
                'path'  => $document->file_path,
            ],
        ]);
    }

    public function document_delete($id)
    {
        $document = Document::findOrFail($id);
        if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
            \Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();

        return redirect()->route('categories_show', $document->category_id)->with('toast_success', 'ลบข้อมูลไฟล์เอกสารเรียบร้อยแล้ว');
    }
}
