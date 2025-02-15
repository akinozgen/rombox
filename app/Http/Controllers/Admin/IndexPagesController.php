<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndexPages;
use Illuminate\Http\Request;

class IndexPagesController extends Controller
{
    public function index()
    {
        $pages = IndexPages::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.index-pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.index-pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|url|unique:index_pages,url'
        ]);

        IndexPages::create($validated);

        return redirect()
            ->route('admin.index-pages.index')
            ->with('success', 'Index page added successfully.');
    }

    public function edit(IndexPages $indexPage)
    {
        return view('admin.index-pages.edit', compact('indexPage'));
    }

    public function update(Request $request, IndexPages $indexPage)
    {
        $validated = $request->validate([
            'url' => 'required|url|unique:index_pages,url,' . $indexPage->id
        ]);

        $indexPage->update($validated);

        return redirect()
            ->route('admin.index-pages.index')
            ->with('success', 'Index page updated successfully.');
    }

    public function destroy(IndexPages $indexPage)
    {
        $indexPage->delete();

        return redirect()
            ->route('admin.index-pages.index')
            ->with('success', 'Index page deleted successfully.');
    }
}
