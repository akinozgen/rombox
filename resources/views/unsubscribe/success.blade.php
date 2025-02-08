<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unsubscribe - {{ config('app.name') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-center">
                        <h2 class="text-2xl font-bold mb-4">Successfully Unsubscribed</h2>
                        <p class="mb-4">You have been successfully unsubscribed from marketing emails.</p>
                        <a href="/" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            Return to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
