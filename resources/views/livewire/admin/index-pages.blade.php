<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div x-data="{ message: '' }" 
                     x-on:saved.window="message = 'Operation completed successfully'; setTimeout(() => message = '', 2000)">
                    <div x-show="message" x-transition 
                         class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded">
                        <span x-text="message"></span>
                    </div>
                </div>

                <!-- Add new index page -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Add New Index Page</h2>
                    <form wire:submit.prevent="save" class="flex gap-4">
                        <input type="text" 
                               wire:model="url" 
                               placeholder="Enter URL" 
                               class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        <x-primary-button type="submit">
                            Add
                        </x-primary-button>
                    </form>
                    @error('url') 
                        <span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- List of index pages -->
                <div>
                    <h2 class="text-lg font-semibold mb-4">Index Pages</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">URL</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Last Checked</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($pages as $page)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($editingId === $page->id)
                                                <div class="flex items-center space-x-2">
                                                    <input type="text" 
                                                           wire:model.live="editingUrl" 
                                                           class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                                    <div class="flex space-x-2">
                                                        <x-secondary-button wire:click.prevent="update">
                                                            Save
                                                        </x-secondary-button>
                                                        <x-secondary-button wire:click.prevent="cancelEdit">
                                                            Cancel
                                                        </x-secondary-button>
                                                    </div>
                                                </div>
                                                @error('editingUrl') 
                                                    <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> 
                                                @enderror
                                            @else
                                                <span class="text-gray-900 dark:text-gray-100">{{ $page->url }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $page->last_checked_at ? $page->last_checked_at->diffForHumans() : 'Never' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($page->status_code === 200)
                                                <span class="px-2 py-1 text-xs bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-full">OK</span>
                                            @elseif($page->status_code)
                                                <span class="px-2 py-1 text-xs bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 rounded-full">Error {{ $page->status_code }}</span>
                                            @else
                                                <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-full">Not checked</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($editingId === $page->id)
                                                <x-secondary-button wire:click="update" class="mr-2">
                                                    Save
                                                </x-secondary-button>
                                                <x-secondary-button wire:click="cancelEdit">
                                                    Cancel
                                                </x-secondary-button>
                                            @else
                                                <x-secondary-button wire:click="edit({{ $page->id }})" class="mr-2">
                                                    Edit
                                                </x-secondary-button>
                                                <x-danger-button wire:click="confirmDelete({{ $page->id }})">
                                                    Delete
                                                </x-danger-button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $pages->links() }}
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                @if($showDeleteModal)
                    <div class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 flex items-center justify-center">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg max-w-md w-full">
                            <h3 class="text-lg font-medium mb-4 text-gray-900 dark:text-gray-100">Confirm Delete</h3>
                            <p class="mb-4 text-gray-600 dark:text-gray-400">Are you sure you want to delete this index page?</p>
                            <div class="flex justify-end gap-4">
                                <x-secondary-button wire:click="cancelDelete">
                                    Cancel
                                </x-secondary-button>
                                <x-danger-button wire:click="delete">
                                    Delete
                                </x-danger-button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div> 