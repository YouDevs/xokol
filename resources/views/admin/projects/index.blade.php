<x-layouts.app>
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Proyectos</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Administra los proyectos del sitio.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}"
            class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium">Nuevo Proyecto</a>
    </div>

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

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-900/50">
                <tr>
                    <th class="text-left p-3">Proyecto</th>
                    <th class="text-left p-3">Servicios</th>
                    <th class="text-left p-3">Estado</th>
                    <th class="text-right p-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="border-t border-gray-200 dark:border-gray-700">
                        <td class="p-3">
                            <p class="font-medium">{{ $project->title }}</p>
                        </td>
                        <td class="p-3">
                            <div class="flex flex-wrap gap-1">
                                {{-- forelse services --}}
                                {{-- empty services --}}
                                {{-- end forelse services --}}
                            </div>
                        </td>
                        <td class="p-3">
                            <span
                                class="text-xs px-2 py-1 rounded  {{ $project->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300': 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }}">
                                {{ $project->is_active ? 'Activo': 'Inactivo' }}
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                    class="px-3 py-1 rounded-md border border-gray-300 dark:border-gray-700">Editar</a>
                                <form
                                    method="POST"
                                    action="#">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 rounded-md bg-red-600 hover:bg-red-700 text-white">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">No hay proyectos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>