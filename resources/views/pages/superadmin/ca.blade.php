@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>CA Lists</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
                            </li>
                            <li>
                                <a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="List-View"><span><i class="fe fe-list"></i></span> </a>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Grid-View"><span><i class="fe fe-grid"></i></span> </a>
                            </li>
                            <li>
                                <div class="dropdown dropdown-action" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
                                    <a href="#" class="btn-filters" data-bs-toggle="dropdown" aria-expanded="false"><span><i class="fe fe-download"></i></span></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="d-block">
                                            <li>
                                                <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-pdf me-2"></i>PDF</a>
                                            </li>
                                            <li>
                                                <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-text me-2"></i>CVS</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Print"><span><i class="fe fe-printer"></i></span> </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="filter_inputs" class="card filter-card">
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-center table-hover datatable" id="ca_filter_table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Joining Date</th>
                                        <th>CA Name</th>
                                        <th>Phone</th>
                                        <th>Join From</th>
                                        <th>Customer No.</th>
                                        <th>City/State</th>
                                        <th>Pincode</th>
										<th>Assign Status</th>
                                        <th>Login Status</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php $i = 1; ?>
									@foreach ($users as $user)
                                        <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td>{{ date('d-m-Y', strtotime($user->created_at)) }}</td>
                                        <td>
                                            <h2 class="table-avatar">
                                                <a href="{{ url('/cadetails/'.base64_encode($user->id)) }}" class="avatar avatar-md me-2">
												<img class="avatar-img rounded-circle" src="{{asset('/public/uploads/profile/'.$user->comp_logo)}}" alt="">												
												</a>
                                                <a href="{{ url('/cadetails/'.base64_encode($user->id)) }}">{{ $user->comp_name }} <span><span class="__cf_email__" data-cfemail="a9c3c6c1c7e9ccd1c8c4d9c5cc87cac6c4">{{ $user->comp_email }}</span></span></a>
                                            </h2>
                                        </td>
                                        <td>{{ $user->comp_phone }}</td>
                                        <td>Requested CA</td>
                                        <td>{{ $user->customerNo }}</td>
                                        <td>{{ $user->state.','.$user->city }}</td>
                                        <td>{{ $user->comp_bill_pin }}</td>
										<td>										
										@if ($user->isCaActive==0)  
											<span class="badge badge-pill bg-danger-light">Un-Assigned</span>
										@else
											<span class="badge badge-pill bg-success-light">Assigned</span>
										@endif
										</td>
                                        <td>										
										@if ($user->status==0)  
											<span class="badge badge-pill bg-danger-light">InActive</span>
										@else
											<span class="badge badge-pill bg-success-light">Active</span>
										@endif
										</td>
                                            <td><span class="badge badge-pill bg-primary-light">Normal</span></td>
                                        <td class="d-flex align-items-center">
                                            <a href="{{ url('/messages/'.base64_encode($user->id)) }}" class="btn btn-greys me-2"><i class="fe fe-send me-1"></i> Message</a>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul>
                                                        <!--<li>
                                                            <a class="dropdown-item" href="edit-customer.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="customer-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="fe fe-user-plus me-2"></i>Promote to Super</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i class="fe fe-user-minus me-2"></i>Promote to Normal</a>
                                                        </li>-->
														@if ($user->isCaActive==0)
														<li>
                                                            <a data-id="{{$user->id}}" data-iscaactive="1" class="dropdown-item caunassign" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#unassign_modal"><i class="far fa-user me-2"></i>Assign</a>
                                                        </li>
														@else
														<li>
                                                            <a data-id="{{$user->id}}" data-iscaactive="0" class="dropdown-item caunassign" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#unassign_modal"><i class="fa-solid fa-power-off me-2"></i>Un-Assign</a>
                                                        </li>
														@endif
                                                        @if ($user->status==0)
														<li>
															<a data-id="{{$user->id}}" data-stat="1" class="dropdown-item caStatus" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Active</a>
														</li>
														@else
														<li>
															<a data-id="{{$user->id}}" data-stat="0" class="dropdown-item caStatus" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>InActive</a>
														</li>
														@endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
									@endforeach
                                        
									
                                    </tbody>
                                </table>
								<div class="d-flex justify-content-center">
									<?php echo $users_pagination->links() ?>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="toggle-sidebar">
        <div class="sidebar-layout-filter">
            <div class="sidebar-header">
                <h5>Filter</h5>
                <a href="#" class="sidebar-closes"><i class="fa-regular fa-circle-xmark"></i></a>
            </div>
            <div class="sidebar-body">
                <form action="#" autocomplete="off">
                    <div class="accordion" id="accordionMain1">
                        <div class="card-header-new" id="headingOne">
                            <h6 class="filter-title">
                                <a href="javascript:void(0);" class="w-100" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    CA List
                                    <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="card-body-chat">
                                <div class="form-group">
                                    <label for="joining_date">Joining Date:</label>
                                    <input class="form-control filter-input" type="date" id="joining_date" name="joining_date">
                                </div>
                                <div class="form-group">
                                    <label for="customer_name">Customer Name:</label>
                                    <input class="form-control filter-input" type="text" id="customer_name" name="customer_name">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone:</label>
                                    <input class="form-control filter-input" type="tel" id="phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="assign_ca">Assign CA:</label>
                                    <input class="form-control filter-input" type="text" id="assign_ca" name="assign_ca">
                                </div>
                                <div class="form-group">
                                    <label for="city_state">City/State:</label>
                                    <input class="form-control filter-input" type="text" id="city_state" name="city_state">
                                </div>
                                <div class="form-group">
                                    <label for="pincode">Pincode:</label>
                                    <input class="form-control filter-input" type="text" id="pincode" name="pincode">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control filter-input" id="status" name="status">
                                        <option value="">Select</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button id="reset_filters" class="btn btn-secondary">Reset Filters</button>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <div class="modal custom-modal fade" id="unassign_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Assign/Un-Assign CA</h3>
                        <p>Are you sure want to do action?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <button type="reset" data-bs-dismiss="modal" id="caUnAssinged" class="w-100 btn btn-primary paid-continue-btn">Submit</button>
                            </div>
                            <div class="col-6">
                                <button type="submit" data-bs-dismiss="modal" class="w-100 btn btn-primary paid-cancel-btn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Attach event listeners to filter inputs
            $('.filter-input').on('input', function() {
                applyFilters();
            });

            // Attach event listener to reset button
            $('#reset_filters').on('click', function(event) {
                event.preventDefault();
                $('.filter-input').val('');
                applyFilters();
            });

            function applyFilters() {
                var joiningDate = $('#joining_date').val();
                var customerName = $('#customer_name').val().toLowerCase();
                var phone = $('#phone').val().toLowerCase();
                var assignCA = $('#assign_ca').val().toLowerCase();
                var cityState = $('#city_state').val().toLowerCase();
                var pincode = $('#pincode').val().toLowerCase();
                var status = $('#status').val().toLowerCase();

                // Apply filters to the first table
                $('#customer_list_table tbody tr').each(function() {
                    var rowJoiningDate = $(this).find('td:nth-child(2)').text().trim();
                    var rowCustomerName = $(this).find('td:nth-child(3)').text().toLowerCase();
                    var rowPhone = $(this).find('td:nth-child(4)').text().toLowerCase();
                    var rowAssignCA = $(this).find('td:nth-child(5)').text().toLowerCase();
                    var rowCityState = $(this).find('td:nth-child(6)').text().toLowerCase();
                    var rowPincode = $(this).find('td:nth-child(7)').text().toLowerCase();
                    var rowStatus = $(this).find('td:nth-child(8)').text().toLowerCase();

                    var showRow = true;

                    // Apply filters
                    if (joiningDate !== '' && rowJoiningDate !== joiningDate) {
                        showRow = false;
                    }
                    if (customerName !== '' && !rowCustomerName.includes(customerName)) {
                        showRow = false;
                    }
                    if (phone !== '' && !rowPhone.includes(phone)) {
                        showRow = false;
                    }
                    if (assignCA !== '' && !rowAssignCA.includes(assignCA)) {
                        showRow = false;
                    }
                    if (cityState !== '' && !rowCityState.includes(cityState)) {
                        showRow = false;
                    }
                    if (pincode !== '' && !rowPincode.includes(pincode)) {
                        showRow = false;
                    }
                    if (status !== '' && !rowStatus.includes(status)) {
                        showRow = false;
                    }

                    // Toggle row visibility
                    if (showRow) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Apply filters to the second table
                $('#ca_filter_table tbody tr').each(function() {
                    var rowJoiningDate = $(this).find('td:nth-child(2)').text().trim();
                    var rowCustomerName = $(this).find('td:nth-child(3)').text().toLowerCase();
                    var rowPhone = $(this).find('td:nth-child(4)').text().toLowerCase();
                    var rowAssignCA = $(this).find('td:nth-child(5)').text().toLowerCase();
                    var rowCityState = $(this).find('td:nth-child(6)').text().toLowerCase();
                    var rowPincode = $(this).find('td:nth-child(7)').text().toLowerCase();
                    var rowStatus = $(this).find('td:nth-child(8)').text().toLowerCase();

                    var showRow = true;

                    // Apply filters
                    if (joiningDate !== '' && rowJoiningDate !== joiningDate) {
                        showRow = false;
                    }
                    if (customerName !== '' && !rowCustomerName.includes(customerName)) {
                        showRow = false;
                    }
                    if (phone !== '' && !rowPhone.includes(phone)) {
                        showRow = false;
                    }
                    if (assignCA !== '' && !rowAssignCA.includes(assignCA)) {
                        showRow = false;
                    }
                    if (cityState !== '' && !rowCityState.includes(cityState)) {
                        showRow = false;
                    }
                    if (pincode !== '' && !rowPincode.includes(pincode)) {
                        showRow = false;
                    }
                    if (status !== '' && !rowStatus.includes(status)) {
                        showRow = false;
                    }

                    // Toggle row visibility
                    if (showRow) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    </script>



@endsection
