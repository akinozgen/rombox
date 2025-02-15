<?php

namespace App\Livewire\Admin;

use App\Models\IndexPages as IndexPagesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class IndexPages extends Component
{
    use WithPagination, AuthorizesRequests;

    public $url = '';
    public $editingId = null;
    public $editingUrl = '';
    public $confirmingDelete = null;
    public $showDeleteModal = false;

    // Add rules property
    protected $rules = [
        'url' => 'required|url|unique:index_pages,url'
    ];

    public function mount()
    {
        $this->authorize('viewAny', IndexPagesModel::class);
    }

    public function save()
    {
        $this->authorize('create', IndexPagesModel::class);

        $this->validate();

        IndexPagesModel::create([
            'url' => $this->url
        ]);

        $this->reset('url');
        $this->dispatch('saved');
    }

    public function edit($id)
    {
        $page = IndexPagesModel::findOrFail($id);
        $this->authorize('update', $page);

        $this->editingId = $id;
        $this->editingUrl = $page->url;
    }

    public function update()
    {
        if (!$this->editingId) {
            return;
        }

        $page = IndexPagesModel::findOrFail($this->editingId);
        $this->authorize('update', $page);

        $this->validate([
            'editingUrl' => [
                'required',
                'url',
                Rule::unique('index_pages', 'url')->ignore($this->editingId)
            ]
        ]);

        $page->update(['url' => $this->editingUrl]);
        $this->reset(['editingId', 'editingUrl']);
        $this->dispatch('saved');
    }

    public function confirmDelete($id)
    {
        $this->authorize('delete', IndexPagesModel::findOrFail($id));
        $this->confirmingDelete = $id;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->reset(['confirmingDelete', 'showDeleteModal']);
    }

    public function delete()
    {
        if (!$this->confirmingDelete) {
            return;
        }

        $page = IndexPagesModel::findOrFail($this->confirmingDelete);
        $this->authorize('delete', $page);

        $page->delete();
        $this->reset(['confirmingDelete', 'showDeleteModal']);
        $this->dispatch('saved');
    }

    public function cancelEdit()
    {
        $this->reset(['editingId', 'editingUrl']);
    }

    public function render()
    {
        return view('livewire.admin.index-pages', [
            'pages' => IndexPagesModel::orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
