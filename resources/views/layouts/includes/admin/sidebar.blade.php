@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'href' => route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard'),
        ],
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
            'name' => 'Clientes',
            'icon' => 'fa-solid fa-users',
            'href' => route('admin.customers.index'),
            'active' => request()->routeIs('admin.customers*'),
        ],
        [
            'name' => 'Proveedores',
            'icon' => 'fa-solid fa-truck',
            'href' => route('admin.suppliers.index'),
            'active' => request()->routeIs('admin.suppliers*'),
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
                            <li>
                                <button type="button"
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                                    <span class="inline-flex items-center justify-center w-6 h-6 text-gray-500">
                                        <i class="{{ $link['icon'] }}"></i>
                                    </span>
                                    <span
                                        class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                                    @foreach ($link['submenu'] as $item)
                                        <li>
                                            <a href="{{ $item['href'] }}"
                                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">{{ $item['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
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
