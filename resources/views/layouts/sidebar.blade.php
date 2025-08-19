<style>
    .brand-image {
        transition: transform 0.4s ease-in-out;
    }

    .brand-image:hover {
        transform: scale(1.2);
    }

  </style>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        {{-- <img src="{{ asset('assets') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: 0.8" /> --}}
        <span class="brand-text font-weight-bold ml-4 ">KASIR NGANJUK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets') }}/img/LogoTtb.png" class="brand-image img-circle elevation-2"
                    alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

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

        @if (auth()->user()->id_role == 3)
            <!-- Sidebar Menu Audit-->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    {{-- Dashboard Audit --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('stokglobal.index') }}" class="nav-link {{ Route::is('stokglobal.index') ? 'active' : '' }}">
                            <i class="nav-icon 	fas fa-house-user"></i>
                            <p>
                                OPNAME GLOBAL
                            </p>
                        </a>
                    </li> --}}
                    {{-- Audit 1 --}}
                    <li class="nav-item">
                        <a href="{{ route('audit1.index') }}" class="nav-link {{ Route::is('audit1.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                AUDIT 1
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('audit2.index') }}" class="nav-link {{ Route::is('audit2.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                AUDIT 2
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('audit3.index') }}" class="nav-link {{ Route::is('audit3.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                AUDIT 3
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        <!-- /.sidebar-menu -->
        @else
            <!-- Sidebar Menu Admin-->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            DASHBOARD
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('label.index') }}" class="nav-link {{ Route::is('label.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            CETAK LABEL
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pembelian-tele.index') }}" class="nav-link {{ Route::is('pembelian-tele.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            PEMBELIAN KANTOR ALIANSYAH
                        </p>
                    </a>
                </li>
                {{-- MENU PEMBELIAN --}}
                <li
                    class="nav-item {{ Route::is('pembelian-al.index') | Route::is('pembelian-na.index') | Route::is('pembelian-na-tf.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('pembelian-al.index') | Route::is('pembelian-na.index') | Route::is('pembelian-na-tf.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>
                            PEMBELIAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('pembelian-al.index') ? 'active' : '' }}">
                            <a href="{{ route('pembelian-al.index') }}"
                                class="nav-link {{ Route::is('pembelian-al.index') ? 'active' : '' }}">

                                <p>
                                    Cash
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('pembelian-na.index') ? 'active' : '' }}">
                            <a href="{{ route('pembelian-na.index') }}"
                                class="nav-link {{ Route::is('pembelian-na.index') ? 'active' : '' }}">

                                <p>
                                    Hutang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('pembelian-na-tf.index') ? 'active' : '' }}">
                            <a href="{{ route('pembelian-na-tf.index') }}"
                                class="nav-link {{ Route::is('pembelian-na-tf.index') ? 'active' : '' }}">

                                <p>
                                    Transfer
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU PENJUALAN --}}
                <li
                    class="nav-item {{ Route::is('penjualan-cash.index') | Route::is('penjualan-piutang.index') | Route::is('penjualan-tf.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('penjualan-cash.index') | Route::is('penjualan-piutang.index') | Route::is('penjualan-tf.index') ? 'active' : '' }}">
                        <i class="nav-icon fab fa-shopify"></i>
                        <p>
                            PENJUALAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('penjualan-cash.index') ? 'active' : '' }}">
                            <a href="{{ route('penjualan-cash.index') }}"
                                class="nav-link {{ Route::is('penjualan-cash.index') ? 'active' : '' }}">

                                <p>
                                    Cash
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('penjualan-piutang.index') ? 'active' : '' }}">
                            <a href="{{ route('penjualan-piutang.index') }}"
                                class="nav-link {{ Route::is('penjualan-piutang.index') ? 'active' : '' }}">

                                <p>
                                    Piutang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('penjualan-tf.index') ? 'active' : '' }}">
                            <a href="{{ route('penjualan-tf.index') }}"
                                class="nav-link {{ Route::is('penjualan-tf.index') ? 'active' : '' }}">

                                <p>
                                    Transfer
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU RETUR PENJUALAN --}}
                <li class="nav-item {{ Route::is('retur-penjualan.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('retur-penjualan.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-undo"></i>
                        <p>
                            RETUR PENJUALAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('retur-penjualan.index') ? 'active' : '' }}">
                            <a href="{{ route('retur-penjualan.index') }}"
                                class="nav-link {{ Route::is('retur-penjualan.index') ? 'active' : '' }}">

                                <p>
                                    Retur Penjualan Via Barang
                                </p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('retur-penjualan.index-cash') ? 'active' : '' }}">
                            <a href="{{ route('retur-penjualan.index-cash') }}"
                                class="nav-link {{ Route::is('retur-penjualan.index-cash') ? 'active' : '' }}">

                                <p>
                                    Retur Penjualan Via Cash
                                </p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('retur-penjualan.index-piutang') ? 'active' : '' }}">
                            <a href="{{ route('retur-penjualan.index-piutang') }}"
                                class="nav-link {{ Route::is('retur-penjualan.index-piutang') ? 'active' : '' }}">

                                <p>
                                    Retur Penjualan Via Piutang
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU RETUR PEMBELIAN --}}
                <li
                    class="nav-item {{ Route::is('retur-pembelian-na.index') | Route::is('retur-pembelian-gudang.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('retur-pembelian-na.index') | Route::is('retur-pembelian-gudang.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-download"></i>
                        <p>
                            RETUR PEMBELIAN
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('retur-pembelian-na.index') ? 'active' : '' }}">
                            <a href="{{ route('retur-pembelian-na.index') }}"
                                class="nav-link {{ Route::is('retur-pembelian-na.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Retur Pembelian Via Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('retur-pembelian-na.index-cash') ? 'active' : '' }}">
                            <a href="{{ route('retur-pembelian-na.index-cash') }}"
                                class="nav-link {{ Route::is('retur-pembelian-na.index-cash') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Retur Pembelian Via Cash
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('retur-pembelian-na.index-hutang') ? 'active' : '' }}">
                            <a href="{{ route('retur-pembelian-na.index-hutang') }}"
                                class="nav-link {{ Route::is('retur-pembelian-na.index-hutang') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Retur Pembelian Via Hutang
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item {{ Route::is('retur-pembelian-gudang.index') ? 'active' : '' }}">
                            <a href="{{ route('retur-pembelian-gudang.index') }}"
                                class="nav-link {{ Route::is('retur-pembelian-gudang.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Gudang
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- MENU PINDAH STOCK --}}
                <li
                    class="nav-item {{ Route::is('stock-in.index') | Route::is('stock-out.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('stock-in.index') | Route::is('stock-out.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-store-alt"></i>
                        <p>
                            PINDAH STOCK
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('stock-in.index') ? 'active' : '' }}">
                            <a href="{{ route('stock-in.index') }}"
                                class="nav-link {{ Route::is('stock-in.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    In
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('stock-out.index') ? 'active' : '' }}">
                            <a href="{{ route('stock-out.index') }}"
                                class="nav-link {{ Route::is('stock-out.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- MENU BARTER --}}
                {{-- <li
                    class="nav-item {{ Route::is('barter-cash.index') | Route::is('barter-piutang.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('barter-cash.index') | Route::is('barter-piutang.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-download"></i>
                        <p>
                            BARTER
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('barter-barang.index') ? 'active' : '' }}">
                            <a href="{{ route('barter-barang.index') }}"
                                class="nav-link {{ Route::is('barter-barang.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('barter-cash.index') ? 'active' : '' }}">
                            <a href="{{ route('barter-cash.index') }}"
                                class="nav-link {{ Route::is('barter-cash.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Cash
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('barter-piutang.index') ? 'active' : '' }}">
                            <a href="{{ route('barter-piutang.index') }}"
                                class="nav-link {{ Route::is('barter-piutang.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Piutang
                                </p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- MENU PEMBAYARAN PIUTANG --}}
                <li
                    class="nav-item {{ Route::is('pembayaran-piutang-cash.index') | Route::is('pembayaran-piutang-retur.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('pembayaran-piutang-cash.index') | Route::is('pembayaran-piutang-retur.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            PEMBAYARAN PIUTANG
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('pembayaran-piutang-cash.index') ? 'active' : '' }}">
                            <a href="{{ route('pembayaran-piutang-cash.index') }}"
                                class="nav-link {{ Route::is('pembayaran-piutang-cash.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    CASH/TF/BARTER
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item {{ Route::is('pembayaran-piutang-retur.index') ? 'active' : '' }}">
                            <a href="{{ route('pembayaran-piutang-retur.index') }}"
                                class="nav-link {{ Route::is('pembayaran-piutang-retur.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    Retur
                                </p>
                            </a>
                        </li> --}}
                    </ul>
                </li>

                {{-- MENU KAS KELUAR OPERASIONAL --}}
                <li class="nav-item">
                    <a href="{{ route('kas-keluar-operasional.index') }}"
                        class="nav-link {{ Route::is('kas-keluar-operasional.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            KAS KELUAR OPERASIONAL
                        </p>
                    </a>
                </li>

                {{-- MENU PINDAH KAS --}}

                <li class="nav-item {{ Route::is('pindah-kas-tf.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('pindah-kas-tf.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-download"></i>
                        <p>
                            PINDAH KAS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('pindah-kas-tf.index') ? 'active' : '' }}">
                            <a href="{{ route('pindah-kas-tf.index') }}"
                                class="nav-link {{ Route::is('pindah-kas-tf.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    PINDAH KAS TF
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('pindah-kas-cash.index') ? 'active' : '' }}">
                            <a href="{{ route('pindah-kas-cash.index') }}"
                                class="nav-link {{ Route::is('pindah-kas-cash.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-columns"></i>
                                <p>
                                    PINDAH KAS CASH
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Modul REPORT --}}
                <li
                    class="nav-item {{ Route::is('report-penjualan-cash.index') | Route::is('report-penjualan-piutang.index') | Route::is('report-retur-pembelian-na.index') | Route::is('report-retur-penjualan.index') | Route::is('report-pembayaran-piutang.index') ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ Route::is('report-penjualan-cash.index') | Route::is('report-penjualan-piutang.index') | Route::is('report-retur-pembelian-na.index') | Route::is('report-retur-penjualan.index') | Route::is('report-pembayaran-piutang.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            REPORT
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ Route::is('report-retur-penjualan.index') ? 'active' : '' }}">
                            <a href="{{ route('report-retur-penjualan.index') }}"
                                class="nav-link {{ Route::is('report-retur-penjualan.index') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Retur Penjualan
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item {{ Route::is('report-pembayaran-piutang.index') ? 'active' : '' }}">
                            <a href="{{ route('report-pembayaran-piutang.index') }}"
                                class="nav-link {{ Route::is('report-pembayaran-piutang.index') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Pembayaran Piutang Retur
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-item {{ Route::is('report-penjualan-cash.index') ? 'active' : '' }}">
                            <a href="{{ route('report-penjualan-cash.index') }}"
                                class="nav-link {{ Route::is('report-penjualan-cash.index') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Penjualan Cash
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('report-penjualan-piutang.index') ? 'active' : '' }}">
                            <a href="{{ route('report-penjualan-piutang.index') }}"
                                class="nav-link {{ Route::is('report-penjualan-piutang.index') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Penjualan Piutang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('report-penjualan-tf.index') ? 'active' : '' }}">
                            <a href="{{ route('report-penjualan-tf.index') }}"
                                class="nav-link {{ Route::is('report-penjualan-tf.index') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Penjualan Transfer
                                </p>
                            </a>
                        </li>
                        <li class="nav-item {{ Route::is('report-retur-pembelian-na.index') ? 'active' : '' }}">
                            <a href="{{ route('report-retur-pembelian-na.index') }}"
                                class="nav-link {{ Route::is('report-retur-pembelian-na.index') ? 'active' : '' }}">
                                <i class="nav-icon far fa-user"></i>
                                <p>
                                    Retur Pembelian
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                
                {{-- Modul MANAJEMEN --}}
                @role('admin')
                    <li
                        class="nav-item {{ Route::is('user.index') | Route::is('barang.index') ? 'menu-is-opening menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Route::is('user.index') | Route::is('barang.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-folder"></i>
                            <p>
                                MANAJEMEN
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ Route::is('user.index') ? 'active' : '' }}">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        User
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('barang.index') ? 'active' : '' }}">
                                <a href="{{ route('barang.index') }}"
                                    class="nav-link {{ Route::is('barang.index') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-square"></i>
                                    <p>
                                        Barang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('konsumen.index') ? 'active' : '' }}">
                                <a href="{{ route('konsumen.index') }}"
                                    class="nav-link {{ Route::is('konsumen.index') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-square"></i>
                                    <p>
                                        Konsumen
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('persediaan.index') ? 'active' : '' }}">
                                <a href="{{ route('persediaan.index') }}"
                                    class="nav-link {{ Route::is('persediaan.index') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-square"></i>
                                    <p>
                                        Persediaan Dagang
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item {{ Route::is('piutang.index') ? 'active' : '' }}">
                                <a href="{{ route('piutang.index') }}"
                                    class="nav-link {{ Route::is('piutang.index') ? 'active' : '' }}">
                                    <i class="nav-icon far fa-square"></i>
                                    <p>
                                        Buku Piutang
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        @endif

    </div>
    <!-- /.sidebar -->
</aside>
