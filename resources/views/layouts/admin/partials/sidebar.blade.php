<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('index') }}" class="brand-link">
        <img src="{{ URL::asset('assets/alshamel.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">الشامل</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::user()->name }}
                </a>
            </div>
        </div> --}}

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">

                    <a href="{{ route('index') }}" class="nav-link @if (Route::is('index')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            لوحة التحكم
                        </p>
                    </a>

                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.admins.index') }}"
                        class="nav-link @if (Route::is('admin.admins.*')) active @endif">
                        <i class="nav-icon 	fas fa-user-cog"></i>
                        <p>
                            المشرفين
                        </p>
                    </a>

                </li>

                <li class="nav-item ">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link @if (Route::is('admin.users.*')) active @endif">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            المستخدمين
                        </p>
                    </a>

                </li>

                <li class="nav-item has-treeview @if (Route::is('admin.cars.*')) menu-open @endif">
                    <a href="{{ route('admin.cars.index') }}"
                        class="nav-link @if (Route::is('admin.cars.*')) active @endif">
                        <i class="nav-icon fa-solid fa-car"></i>
                        <p>
                            سيارات
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.cars.index') }}"
                                class="nav-link @if (Route::is('admin.cars.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>منشورات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cars.type.index') }}"
                                class="nav-link @if (Route::is('admin.cars.type.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>أنواع</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cars.operation.index') }}"
                                class="nav-link @if (Route::is('admin.cars.operation.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>عمليات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cars.manufacture.index') }}"
                                class="nav-link @if (Route::is('admin.cars.manufacture.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>مصنعين</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.cars.model.index') }}"
                                class="nav-link @if (Route::is('admin.cars.model.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إصدارات</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if (Route::is('admin.property.*')) menu-open @endif">
                    <a href="{{ route('admin.property.index') }}"
                        class="nav-link @if (Route::is('admin.property.*')) active @endif">
                        <i class="nav-icon fa-sharp fa-solid fa-building"></i>
                        <p>
                            عقارات
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.property.index') }}"
                                class="nav-link @if (Route::is('admin.property.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>منشورات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.property.type.index') }}"
                                class="nav-link @if (Route::is('admin.property.type.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>أنواع العقار</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.property.operation.index') }}"
                                class="nav-link @if (Route::is('admin.property.operation.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>عمليات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.property.registration.index') }}"
                                class="nav-link @if (Route::is('admin.property.registration.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>أنواع التسجيل</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item has-treeview @if (Route::is('admin.items.*')) menu-open @endif">
                    <a href="{{ route('admin.items.index') }}"
                        class="nav-link @if (Route::is('admin.items.*')) active @endif  ">
                        <i class="nav-icon fa-solid fa-hand-holding-dollar"></i>
                        <p>
                            أغراض مستعملة
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.items.index') }}"
                                class="nav-link @if (Route::is('admin.items.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>منشورات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.items.type.index') }}"
                                class="nav-link @if (Route::is('admin.items.type.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>أنواع</p>
                            </a>
                        </li>


                    </ul>
                </li>


                <li class="nav-item has-treeview @if (Route::is('admin.notification.*')) menu-open @endif">
                    <a href="{{ route('admin.notification.all.index') }}"
                        class="nav-link @if (Route::is('admin.notification.*')) active @endif  ">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            إشعارات
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.notification.all.index') }}"
                                class="nav-link @if (Route::is('admin.notification.all.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إشعارات عامة</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.notification.single.index') }}"
                                class="nav-link @if (Route::is('admin.notification.single.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>إشعارات مخصصة</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <li class="nav-item has-treeview @if (Route::is('admin.settings.*')) menu-open @endif">
                    <a href="{{ route('admin.settings.country.index') }}"
                        class="nav-link @if (Route::is('admin.settings.*')) active @endif  ">
                        <i class="nav-icon fa-solid fa-cog"></i>
                        <p>
                            إعدادات
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.country.index') }}"
                                class="nav-link @if (Route::is('admin.settings.country.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>بلدان</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.city.index') }}"
                                class="nav-link @if (Route::is('admin.settings.city.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>مدن</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.settings.currency.index') }}"
                                class="nav-link @if (Route::is('admin.settings.currency.index')) active @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>عملات</p>
                            </a>
                        </li>


                    </ul>
                </li>


                {{-- @role(['super-admin', 'admin'])
                    <li class="nav-item ">
                        <a href="{{ route('university.index') }}"
                            class="nav-link @if (Route::is('university.*')) active @endif">
                            <i class="nav-icon fas fa-university"></i>
                            <p>
                                Universities
                            </p>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="{{ route('offices.index') }}"
                            class="nav-link @if (Route::is('offices.*') && !Route::is('offices.employees')) active @endif">
                            <i class=" nav-icon fas fa-building"></i>
                            <p>
                                Offices
                            </p>
                        </a>
                    </li>
                @endrole --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
