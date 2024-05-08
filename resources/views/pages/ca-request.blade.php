@extends('layouts.default')

@section('content')

		@if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h4 class="alert-heading">Success!</h4>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Company Requested CA</h5>
                    <div class="list-btn">
                        <ul class="filter-list">
                            <li>
                                <a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
                            </li>
                            <li>
                                <a class="btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Share"><i class="fa-brands fa-whatsapp"></i></span> </a>
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
                                            <a class="d-flex align-items-center download-item" href="javascript:void(0);" download=""><i class="far fa-file-text me-2"></i>Excel</a>
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
                            <table class="table table-center table-hover datatable" id="comp_request_ca">
                                <thead class="thead-light">
								
                                <tr>
                                    <th>#</th>
                                    <th>CA Name</th>
                                    <th>CA Phone</th>
                                    <th>CA Email </th>
									<th>CA State/City/Pin </th>
                                    <th>CA Address</th>
                                    <th>Created</th>
                                    <th>Email/Whatsapp</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $i = 1; ?>
								@foreach ($ca_details as $ca_detail)
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td>
                                        <h2 class="table-avatar">
											<a title="Show CA Permission" class="btn btn-outline-secondary btn-sm" data-id="{{ $ca_detail->id }}" onclick="show_ca_permission(this);" data-bs-toggle="modal" data-bs-target="#capermission">{{ $ca_detail->ca_name }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $ca_detail->ca_phone }}</td>
                                    <td>{{ $ca_detail->ca_email }}</td>
                                    <td>{{ $ca_detail->ca_state }}/{{ $ca_detail->ca_city }}/{{ $ca_detail->ca_pincode}}</td>
                                    <td>{{ $ca_detail->ca_addr_one }}</td>
                                    <td>{{ date('d-m-Y', strtotime($ca_detail->created_at)) }}</td>
									<td>
										@if ($ca_detail->is_email==0) 
											Not Send /
										@else
											Send /
										@endif
										
										@if ($ca_detail->is_whatsapp==0) 
											Not Send
										@else
											Send
										@endif
									</td>
									@if ($ca_detail->ca_status==0)  
										<td><span class="badge badge-pill bg-danger-light">Pending</span></td>
									@else
										<td><span class="badge badge-pill bg-success-light">Completed</span></td>
									@endif
                                    <td class="d-flex align-items-center">
                                        <a href="javascript:void(0);" class="btn btn-greys me-2"><i class="fa fa-plus-circle me-1"></i> </a>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
												@if ($ca_detail->ca_status==0)
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="1" class="dropdown-item request_active" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Completed</a>
                                                </li>
												@else
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="0" class="dropdown-item request_active" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Pending</a>
                                                </li>
												@endif
												
												@if ($ca_detail->is_email==0)
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="1" class="dropdown-item is_email" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Send Email</a>
                                                </li>
												@else
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="0" class="dropdown-item is_email" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Email Not Send</a>
                                                </li>
												@endif
												
												@if ($ca_detail->is_whatsapp==0)
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="1" class="dropdown-item is_whatsapp" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Send Whatsapp</a>
                                                </li>
												@else
                                                <li>
                                                    <a data-id="{{$ca_detail->id}}" data-stat="0" class="dropdown-item is_whatsapp" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Whatsapp Not Send</a>
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
								<?php echo $ca_pagination->links() ?>
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
                                Customer Name
                                <span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                            </h6>
                        </div>
                        <div class="card-body-chat">
                            <div class="form-group">
                                <label for="ca_name">CA Name:</label>
                                <input class="form-control filter-input" type="text" id="ca_name" name="ca_name">
                            </div>
                            <div class="form-group">
                                <label for="ca_phone">CA Phone:</label>
                                <input class="form-control filter-input" type="tel" id="ca_phone" name="ca_phone">
                            </div>
                            <div class="form-group">
                                <label for="ca_email">CA Email:</label>
                                <input class="form-control filter-input" type="email" id="ca_email" name="ca_email">
                            </div>
                            <div class="form-group">
                                <label for="ca_location">CA State/City/Pin:</label>
                                <input class="form-control filter-input" type="text" id="ca_location" name="ca_location">
                            </div>
                            <div class="form-group">
                                <label for="ca_address">CA Address:</label>
                                <input class="form-control filter-input" type="text" id="ca_address" name="ca_address">
                            </div>
                            <div class="form-group">
                                <label for="created">Created:</label>
                                <input class="form-control filter-input" type="date" id="created" name="created">
                            </div>
                            <div class="form-group">
                                <label for="contact_method">Email/Whatsapp:</label>
                                <select class="form-control filter-input" id="contact_method" name="contact_method">
                                    <option value="">Select</option>
                                    <option value="email">Email</option>
                                    <option value="whatsapp">Whatsapp</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control filter-input" id="status" name="status">
                                    <option value="">Select</option>
                                    <option value="Pending">Active</option>
                                    <option value="Completed">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button id="reset_filters" class="btn btn-secondary">Reset Filters</button>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content">
				<div class="modal-body">
					<div class="form-header">
					<h3>Delete Customer</h3>
					<p>Are you sure want to delete?</p>
					</div>
					<div class="modal-btn delete-action">
					<div class="row">
						<div class="col-6">
							<button type="reset" data-bs-dismiss="modal" id="del_cust" data-id=""  class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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
	
	<div class="modal fade" id="capermission" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="form-header">
						<h3>CA Permission</h3>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<div class="form-group" id="permissionDiv">
								
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
                var caName = $('#ca_name').val().toLowerCase();
                var caPhone = $('#ca_phone').val().toLowerCase();
                var caEmail = $('#ca_email').val().toLowerCase();
                var caLocation = $('#ca_location').val().toLowerCase();
                var caAddress = $('#ca_address').val().toLowerCase();
                var createdDate = $('#created').val();
                var contactMethod = $('#contact_method').val().toLowerCase();
                var status = $('#status').val().toLowerCase();

                $('#comp_request_ca tbody tr').each(function() {
                    var rowCAName = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var rowCAPhone = $(this).find('td:nth-child(3)').text().toLowerCase();
                    var rowCAEmail = $(this).find('td:nth-child(4)').text().toLowerCase();
                    var rowCALocation = $(this).find('td:nth-child(5)').text().toLowerCase();
                    var rowCAAddress = $(this).find('td:nth-child(6)').text().toLowerCase();
                    var rowCreatedDate = $(this).find('td:nth-child(7)').text().trim();
                    var rowContactMethod = $(this).find('td:nth-child(8)').text().toLowerCase();
                    var rowStatus = $(this).find('td:nth-child(9)').text().toLowerCase();

                    var showRow = true;

                    if (caName !== '' && !rowCAName.includes(caName)) {
                        showRow = false;
                    }
                    if (caPhone !== '' && !rowCAPhone.includes(caPhone)) {
                        showRow = false;
                    }
                    if (caEmail !== '' && !rowCAEmail.includes(caEmail)) {
                        showRow = false;
                    }
                    if (caLocation !== '' && !rowCALocation.includes(caLocation)) {
                        showRow = false;
                    }
                    if (caAddress !== '' && !rowCAAddress.includes(caAddress)) {
                        showRow = false;
                    }
                    if (createdDate !== '' && rowCreatedDate !== createdDate) {
                        showRow = false;
                    }
                    if (contactMethod !== '' && !rowContactMethod.includes(contactMethod)) {
                        showRow = false;
                    }
                    if (status !== '' && !rowStatus.includes(status)) {
                        showRow = false;
                    }

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