<!-- begin::navigation -->
<div class="navigation">
    <div class="navigation-header">
        <span>Navigation</span>
        <a href="#">
            <i class="ti-close"></i>
        </a>
    </div>
    <div class="navigation-menu-body">
        <ul>
            <li>
                <a href="{{ url('dashboard') }}" class="">
                    <span class="nav-link-icon"><i data-feather="home"></i></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('produk.index') }}" class="{{ Request::segment(1) == 'produk' ? 'active' : '' }}">
                    <span class="nav-link-icon"><i data-feather="database"></i></span>
                    <span>Produk</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <span class="nav-link-icon"><i data-feather="database"></i></span><span>Transaksi</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('transaksi.index') }}">Penjualan</a>
                    </li>
                    <li>
                        <a href="{{ route('riwayat_transaksi.index') }}">Riwayat Transaksi</a>
                    </li>
                    <li>
                        <a href="{{ route('voucher.index') }}">Voucher</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="{{ route('user.index') }}" class="{{ Request::segment(1) == 'user' ? 'active' : '' }}">
                    <span class="nav-link-icon"><i data-feather="users"></i></span>
                    <span>Admin</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- end::navigation -->
