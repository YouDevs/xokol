<x-layouts.app>

    @if (Session('success'))
        <div
            id="alert-success"
            class="mb-6 p-4 rounded-lg bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 border border-green-200 dark:border-green-800 flex justify-between items-center">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="document.getElementById('alert-success').remove()" class="text-green-700 dark:text-green-400 hover:opacity-70">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    @endif

    <div class="mb-6">
        <h1>Editar servicio</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('admin.services.update', $service) }}">
            @method('PUT')
            @csrf
            @include('admin.services._form')
        </form>
    </div>
</x-layouts.app>