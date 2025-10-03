<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function public(Request $request)
    {
        $q = $request->query('q', '');
        $category = $request->query('category', '');
        $type = $request->query('type', '');

        $documents = Document::with('category')->where('status', 1)
            ->when($q, function ($query, $q) {
                return $query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%')
                    ->orWhere('tag', 'like', '%' . $q . '%')
                    ->orWhere('uuid', $q);
            })->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })->when($type, function ($query, $type) {
                return $query->where('file_type', $type);
            })->orderBy('created_at', 'desc')
            ->paginate(20);

        ###### Search ########
        $categories = Category::where('status', 1)->orderBy('created_at', 'asc')->get();
        $file_types = ['pdf', 'image', 'docx', 'xlsx', 'pptx', 'txt', 'archive', 'other'];

        return view('public', compact('documents', 'q', 'category', 'type', 'categories', 'file_types'));
    }

    public function index()
    {
        $title = 'หน้าหลัก';
        $breadcrumbs = [
            ['link' => '', 'name' => $title],
        ];

        $categories = Category::where('status', 1)->orderBy('created_at', 'asc')->paginate(12);

        return view('index', compact('title', 'breadcrumbs', 'categories'));
    }

    public function download_count($uuid)
    {
        $document = Document::where('uuid', $uuid)->where('status', 1)->first();
        if (!$document) {
            return abort(404);
        }

        $document->download_count += 1;
        $document->timestamps = false;
        $document->update();

        return redirect()->to(asset('storage/' . $document->file_path));
    }
}
