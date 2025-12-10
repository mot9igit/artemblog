<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route("admin.index") }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="admin/assets/img/logo.svg"
                alt="Machinestore Logo"
                class="brand-image"
            />
            <!--end::Brand Image-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>
                            Система
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-gear"></i>
                                <p>
                                    Настройки
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.system.geo') }}" class="nav-link">
                                <i class="nav-icon bi bi-geo-alt"></i>
                                <p>
                                    География
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            Права и Доступ
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-person"></i>
                                <p>
                                    Пользователи
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-people"></i>
                                <p>
                                    Группы
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>
                                    Роли
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-database-gear"></i>
                        <p>
                            Интеграции
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-building"></i>
                                <p>
                                    Организации <span class="nav-badge badge text-bg-secondary me-3">0</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-box"></i>
                                <p>
                                    Склады <span class="nav-badge badge text-bg-secondary me-3">0</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-link"></i>
                                <p>
                                    Bitrix 24 <span class="nav-badge badge text-bg-secondary me-3">0</span>
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-currency-dollar"></i>
                        <p>
                            E-commerce
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-cash"></i>
                                <p>
                                    Заказы
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.category.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-folder"></i>
                                <p>
                                    Категории
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>
                                    Товары
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-card-checklist"></i>
                                <p>
                                    Характеристики
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
