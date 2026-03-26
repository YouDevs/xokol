@php
    $isEdit = isset($service);
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label for="name" class="block text-sm font-medium mb-1">Nombre</label>
        <input id="name" name="name" type="text" value="{{ old('name', $service->name ?? '') }}"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
        <!-- show error -->
            <p class="text-red-500 text-xs mt-1">
                <!-- message -->
            </p>
    </div>

    <div class="md:col-span-2">
        <label for="description" class="block text-sm font-medium mb-1">Descripción</label>
        <textarea id="description" name="description" rows="4"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900">{{ old('description', $service->description ?? '') }}</textarea>
        <!-- show error -->
            <p class="text-red-500 text-xs mt-1">
                <!-- message -->
            </p>
    </div>

    <div>
        <label for="icon" class="block text-sm font-medium mb-1">Ícono (Material Symbol)</label>
        <input id="icon" name="icon" type="text" value="{{ old('icon', $service->icon ?? '') }}"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2"
            placeholder="fingerprint">
       <!-- show error -->
            <p class="text-red-500 text-xs mt-1">
                <!-- message -->
            </p>
    </div>

    <div>
        <label for="sort_order" class="block text-sm font-medium mb-1">Orden</label>
        <input id="sort_order" name="sort_order" type="number" min="0"
            value="{{ old('sort_order', $service->sort_order ?? 0) }}"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
        <!-- show error -->
            <p class="text-red-500 text-xs mt-1">
                <!-- message -->
            </p>
    </div>

    <div>
        <label for="is_active" class="block text-sm font-medium mb-1">Estado</label>
        <select id="is_active" name="is_active"
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 p-2" required>
            <option value="1" @selected( old('is_active', (int) ($service->is_active ?? 1)) == 1 ) >Activo</option>
            <option value="0" @selected( old('is_active', (int) ($service->is_active ?? 1)) == 0 ) >Inactivo</option>
        </select>
        <!-- show error -->
            <p class="text-red-500 text-xs mt-1">
                <!-- message -->
            </p>
    </div>
</div>

<div class="mt-6 flex gap-3">
    <button type="submit"
        class="px-4 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-white font-medium">
            {{ $isEdit ? 'Actualizar': 'Crear' }}
        </button>
    <a href="#"
        class="px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700">Cancelar</a>
</div>