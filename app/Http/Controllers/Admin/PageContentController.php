<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PageContent;
use App\Http\Requests\PageContentRequest;

class PageContentController extends Controller
{
    public function index()
    {
        $contents = PageContent::all();
        return view('admin.content.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.content.create');
    }

    public function store(PageContentRequest $request)
    {
        PageContent::create($request->validated());
        return redirect()->route('admin.content.index')->with('success', 'Page content created successfully.');
    }

    public function edit(PageContent $content)
    {
        return view('admin.content.edit', compact('content'));
    }

    public function update(PageContentRequest $request, PageContent $content)
    {
        $content->update($request->validated());
        return redirect()->route('admin.content.index')->with('success', 'Page content updated successfully.');
    }

    public function destroy(PageContent $content)
    {
        $content->delete();
        return redirect()->route('admin.content.index')->with('success', 'Page content deleted successfully.');
    }
}
