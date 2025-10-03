<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            ->paginate(20);

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,gif,webp,doc,docx,xls,xlsx,ppt,pptx,txt,rar,zip',
                'max:10240', // 10MB
            ]
        ]);

        $file = $request->file('file');
        $path = $file->store('documents', 'public');
        $extension = strtolower($file->getClientOriginalExtension());
        $type = match ($extension) {
            'pdf' => 'pdf',
            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'image',
            'doc', 'docx' => 'docx',
            'xls', 'xlsx' => 'xlsx',
            'ppt', 'pptx' => 'pptx',
            'txt' => 'txt',
            'rar', 'zip' => 'archive',
            default => 'other'
        };

        $document = new Document();
        $document->title = $request->title ?? $file->getClientOriginalName();
        $document->description = $request->description;
        $document->category_id = $request->category_id;
        $document->uuid = Str::uuid();
        $document->file_path = $path;
        $document->file_type = $type;
        $document->file_size = $file->getSize();
        $document->uploaded_by = auth()->id();
        $document->save();

        return redirect()->route('documents')->with('success', 'เพิ่มข้อมูลไฟล์เอกสารเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        if (!$document) {
            return abort(404);
        }

        $title = 'แก้ไขข้อมูลไฟล์เอกสาร';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('documents'), 'name' => 'ข้อมูลไฟล์เอกสาร'],
            ['link' => '', 'name' => $title],
        ];

        $categories = Category::where('status', 1)->orderBy('created_at', 'asc')->get();

        return view('documents.edit', compact('document', 'title', 'breadcrumbs', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $document = Document::findOrFail($id);
        if (!$document) {
            return abort(404);
        }

        $file = $request->file('file');
        if ($file) {
            Storage::disk('public')->delete($document->file_path);

            $path = $file->store('documents', 'public');
            $extension = strtolower($file->getClientOriginalExtension());
            $type = match ($extension) {
                'pdf' => 'pdf',
                'jpg', 'jpeg', 'png', 'gif', 'webp' => 'image',
                'doc', 'docx' => 'docx',
                'xls', 'xlsx' => 'xlsx',
                'ppt', 'pptx' => 'pptx',
                'txt' => 'txt',
                'rar', 'zip' => 'archive',
                default => 'other'
            };
            $document->file_path = $path;
            $document->file_type = $type;
            $document->file_size = $file->getSize();
        }

        $document->title = $request->title ?? $file->getClientOriginalName();
        $document->description = $request->description;
        $document->category_id = $request->category_id;
        $document->update();

        return redirect()->route('categories_show', $document->category_id)->with('toast_success', 'แก้ไขข้อมูลไฟล์เอกสารเรียบร้อยแล้ว');
    }

    public function delete($id)
    {
        $document = Document::findOrFail($id);
        if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
            \Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();

        return redirect()->route('documents')->with('success', 'ลบข้อมูลไฟล์เอกสารเรียบร้อยแล้ว');
    }
}
