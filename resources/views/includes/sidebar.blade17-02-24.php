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
        @if (Auth::user()->u_type!=1 && Auth::user()->u_type!=4 )
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
				<?php 
					$permission = isset(Auth::user()->emp_permission)?Auth::user()->emp_permission:"";
					$permission = explode(',', $permission);
				?>
				@if (in_array('CA_Management', $permission))   
                <ul>
                    <li><a href="{{ url('/caportal') }}"><i class="fe fe-user-check"></i><span>CA Management</span></a></li>
                </ul>
				@endif
				@if (in_array('Customer_Management', $permission))  
                <ul>
                    <li><a href="{{ url('/customerportal') }}"><i class="fe fe-user"></i><span>Customer Management</span></a></li>
                </ul>
				@endif
				@if (in_array('Requested_CA', $permission))  
				<ul>
					<li><a href="{{ url('/ca-requested') }}"><i class="fa-solid fa fa-user-circle"></i><span>Requested CA</span></a></li>
				</ul>
				@endif
				@if (in_array('Our_CA', $permission))  
				<ul>
					<li><a href="{{ url('/our-ca') }}"><i class="fa-solid fa fa-user-circle"></i><span>Our CA</span></a></li>
				</ul>
				@endif
				@if (in_array('Employee_Management', $permission))  
				<ul>
					<li><a href="{{ url('/admin-employee') }}"><i class="fe fe-users"></i><span>Employee Management</span></a></li>
				</ul>
				@endif
				@if (in_array('Subscribers', $permission) || in_array('Plan', $permission)) 
				<ul>
					<li class="submenu">
						<a href="#"><i class="fe fe-shopping-cart"></i> <span> Package Management </span> <span class="menu-arrow"></span></a>
						<ul>
							@if (in_array('Subscribers', $permission)) 
							<li><a href="{{ url('/subscribers') }}"><i class="fe fe-file-plus"></i> <span>Subscribers</span></a></li>
							@endif
							@if (in_array('Plan', $permission)) 
							<li><a href="{{ url('/plans') }}"><i class="fe fe-file-text"></i> <span>Plans</span></a></li>
							@endif
						</ul>
					</li>
				</ul>
				@endif
				@if (in_array('Customer_Tickets', $permission) || in_array('CA_Tickets', $permission)) 
				<ul>
					<li class="submenu">
						<a href="#"><i class="fe fe-alert-triangle"></i> <span> Ticket Management </span> <span class="menu-arrow"></span></a>
						<ul>
							@if (in_array('Customer_Tickets', $permission)) 
							<li><a href="{{ url('/customerticketlist') }}"><i class="fe fe-alert-circle"></i> <span>Customer Tickets</span></a></li>
							@endif
							@if (in_array('CA_Tickets', $permission)) 
							<li><a href="{{ url('/caticketlist') }}"><i class="fe fe-alert-octagon"></i> <span>CA Tickets</span></a></li>
							@endif
						</ul>
					</li>
				</ul>
				@endif
            @endif
            @if (Auth::user()->u_type==2)
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
                        <!--<li><a href="#"><i class="fe fe-file-minus"></i> <span>Payment Out</span></a></li>-->
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
                    <a href="{{ url('/liabilities') }}"><i class="fe fe-anchor"></i> <span>Liabilities</span></a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="{{ url('/payment') }}"><i class="fe fe-arrow-down-right"></i> <span>Payments</span></a>
                </li>
            </ul>
           <!-- <ul>
                <li>
                    <a href="{{ url('/expenses') }}"><i class="fe fe-arrow-up-right"></i> <span>Expenses</span></a>
                </li>
            </ul>-->
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
            @endif
        </div>
        @endif
        @if (Auth::user()->u_type==1 && Auth::user()->isCaActive==1)<!-- this will only visibale when CA login  -->
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li><a href="{{ url('/') }}"> <i class="fe fe-pocket"></i><span>CA Dashboard</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/caprofile') }}"> <i class="fe fe-pocket"></i><span>Profile</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/client') }}"> <i class="fe fe-pocket"></i><span>Customers</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/customerassignment') }}"> <i class="fe fe-pocket"></i><span>Request Assignment</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/employee') }}"> <i class="fe fe-pocket"></i><span>Employee Management</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/task') }}"> <i class="fe fe-pocket"></i><span>Task Management</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/statutory') }}"> <i class="fe fe-pocket"></i><span>Statutory Filling Report</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/reminder') }}"> <i class="fe fe-pocket"></i><span>Reminder</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/capayments') }}"> <i class="fe fe-pocket"></i><span>Payment</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/quote') }}"> <i class="fe fe-pocket"></i><span>Task wise Quotes set</span></a></li>
                </ul>
                <ul>
                    <li><a href="{{ url('/agent') }}"> <i class="fe fe-pocket"></i><span>Business Agent</span></a></li>
                </ul>
            </div>
        @endif
		
		@if (Auth::user()->u_type == 4)	<!-- For employee of CA  -->
		<?php 
			$permission = isset(Auth::user()->emp_permission)?Auth::user()->emp_permission:"";
			$permission = explode(',', $permission);
		?>
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li><a href="{{ url('/') }}"> <i class="fe fe-pocket"></i><span>Dashboard</span></a></li>
            </ul>
			<ul>
                <li>
                    <a href="{{ url('/task') }}"><i class="fe fe-users"></i> <span>Task Assigned</span></a>
                </li>
            </ul>
			@if (in_array('Customer', $permission))            
			<ul>
                <li>
                    <a href="{{ url('/client') }}"><i class="fe fe-users"></i> <span>Customers</span></a>
                </li>
            </ul>
			@endif
			@if (in_array('Product_Services', $permission)) 
            <ul>
                <li>
                    <a href="{{ url('/items') }}"><i class="fe fe-package"></i> <span>Product / Service</span></a>
                </li>
            </ul>
			@endif
			@if (in_array('Sales_Invoice', $permission) || in_array('Sales_Credit_Debit_Note', $permission)) 
            <ul>
                <li class="submenu">
                    <a href="#"><i class="fe fe-shopping-cart"></i> <span> Sales</span> <span class="menu-arrow"></span></a>
                    <ul>
						@if (in_array('Sales_Invoice', $permission)) 
                        <li><a href="{{ url('/sales-invoice') }}"><i class="fe fe-file-plus"></i> <span>Sales Invoice</span></a></li>
						@endif
						@if (in_array('Sales_Credit_Debit_Note', $permission)) 
                        <li><a href="{{ url('/sales-credit-debit') }}"><i class="fe fe-file-text"></i> <span>Credit-Debit Notes</span></a></li>
						@endif
					</ul>
                </li>
            </ul>
			@endif
			
			@if (in_array('Purchases_Invoice', $permission)|| in_array('Payment_Out', $permission) || in_array('Purchases_Credit_Debit_Note', $permission)) 
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-shopping-bag"></i> <span>Purchases</span><span class="menu-arrow"></span></a>
                    <ul>
						@if (in_array('Purchases_Invoice', $permission))
                        <li><a href="{{ url('/purchase-invoice') }}"><i class="fe fe-file-plus"></i> <span>Purchase Invoices</span></a></li>
						@endif
						@if (in_array('Payment_Out', $permission))
                        <li><a href="#"><i class="fe fe-file-minus"></i> <span>Payment Out</span></a></li>
						@endif
						@if (in_array('Purchases_Credit_Debit_Note', $permission))
                        <li><a href="{{ url('/purchase-credit-debit') }}"><i class="fe fe-file-text"></i> <span>Credit-Debit Notes</span></a></li>
						@endif
                    </ul>
                </li>
            </ul>
			@endif
			@if (in_array('Assets_Details', $permission) || in_array('Assets_Voucher', $permission))
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-server"></i> <span>Assets</span><span class="menu-arrow"></span></a>
                    <ul>
						@if (in_array('Assets_Details', $permission))
                        <li><a href="{{ url('/assets') }}"><i class="fe fe-grid"></i> <span>Assets Details</span></a></li>
						@endif
						@if (in_array('Assets_Voucher', $permission))
                        <li><a href="{{ url('/asset-voucher') }}"><i class="fe fe-feather"></i> <span>Assets Voucher</span></a></li>
						@endif
                    </ul>
                </li>
            </ul>
			@endif
			@if (in_array('Payments', $permission))
            <ul>
                <li>
                    <a href="{{ url('/payment') }}"><i class="fe fe-arrow-down-right"></i> <span>Payments</span></a>
                </li>
            </ul>
			@endif
			@if (in_array('Payments', $permission))
            <ul>
                <li>
                    <a href="{{ url('/expenses') }}"><i class="fe fe-arrow-up-right"></i> <span>Expenses</span></a>
                </li>
            </ul>
			@endif
			@if (in_array('Bank_Accounts', $permission) || in_array('Loan_Accounts', $permission) || in_array('Cash_Management', $permission))
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-home"></i> <span>Cash & Bank</span><span class="menu-arrow"></span></a>
                    <ul>
						@if (in_array('Bank_Accounts', $permission))
                        <li><a href="{{ url('/banks') }}"><i class="fe fe-clipboard"></i> <span>Bank Accounts</span></a></li>
						@endif
						@if (in_array('Loan_Accounts', $permission))
                        <li><a href="{{ url('/loans') }}"><i class="fe fe-clipboard"></i> <span>Loan Accounts</span></a></li>
						@endif
						@if (in_array('Cash_Management', $permission))
                        <li><a href="{{ url('/cash') }}"><i class="fe fe-clipboard"></i> <span>Cash Management</span></a></li>
						@endif
                    </ul>
                </li>
            </ul>
			@endif
			@if (in_array('Vendor', $permission))
            <ul>
                <li>
                    <a href="{{ url('/vendors') }}"><i class="fe fe-users"></i><span>Vendors</span></a>
                </li>
            </ul>
			@endif
			@if (in_array('Project', $permission))
            <ul>
                <li>
                    <a href="{{ url('/projects') }}"><i class="fe fe-database"></i> <span>Projects</span></a>
                </li>
            </ul>
			@endif
			@if (in_array('Statutory_Fillings', $permission))
            <ul>
                <li>
                    <a href="{{ url('/statutory') }}"><i class="fe fe-check-square"></i> <span>Statutory Filling</span></a>
                </li>
            </ul>
			@endif
			
            <ul>
                <li class="submenu">
                    <a href=""><i class="fe fe-printer"></i> <span>Reports</span><span class="menu-arrow"></span></a>
                    <ul>
						@if (in_array('Profit_Loss', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Profit & Loss</span></a></li>
						@endif
						@if (in_array('Cash_FLow_Statement', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Cash Flow Statement</span></a></li>
						@endif
						@if (in_array('Balance_Statement', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Balance Sheet</span></a></li>
						@endif
						@if (in_array('GST_Report', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>GST Report</span></a></li>
						@endif
						@if (in_array('Day_Book', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Day Book</span></a></li>
						@endif
						@if (in_array('Bill_wise_Profit', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Bill wise Profit</span></a></li>
						@endif
						@if (in_array('Outstanding_Report', $permission))
                        <li><a href="#"><i class="fe fe-file-text"></i> <span>Outstanding Report</span></a></li>
						@endif
						
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
		
    </div>
</div>
