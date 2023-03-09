<aside :class="{ 'block': showsidebar, 'hidden': !showsidebar }"
    class="fixed z-20 h-full top-0 left-0 pt-10 flex lg:flex flex-shrink-0 flex-col w-64 bg-white"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-90"
    x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
    <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 bg-white divide-y space-y-1">
                <ul class="space-y-1 py-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
                    <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">Clientes</x-nav-link>
                    <x-nav-link :href="route('suppliers.index')" :active="request()->routeIs('suppliers.*')">Fornecedores</x-nav-link>
                    <x-nav-link :href="route('employees.index')" :active="request()->routeIs('employees.*')">Funcionários</x-nav-link>
                    <x-nav-link :href="route('partners.index')" :active="request()->routeIs('partners.*')">Prestadores de serviços</x-nav-link>
                </ul>
                <ul class="space-y-1 py-1">
                    <x-nav-link :href="route('proposals.index')" :active="request()->routeIs('proposals.*')">Orçamentos</x-nav-link>
                    <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.*')">Obras</x-nav-link>
                    <x-nav-link :href="route('purchases.index')" :active="request()->routeIs('purchases.*')">Compras</x-nav-link>
                </ul>
                <ul class="space-y-1 py-1">
                    <x-nav-link :href="route('tributes.index')" :active="request()->routeIs('tributes.*')">Tributos</x-nav-link>
                    <x-nav-link :href="route('installments.index')" :active="request()->routeIs('installments.*')">Parcelas pendentes</x-nav-link>
                    <x-nav-link :href="route('proposals.index')" :active="request()->routeIs('proposals.*')">Extrato financeiro</x-nav-link>
                </ul>
            </div>
        </div>
    </div>
</aside>
<div @click="showsidebar = false" x-show="showsidebar" class="bg-gray-900 lg:hidden opacity-50 fixed inset-0 z-10"></div>
