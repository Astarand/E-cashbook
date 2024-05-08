@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
			@if (Auth::user()->u_type==1 && Auth::user()->isCaActive == 0)
			<div class="row">
                <div class="col text-center">
					<button type="button" class="btn btn-danger text-center"> 
						Your account has been un-assigned.Please contact site admin.
					</button> 
				</div>
			</div>
			@endif
            <div class="row">
              {{--<div class="col-xl-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-3">
                                    <a href="#"><i class="fa-solid fa-file-alt"></i></a>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Customer Payment Status</div>
                                    <div class="dash-counts">
                                        <p> <strong>Total Payments:</strong> &nbsp;<span class="text-success"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalAmount)?$custPayment[0]->totalAmount:0 }}</span></p>
                                        <p> <strong>Total Pending:</strong> &nbsp;<span class="text-warning"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalAdvance)?$custPayment[0]->totalAdvance:0 }}</span></p>
                                        <p> <strong>Overdue :</strong> &nbsp;<span class="text-danger"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalDue)?$custPayment[0]->totalDue:0 }}</span></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>--}}

                <div class="col-xl-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-4">
                                    <a href="#"><i class="fa-solid fa-people-group"></i></a>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title"><a href="#">Employees</a></div>
                                    <div class="dash-counts">
                                        <p> <strong>Total Employee :</strong> &nbsp;<span class="text-info"> {{ isset($employees[0]->totalEmp)?$employees[0]->totalEmp:0 }}</span></p>
                                        <p> <strong>Today Present :</strong> &nbsp;<span class="text-success"> {{ isset($employees[0]->totalPresent)?$employees[0]->totalPresent:0 }}</span></p>
                                        <p> <strong>Today Absent :</strong> &nbsp;<span class="text-danger"> {{ isset($employees[0]->totalAbsent)?$employees[0]->totalAbsent:0 }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-1">
                                    <a href="#"><i class="fa-solid fa-indian-rupee-sign"></i></a>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Firm Payment Status<a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="List-View" data-bs-original-title="Current and Overdue amount that you're yet to receive from customer"> <span><i class="fa-regular fa-circle-question me-1"></i></span></a></div>
                                    <div class="dash-counts">
                                        <p> <strong>Total Govt Fees :</strong> &nbsp;<span class="text-info"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($custPayment[0]->totalGovFees)?$custPayment[0]->totalGovFees:0 }}</span></p>
                                        <p> <strong>Total Payment :</strong> &nbsp;<span class="text-success"><i class="fa-solid fa-indian-rupee-sign"></i> 0</span></p>
                                        <p> <strong>Total Pending :</strong> &nbsp;<span class="text-danger"><i class="fa-solid fa-indian-rupee-sign"></i> 0</span></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Customer Payment Status</h5>
                                <div class="dropdown main">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Monthly
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                       
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                <div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                                    <div>
                                        <span>Total Earning</span>
                                        <p class="h3 text-primary me-5">₹1000</p>
                                    </div>
                                    <div>
                                        <span>Received</span>
                                        <p class="h3 text-success me-5">₹1000</p>
                                    </div>
                                    <div>
                                        <span>Pending</span>
                                        <p class="h3 text-danger me-5">₹300</p>
                                    </div>
                                    <div>
                                        <span>Overdue</span>
                                        <p class="h3 text-dark me-5">₹700</p>
                                    </div>
                                </div>
                            </div>
                            <div id="sales_chart"></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Assign Client</h5>
                                <div class="dropdown main">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Monthly
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                       <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Today</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="invoice_chart"></div>
                            <div class="text-center text-muted">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Total Assign</p>
                                            <h5>₹2,132</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i>Request Assign</p>
                                            <h5>₹1,763</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i>Own Assign</p>
                                            <h5>₹973</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Task wise Clients</h5>
                                <div class="dropdown main">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Monthly
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class=" text-muted">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>ROC Compliance</p>
                                            <h5>2,132</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Company Incorporation</p>
                                            <h5>1,763</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>GST & Returns</p>
                                            <h5>973</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Income Tax</p>
                                            <h5>973</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>PF & ESIC</p>
                                            <h5>2,132</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>P-tax</p>
                                            <h5>1,763</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>TDS</p>
                                            <h5>973</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Audits</p>
                                            <h5>973</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Outsource Work</p>
                                            <h5>2,132</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Outsource Employee</p>
                                            <h5>1,763</h5>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mt-4">
                                            <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i>Other</p>
                                            <h5>1,763</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-7 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Task Status</h5>
                                <div class="dropdown main">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Today
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item">Day Wise</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                <div class="w-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                                    <div class="col-2">
                                        <span>Total Task</span>
                                        <p class="h3 text-primary me-5">100</p>
                                    </div>
                                    <div class="col-2">
                                        <span>Completed Task</span>
                                        <p class="h3 text-success me-5">90</p>
                                    </div>
                                    <div class="col-2">
                                        <span>Pending Task</span>
                                        <p class="h3 text-warning me-5">10</p>
                                    </div>

                                    <div class="col-2">
                                        <span>Overdue Task</span>
                                        <p class="h3 text-danger me-5">7</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="mb-3">
                                    <div class="progress progress-md rounded-pill mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="fas fa-circle text-success me-1"></i> Completed Task
                                        </div>
                                        <div class="col-2">
                                            <i class="fas fa-circle text-warning me-1"></i> Pending Task
                                        </div>
                                        <div class="col-2">
                                            <i class="fas fa-circle text-danger me-1"></i> Overdue Task
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Client Name</th>
                                            <th>Task Type</th>
                                            <th>Due Date</th>
                                            <th>Status</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Jhon Doe</td>
                                            <td>GST Return</td>
                                            <td>23 Nov 2023</td>
                                            <td><span class="badge bg-success-light">Completed</span></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        <a class="dropdown-item" href="invoice-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Karlene Chaidez</td>
                                            <td>TDS Return</td>
                                            <td>18 Nov 2020</td>
                                            <td><span class="badge bg-warning-light text-warning">Pending</span></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="edit-invoice.html"><i class="far fa-edit me-2"></i>Edit</a>
                                                        <a class="dropdown-item" href="invoice-details.html"><i class="far fa-eye me-2"></i>View</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-trash-alt me-2"></i>Delete</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-check-circle me-2"></i>Mark as sent</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="far fa-copy me-2"></i>Clone Invoice</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@stop





