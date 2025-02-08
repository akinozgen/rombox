<div class="flex items-center justify-center min-h-[400px] dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-80">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Counter</h2>
            <div class="text-5xl font-bold text-indigo-600 dark:text-indigo-400">{{ $count }}</div>
        </div>

        <div class="flex justify-center gap-4 mb-4">
            <button
                wire:click="decrement"
                class="px-6 py-2 bg-red-500 dark:bg-red-600 text-white rounded-lg hover:bg-red-600 dark:hover:bg-red-700 transition-colors font-semibold text-lg"
            >
                -
            </button>

            <button
                wire:click="increment"
                class="px-6 py-2 bg-green-500 dark:bg-green-600 text-white rounded-lg hover:bg-green-600 dark:hover:bg-green-700 transition-colors font-semibold text-lg"
            >
                +
            </button>
        </div>

        @if($count === 10)
            <div class="text-green-600 dark:text-green-400 text-center text-sm bg-green-100 dark:bg-green-900/50 p-3 rounded-lg">
                Test mail gönderildi!
                <a href="http://localhost:8082" target="_blank" class="underline hover:text-green-700 dark:hover:text-green-300">
                    Mailpit'i kontrol edin
                </a>
            </div>
        @endif
    </div>
</div>
