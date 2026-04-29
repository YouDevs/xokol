@props(['services'])

<div class="bg-card-dark p-8 md:p-12 rounded-3xl border border-border-dark">
    <form method="POST" action="{{ route('contact') }}" class="space-y-8">
        @csrf
        <div class="">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Correo</label>
            <input
                class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                placeholder="example@email.com" type="email" name="email" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Nombre Completo</label>
                <input
                    class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                    placeholder="John Doe" type="text" name="name" />
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Teléfono</label>
                <input
                    class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                    placeholder="+1 (555) 000-0000" type="tel" name="phone" />
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Compañía / Empresa</label>
            <input
                class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                placeholder="Awesome Inc." type="text" name="company" />
        </div>

        <div class="space-y-4">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Servicios Requeridos</label>
            <div class="flex flex-wrap gap-2">
                @foreach ($services as $service)
                    <label class="cursor-pointer">
                        <input class="hidden peer" type="checkbox" name="services[]" value="{{ $service->name }}" />
                        <span
                            class="px-4 py-2 rounded-lg border border-slate-700 text-sm peer-checked:bg-primary peer-checked:text-background-dark peer-checked:border-primary transition-all inline-block">
                            {{$service->name}}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>

        <button class="w-full bg-primary text-background-dark py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-all">
            Enviar Propuesta
        </button>
    </form>
</div>