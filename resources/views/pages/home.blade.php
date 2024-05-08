@extends('layouts.default')
@section('content')


	<div class="page-wrapper">
        <div class="content container-fluid">
			@if (Auth::user())
				
            <div class="row">
				@if (Auth::user()->u_type==2)
                <div class="col-xl-12 col-sm-12 col-12">
                    <div class="list-btn mb-4">
                        <ul class="filter-list justify-content-end">
                            <li>
                                <a class="btn btn-primary" href="{{ url('/charterd') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Assign your CA Firm</a>
                            </li>
                            <li>
                                <a class="btn btn-import" href="{{ url('/add-sales-invoice') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Sales</a>
                            </li>
                            <li>
                                <a class="btn btn-primary" href="{{ url('/add-purchase-invoice') }}"><i class="fa fa-plus-circle me-2" aria-hidden="true"></i>Add Purches</a>
                            </li>
                        </ul>
                    </div>
                </div>
				@endif
                <div class="col-xl-4 col-sm-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-1">
                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Receivables <a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="List-View" data-bs-original-title="Current and Overdue amount that you're yet to receive from customer"> <span><i class="fa-regular fa-circle-question me-1"></i></span></a></div>
                                    <div class="dash-counts mt-1">
                                        <p> Total Unpaid Invoices <i class="fa-solid fa-indian-rupee-sign"></i> 1,642.00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                                <div class="row">
                                    <div class="col-6 mt-2 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-success me-1">Current</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>500</h6>
                                    </div>
                                    <div class="col-6 mt-2 text-center">
                                        <p class="text-muted"><span class="text-danger me-1">Overdue</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>500</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-2">
                                    <i class="fa-solid fa-receipt"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Total Payables <a class="active btn-filters" href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="List-View" data-bs-original-title="Current and Overdue amount that you're yet to pay your vendors"> <span><i class="fa-regular fa-circle-question me-1"></i></span></a></div>
                                    <div class="dash-counts mt-1">
                                        <p> Total Unpaid Bills <i class="fa-solid fa-indian-rupee-sign"></i> 3,642.00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-3">
                                <div class="progress-bar bg-6" role="progressbar" style="width: 65%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                                <div class="row">
                                    <div class="col-6 mt-2 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-success me-1">Current</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>500</h6>
                                    </div>
                                    <div class="col-6 mt-2 text-center">
                                        <p class="text-muted"><span class="text-danger me-1">Overdue</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>500</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-4">
                                    <i class="fa-solid fa-people-group"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Bank Account(s)</div>
                                    <div class="dash-counts mt-1">
                                        <p class="mb-1"> Total Bank Balance <span class="text-success me-1"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($banks[0]->totalBalance)?$banks[0]->totalBalance:0 }}</span></p>
                                        <p class="mb-1"> Total Loan Balance <span class="text-danger me-1"><i class="fa-solid fa-indian-rupee-sign"></i> {{ isset($loans[0]->totalLoan)?$loans[0]->totalLoan:0 }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-8" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-1">Total Bank Account:&nbsp;<span class="text-secondary me-1">{{ isset($banks[0]->totalBankAccount)?$banks[0]->totalBankAccount:0 }}</span></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body py-3">
                            <div class="dash-widget-header py-4">
                                <span class="dash-widget-icon bg-3">
                                    <i class="fa-solid fa-percent"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Gst Summary</div>
                                    <div class="dash-counts mt-1">
                                        <a href="#"> Refresh <i class="fa-solid fa-rotate"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-2">
                            </div>
                                <div class="row">
                                    <div class="col-6 mt-1 text-center" style="border-right:1px solid #ddd;">
                                        <p class="text-muted"><span class="text-success me-1">Credit</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>0.00</h6>
                                    </div>
                                    <div class="col-6 mt-1 text-center">
                                        <p class="text-muted"><span class="text-danger me-1">Payable</span></p>
                                        <h6 class="text-muted mt-1 mb-0"><i class="fa-solid fa-indian-rupee-sign me-1"></i>0.00</h6>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body py-5">
                            <div class="dash-widget-header">
                                <span class="dash-widget-icon bg-1">
                                    <i class="fa-solid fa-people-group"></i>
                                </span>
                                <div class="dash-count">
                                    <div class="dash-title">Customer</div>
                                    <div class="dash-counts">
                                        <p>20</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-5" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-1"><span class="text-success me-1"><i class="fas fa-arrow-up me-1"></i>8.08%</span> since last week</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dash-widget-header" style="margin-bottom:5px;">
                                <div class="dash-count">
                                    <div class="dash-title">Statutory Status</div>
                                </div>
                            </div>
                            <div class="progress progress-sm mb-1"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <table class="table">
                                            <tbody>
												@foreach ($statutory as $val)
                                                <tr>
                                                    <td>{{ $val->statutory_doc}}</td>
                                                    <td>
													@if($val->status ==0)
														<span class="badge bg-danger-light">Pending</span>
													@elseif($val->status ==1)
														<span class="badge bg-success-light">Active</span>
													@elseif($val->status ==2)
														<span class="badge bg-danger-light">On-going</span>
													@endif
													</td>
                                                </tr>
												@endforeach
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table class="table">
                                            <tbody>
                                                @foreach ($statutoryTwo as $val)
                                                <tr>
                                                    <td>{{ $val->statutory_doc}}</td>
                                                    <td>
													@if($val->status ==0)
														<span class="badge bg-danger-light">Pending</span>
													@elseif($val->status ==1)
														<span class="badge bg-success-light">Active</span>
													@elseif($val->status ==2)
														<span class="badge bg-danger-light">On-going</span>
													@endif
													</td>
                                                </tr>
												@endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Income And Expenses</h5>
                                <div class="dropdown main">
                                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Monthly</button>
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
                                        <span>Receipts</span>
                                        <p class="h3 text-success me-5"><i class="fa-solid fa-indian-rupee-sign me-1"></i> 1000</p>
                                    </div>
                                    <div>
                                        <span>Expenses</span>
                                        <p class="h3 text-danger me-5"><i class="fa-solid fa-indian-rupee-sign me-1"></i> 300</p>
                                    </div>
                                </div>
                            </div>
                            <div id="sales_chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 d-flex">
                    <div class="card flex-fill">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Invoice Analytics</h5>
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
                        <div id="invoice_chart"></div>
                        <div class="text-center text-muted">
                            <div class="row">
                                <div class="col-4">
                                <div class="mt-4">
                                    <p class="mb-2 text-truncate"><i class="fas fa-circle text-primary me-1"></i> Invoiced</p>
                                    <h5>₹2,132</h5>
                                </div>
                                </div>
                                <div class="col-4">
                                <div class="mt-4">
                                    <p class="mb-2 text-truncate"><i class="fas fa-circle text-success me-1"></i> Received</p>
                                    <h5>₹1,763</h5>
                                </div>
                                </div>
                                <div class="col-4">
                                <div class="mt-4">
                                    <p class="mb-2 text-truncate"><i class="fas fa-circle text-danger me-1"></i> Pending</p>
                                    <h5>₹973</h5>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
			
			@endif
		</div>
    </div>

		
		
@stop	
		
		
		
		
   
