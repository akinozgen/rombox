<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Index Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.index-pages.update', $indexPage) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="url" value="URL" />
                            <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" value="{{ old('url', $indexPage->url) }}" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>

                        <div class="mt-4 flex justify-end space-x-2">
                            <x-secondary-button onclick="window.location='{{ route('admin.index-pages.index') }}'">Cancel</x-secondary-button>
                            <x-primary-button>Update</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 