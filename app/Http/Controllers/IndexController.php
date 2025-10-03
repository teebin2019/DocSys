<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function public()
    {
        return view('public');
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
}
