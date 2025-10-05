<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q', '');
        $slides = Slide::where('status', 1)
            ->when($q, function ($query, $q) {
                return $query->where('title', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%');
            })
            ->orderBy('order_by', 'asc')
            ->orderByDesc('created_at')
            ->paginate(20);

        $title = 'ภาพสไลด์';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => '', 'name' => $title],
        ];

        return view('slides.index', compact('slides', 'title', 'breadcrumbs', 'q'));
    }

    public function create()
    {
        $title = 'เพิ่มภาพสไลด์';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('slides'), 'name' => 'ภาพสไลด์'],
            ['link' => '', 'name' => $title],
        ];

        return view('slides.create', compact('title', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ]);

        $image = $request->file('image');
        $path = $image->store('slides', 'public');

        $slide = new Slide();
        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->url = $request->url;
        $slide->file_path = $path;
        $slide->save();

        return redirect()->route('slides')->with('toast_success', 'เพิ่มภาพสไลด์เรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        if ($slide == null) {
            abort(404);
        }

        $title = 'แก้ไขภาพสไลด์';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('slides'), 'name' => 'ภาพสไลด์'],
            ['link' => '', 'name' => $title],
        ];

        return view('slides.edit', compact('slide', 'title', 'breadcrumbs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $slide = Slide::findOrFail($id);
        if ($slide == null) {
            abort(404);
        }

        $image = $request->file('image');
        if ($image) {
            Storage::disk('public')->delete($slide->file_path);
            $path = $image->store('slides', 'public');
            $slide->file_path = $path;
        }

        $slide->title = $request->title;
        $slide->description = $request->description;
        $slide->url = $request->url;
        $slide->update();

        return redirect()->route('slides')->with('toast_success', 'แก้ไขภาพสไลด์เรียบร้อยแล้ว');
    }

    public function order()
    {
        $title = 'เรียงลําดับภาพสไลด์';
        $breadcrumbs = [
            ['link' => route('index'), 'name' => 'หน้าหลัก'],
            ['link' => route('slides'), 'name' => 'ภาพสไลด์'],
            ['link' => '', 'name' => $title],
        ];

        $slides = Slide::where('status', 1)
            ->orderBy('order_by', 'asc')
            ->orderByDesc('created_at')
            ->get();

        return view('slides.order', compact('slides', 'title', 'breadcrumbs'));
    }

    public function order_update(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
        ]);

        $order = $request->order;
        foreach ($order as $key => $value) {
            $slide = Slide::find($value);
            if ($slide != null) {
                $slide->order_by = $key + 1;
                $slide->update();
            }
        }

        return redirect()->route('slides')->with('toast_success', 'เรียงลําดับภาพสไลด์เรียบร้อยแล้ว');
    }

    public function delete($id)
    {
        $slide = Slide::findOrFail($id);
        if ($slide == null) {
            abort(404);
        }

        $slide->status = 0;
        $slide->update();

        return redirect()->route('slides')->with('toast_success', 'ลบภาพสไลด์เรียบร้อยแล้ว');
    }
}
