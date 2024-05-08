<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <a href="{{ url('/') }}">
                <img src="{{asset('public/assets/img/logo.png')}}" class="img-fluid logo" alt="logo">
            </a>
            <a href="{{ url('/') }}">
                <img src="{{asset('public/assets/img/logo-small.png')}}" class="img-fluid logo-small" alt="small_logo">
            </a>
        </div>
    </div>
    <div class="sidebar-inner slimscroll">
        @if (Auth::user()->u_type!=1)
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li><a href="{{ url('/') }}"> <i class="fe fe-pocket"></i><span>Dashboard</span></a></li>
            </ul>
            @if (Auth::user()->u_type==2)
            <ul>
                <li><a href="{{ url('/companyprofile') }}"> <i class="fe fe-briefcase"></i><span>Company Profile </span></a></li>
            </ul>
            <ul>
                <li><a href="{{ url('/charterd') }}"> <i class="fe fe-user-check"></i><span>Assign CA Firm</span></a></li>
            </ul>
            <ul>
                <li>
                    <a href="{{ url('/customers') }}"><i class="fe fe-users"></i> <span>Customers</span></a>
                </li>
            </ul>
            @endif
            @if (Auth::user()->u_type==3)

            <ul>
                <li><a href="{{ url('/ca-requested') }}"><i class="fa-solid fa fa-user-circle"></i><span>Requested CA</span></a></li>
            </ul>
            <ul>
                <li><a href="{{ url('/our-ca') }}"><i class="fa-solid fa fa-user-circle"></i><span>Our CA</span></a></li>
            </ul>
            <ul>
                <li><a href="{{ url('/designation') }}"><i class="fa-solid fa fa-user-circle"></i><span>Employee Management</span></a></li>
            </ul>
            @endif

            <ul>
                <li>
                    <a href="{{ url('/items') }}"><i class="fe fe-package"></i> <span>Product / Service</span></a>
                </li>
            </ul>

            <ul>
                <li class="submenu">
                    <a href="#"><i class="fe fe-shopping-cart"></i> <span> Sales</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/sales-invoice') }}"><i class="fe fe-file-plus"></i> <span>Sales Invoice</span></a></li>
                        <li><a href="{{ url('/sales-credit-debit') }}"><i class="fe fe-file-text"></i> <span>Credit-Debit Notes</span></a></li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-shopping-bag"></i> <span>Purchases</span><span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/purchase-invoice') }}"><i class="fe fe-file-plus"></i> <span>Purchase Invoices</span></a></li>
                       
                        <li><a href="{{ url('/purchase-credit-debit') }}"><i class="fe fe-file-text"></i> <span>Credit-Debit Notes</span></a></li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-server"></i> <span>Assets</span><span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/assets') }}"><i class="fe fe-grid"></i> <span>Assets Details</span></a></li>
                        <li><a href="{{ url('/asset-voucher') }}"><i class="fe fe-feather"></i> <span>Assets Voucher</span></a></li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ url('/payment') }}"><i class="fe fe-arrow-down-right"></i> <span>Payments</span></a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ url('/expenses') }}"><i class="fe fe-arrow-up-right"></i> <span>Expenses</span></a>
                </li>
            </ul>
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-home"></i> <span>Cash & Bank</span><span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('/banks') }}"><i class="fe fe-clipboard"></i> <span>Bank Accounts</span></a></li>
                        <li><a href="{{ url('/loans') }}"><i class="fe fe-clipboard"></i> <span>Loan Accounts</span></a></li>
                        <li><a href="{{ url('/cash') }}"><i class="fe fe-clipboard"></i> <span>Cash Management</span></a></li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ url('/vendors') }}"><i class="fe fe-users"></i><span>Vendors</span></a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ url('/projects') }}"><i class="fe fe-database"></i> <span>Projects</span></a>
                </li>
            </ul>

            <ul>
                <li>
                    <a href="{{ url('/statutory') }}"><i class="fe fe-check-square"></i> <span>Statutory Filling</span></a>
                </li>
            </ul>

            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-printer"></i> <span>Reports</span><span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Profit & Loss</span></a></li>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Cash Flow Statement</span></a></li>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Balance Sheet</span></a></li>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>GST Report</span></a></li>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Day Book</span></a></li>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Bill wise Profit</span></a></li>
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Outstanding Report</span></a></li>
                    </ul>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="#"><i class="fe fe-settings"></i><span>Settings</span></a>
                </li>
            </ul>

        </div>
        @endif
        @if (Auth::user()->u_type==1)<!-- this will only visibale when CA login  -->
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li><a href="cahome"> <i class="fe fe-pocket"></i><span>CA Dashboard</span></a></li>
                </ul>
                <ul>
                    <li><a href="caprofile"> <i class="fe fe-pocket"></i><span>Profile</span></a></li>
                </ul>
                <ul>
                    <li><a href="client"> <i class="fe fe-pocket"></i><span>Client</span></a></li>
                </ul>
            </div>
        @endif
    </div>
</div>
