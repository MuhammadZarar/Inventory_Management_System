<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ session()->get('name') }}</span>
                    <span class="text-secondary text-small">Software Engineer</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#category-pages" aria-expanded="false"
                aria-controls="category-pages">
                <span class="menu-title">Category</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="category-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('add_category') }}">
                            Add Category </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('list_category') }}"> Manage Category </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#product-pages" aria-expanded="false"
                aria-controls="general-pages">
                <span class="menu-title">Product</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="product-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('add_product') }}">
                            Add Product </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('list_product') }}"> Manage Product </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#invoice-pages" aria-expanded="false"
                aria-controls="invoice-pages">
                <span class="menu-title">Invoice</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="invoice-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('add_invoice') }}">
                            Add Invoice </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('list_invoice') }}"> Manage Invoice </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#sales-report" aria-expanded="false"
                aria-controls="sales-report">
                <span class="menu-title">Sales Report</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
            <div class="collapse" id="sales-report">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('report_daily') }}">
                            Daily Sales Report </a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('list_invoice') }}"> Manage Invoice </a> --}}
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
