<div class="menu-item">
    <a class="menu-link {{ request()->is('home') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <span class="menu-icon">
            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
            <span class="svg-icon svg-icon-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black">
                    </rect>
                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black">
                    </rect>
                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black">
                    </rect>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </span>
        <span class="menu-title">Home</span>
    </a>
</div>
@canany(['create-user', 'edit-user', 'delete-user', 'create-role', 'edit-role', 'delete-role'])
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion mb-1  {{ request()->is('users*') || request()->is('roles*') ? 'show' : '' }} ">
        <span class="menu-link">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path opacity="0.3"
                            d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                            fill="black" />
                        <path
                            d="M14.854 11.321C14.7568 11.2282 14.6388 11.1818 14.4998 11.1818H14.3333V10.2272C14.3333 9.61741 14.1041 9.09378 13.6458 8.65628C13.1875 8.21876 12.639 8 12 8C11.361 8 10.8124 8.21876 10.3541 8.65626C9.89574 9.09378 9.66663 9.61739 9.66663 10.2272V11.1818H9.49999C9.36115 11.1818 9.24306 11.2282 9.14583 11.321C9.0486 11.4138 9 11.5265 9 11.6591V14.5227C9 14.6553 9.04862 14.768 9.14583 14.8609C9.24306 14.9536 9.36115 15 9.49999 15H14.5C14.6389 15 14.7569 14.9536 14.8542 14.8609C14.9513 14.768 15 14.6553 15 14.5227V11.6591C15.0001 11.5265 14.9513 11.4138 14.854 11.321ZM13.3333 11.1818H10.6666V10.2272C10.6666 9.87594 10.7969 9.57597 11.0573 9.32743C11.3177 9.07886 11.6319 8.9546 12 8.9546C12.3681 8.9546 12.6823 9.07884 12.9427 9.32743C13.2031 9.57595 13.3333 9.87594 13.3333 10.2272V11.1818Z"
                            fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">User Management</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion">
            @canany(['create-user', 'edit-user', 'delete-user'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
            @endcanany
            @canany(['create-role', 'edit-role', 'delete-role'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('roles*') ? 'active' : '' }} " href="{{ route('roles.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Roles</span>
                    </a>
                </div>
            @endcanany
        </div>
    </div>
@endcanany

@canany(['create-category-product', 'edit-category-product', 'delete-category-product', 'create-product',
    'edit-product', 'delete-product', 'import-product', 'export-product', 'create-unitproduct', 'edit-unitproduct',
    'delete-unitproduct', 'create-warehouse', 'edit-warehouse', 'delete-warehouse', 'create-location', 'edit-location',
    'delete-location'])
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion mb-1  {{ request()->is('productpos*') ||
        request()->is('categoryproduct*') ||
        request()->is('tools-productpos*') ||
        request()->is('unitproduct*') ||
        request()->is('warehouse*') ||
        request()->is('location*')
            ? 'show'
            : '' }} ">
        <span class="menu-link">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen051.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Inventory Management</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion">
            @canany(['create-category-product', 'edit-category-product', 'delete-category-product'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('categoryproduct*') ? 'active' : '' }}"
                        href="{{ route('categoryproduct.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Category</span>
                    </a>
                </div>
            @endcanany
            @canany(['create-unit-product', 'edit-unit-product', 'delete-unit-product', 'export-product', 'import-product'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('unitproduct*') ? 'active' : '' }}"
                        href="{{ route('unitproduct.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Unit</span>
                    </a>
                </div>
            @endcanany
            @canany(['create-product', 'edit-product', 'delete-product'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('productpos*') || request()->is('tools-productpos*') ? 'active' : '' }} "
                        href="{{ route('productpos.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Product</span>
                    </a>
                </div>
            @endcanany

            @canany(['create-warehouse', 'edit-warehouse', 'delete-warehouse'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('warehouse*') ? 'active' : '' }} "
                        href="{{ route('warehouse.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Warehouse</span>
                    </a>
                </div>
            @endcanany

            @canany(['create-location', 'edit-location', 'delete-location'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('location*') ? 'active' : '' }} "
                        href="{{ route('location.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Location</span>
                    </a>
                </div>
            @endcanany

            @canany(['create-stock', 'edit-stock', 'delete-stock'])
                <div class="menu-item">
                    <a class="menu-link {{ request()->is('stock*') ? 'active' : '' }} " href="{{ route('stock.index') }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Stock Unit </span>
                    </a>
                </div>
            @endcanany

        </div>
    </div>
@endcanany
@canany(['create-purchase', 'edit-purchase', 'delete-purchase'])
    <div class="menu-item">
        <a class="menu-link {{ request()->is('purchase*') ? 'active' : '' }}" href="{{ route('purchase.index') }}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Purchase Management</span>
        </a>
    </div>
@endcan

@canany(['create-sales', 'edit-sales', 'delete-sales'])
    <div class="menu-item">
        <a class="menu-link {{ request()->is('sales*') ? 'active' : '' }}" href="{{ route('sales.index') }}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Sales Management</span>
        </a>
    </div>
@endcan

@canany(['create-income', 'edit-income', 'delete-income'])
    <div class="menu-item">
        <a class="menu-link {{ request()->is('income*') ? 'active' : '' }}" href="{{ route('income.index') }}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Income Management</span>
        </a>
    </div>
@endcan

@canany(['create-expense', 'edit-expense', 'delete-expense'])
    <div class="menu-item">
        <a class="menu-link {{ request()->is('expense*') ? 'active' : '' }}" href="{{ route('expense.index') }}">
            <span class="menu-icon">
                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black">
                        </rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
            </span>
            <span class="menu-title">Expense Management</span>
        </a>
    </div>
@endcan
