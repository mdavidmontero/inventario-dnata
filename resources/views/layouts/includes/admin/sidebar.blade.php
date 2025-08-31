@php
    $links = [
        [
            'header' => 'Principal',
        ],
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'name' => 'Inventarios',
            'icon' => 'fa-solid fa-boxes-stacked',
            'active' => request()->routeIs(['admin.categories.*', 'admin.products.*', 'admin.warehouses.*']),
            'submenu' => [
                [
                    'name' => 'Categorias',
                    'icon' => 'fa-solid fa-list',
                    'href' => route('admin.categories.index'),
                    'active' => request()->routeIs('admin.categories.*'),
                ],
                [
                    'name' => 'Productos',
                    'icon' => 'fa-solid fa-box',
                    'href' => route('admin.products.index'),
                    'active' => request()->routeIs('admin.products.*'),
                ],
                [
                    'name' => 'Almacenes',
                    'icon' => 'fa-solid fa-warehouse',
                    'href' => route('admin.warehouses.index'),
                    'active' => request()->routeIs('admin.warehouses*'),
                ],
            ],
        ],
        [
            'name' => 'Compras',
            'icon' => 'fa-solid fa-shopping-cart',
            'active' => request()->routeIs(['admin.suppliers.*', 'admin.purchase-orders.*', 'admin.purchases.*']),
            'submenu' => [
                [
                    'name' => 'Proveedores',
                    'href' => route('admin.suppliers.index'),
                    'active' => request()->routeIs('admin.suppliers*'),
                ],
                [
                    'name' => 'Ordenes de Compra',
                    'href' => route('admin.purchase-orders.index'),
                    'active' => request()->routeIs('admin.purchase-orders*'),
                ],
                [
                    'name' => 'Compras',
                    'href' => route('admin.purchases.index'),
                    'active' => request()->routeIs('admin.purchases*'),
                ],
            ],
        ],
        [
            'name' => 'Ventas',
            'icon' => 'fa-solid fa-store',
            'active' => request()->routeIs(['admin.customers.*', 'admin.quotes.*', 'admin.sales.*']),
            'submenu' => [
                [
                    'name' => 'Clientes',
                    'href' => route('admin.customers.index'),
                    'active' => request()->routeIs('admin.customers*'),
                ],
                [
                    'name' => 'Cotizaciones',
                    'href' => route('admin.quotes.index'),
                    'active' => request()->routeIs('admin.quotes*'),
                ],
                [
                    'name' => 'Ventas',
                    'href' => route('admin.sales.index'),
                    'active' => request()->routeIs('admin.sales*'),
                ],
            ],
        ],
        [
            'name' => 'Movimientos',
            'icon' => 'fa-solid fa-truck-moving',
            'active' => request()->routeIs(['admin.movements*']),
            'submenu' => [
                [
                    'name' => 'Entradas y Salidas',
                    'href' => route('admin.movements.index'),
                    'active' => request()->routeIs('admin.movements*'),
                ],
                [
                    'name' => 'Transferencias',
                    'href' => '',
                    'active' => false,
                ],
            ],
        ],
        [
            'name' => 'Reportes',
            'icon' => 'fa-solid fa-file',
            'href' => '',
            'active' => false,
        ],
        [
            'header' => 'Configuración',
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-user',
            'href' => '',
            'active' => false,
        ],
        [
            'name' => 'Roles',
            'icon' => 'fa-solid fa-user-group',
            'href' => '',
            'active' => false,
        ],
        [
            'name' => 'Permisos',
            'icon' => 'fa-solid fa-lock',
            'href' => '',
            'active' => false,
        ],
        [
            'name' => 'Ajustes',
            'icon' => 'fa-solid fa-gear',
            'href' => '',
            'active' => false,
        ],
    ];
@endphp
<div>
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 "
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white ">
            <ul class="space-y-2 font-medium">
                @foreach ($links as $link)
                    <li>
                        @isset($link['header'])
                            <div class="px-2 py-2 text-xs font-semibold text-gray-500 uppercase">
                                {{ $link['header'] }}
                            </div>
                        @else
                            @isset($link['submenu'])
                                <div x-data="{
                                    open: {{ $link['active'] ? 'true' : 'false' }}
                                }">
                                    <button type="button" @click="open = !open"
                                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 ">
                                        <span class="inline-flex items-center justify-center w-6 h-6 text-gray-500">
                                            <i class="{{ $link['icon'] }}"></i>
                                        </span>
                                        <span
                                            class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                                        {{-- <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 4 4 4-4" />
                                        </svg> --}}
                                        <i class="text-sm"
                                            :class="{
                                                'fa-solid fa-chevron-up': open,
                                                'fa-solid fa-chevron-down': !open
                                            }"></i>
                                    </button>
                                    <ul x-show="open" x-cloak class="py-2 space-y-2">
                                        @foreach ($link['submenu'] as $item)
                                            <li>
                                                <a href="{{ $item['href'] }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 {{ $item['active'] ? 'bg-gray-100' : '' }}">{{ $item['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <a href="{{ $link['href'] }}"
                                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group {{ $link['active'] ? 'bg-gray-100' : '' }}">
                                    <span class="inline-flex items-center justify-center w-6 h-6 text-gray-500">
                                        <i class="{{ $link['icon'] }}"></i>
                                    </span>
                                    <span class="ms-3">{{ $link['name'] }}</span>
                                </a>
                            @endisset
                        @endisset

                    </li>
                @endforeach

            </ul>
        </div>
    </aside>
</div>
