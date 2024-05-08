@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Admin Employee</h5>
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
                            <li>
                                <a class="btn btn-primary" href="{{ url('/addadminemployee') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Employee</a>
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
                            <table class="table table-center table-hover datatable" id="your_table_id">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Depertment Type</th>
                                    <th>Deignation</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
								<?php $i = 1; ?>
								@foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        {{ $employee->name }}
                                    </td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->dept_name }}</td>
                                    <td>{{ $employee->desig_name }}</td>
                                    @if ($employee->status==0)  
										<td><span class="badge badge-pill bg-danger-light">Deactive</span></td>
									@else
										<td><span class="badge badge-pill bg-success-light">Active</span></td>
									@endif
                                    <td class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-greys me-2"><i class="fa fa-eye me-1"></i>Generate Payslip</a>
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class=" btn-action-icon " data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                            <ul>
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/edit-admin-employee/'.base64_encode($employee->id)) }}"><i class="far fa-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a data-id="{{$employee->id}}" class="dropdown-item adminempdelete" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{ url('/view-admin-employee/'.base64_encode($employee->id)) }}"><i class="far fa-eye me-2"></i>View</a>
                                                </li>
                                                @if ($employee->status==0)
                                                <li>
                                                    <a data-id="{{$employee->id}}" data-stat="1" class="dropdown-item admin_emp_active" href="javascript:void(0);"><i class="fa-solid fa-power-off me-2"></i>Activate</a>
                                                </li>
												@else
                                                <li>
                                                    <a data-id="{{$employee->id}}" data-stat="0" class="dropdown-item admin_emp_active" href="javascript:void(0);"><i class="far fa-bell-slash me-2"></i>Deactivate</a>
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
								<?php echo $employees_pagination->links() ?>
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
                    <div class="card-body-chat">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input class="form-control filter-input" type="text" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input class="form-control filter-input" type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="department_type">Department Type:</label>
                            <input class="form-control filter-input" type="text" id="department_type" name="department_type">
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation:</label>
                            <input class="form-control filter-input" type="text" id="designation" name="designation">
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
                    
                </form>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                    <h3>Delete Employee</h3>
                    <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <button type="reset" data-bs-dismiss="modal" id="admin_del_emp" data-id="" class="w-100 btn btn-primary paid-continue-btn">Delete</button>
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
                var name = $('#name').val().toLowerCase();
                var phone = $('#phone').val().toLowerCase();
                var departmentType = $('#department_type').val().toLowerCase();
                var designation = $('#designation').val().toLowerCase();
                var status = $('#status').val().toLowerCase();

                $('#your_table_id tbody tr').each(function() {
                    var rowName = $(this).find('td:nth-child(2)').text().toLowerCase();
                    var rowPhone = $(this).find('td:nth-child(3)').text().toLowerCase();
                    var rowDepartmentType = $(this).find('td:nth-child(4)').text().toLowerCase();
                    var rowDesignation = $(this).find('td:nth-child(5)').text().toLowerCase();
                    var rowStatus = $(this).find('td:nth-child(6)').text().toLowerCase();

                    var showRow = true;

                    if (name !== '' && !rowName.includes(name)) {
                        showRow = false;
                    }
                    if (phone !== '' && !rowPhone.includes(phone)) {
                        showRow = false;
                    }
                    if (departmentType !== '' && !rowDepartmentType.includes(departmentType)) {
                        showRow = false;
                    }
                    if (designation !== '' && !rowDesignation.includes(designation)) {
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
