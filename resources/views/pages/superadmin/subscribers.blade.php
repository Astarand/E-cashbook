@extends('layouts.default')
@section('content')
<div class="page-wrapper">
				<div class="content container-fluid">
					<div class="page-header">
						<div class="content-page-header">
							<h5>Subscribers</h5>
							<div class="list-btn">
								<ul class="filter-list">
									<li>
										<a class="btn btn-filters w-auto popup-toggle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Filter"><span class="me-2"><img src="{{asset('public/assets/img/icons/filter-icon.svg')}}" alt="filter"></span>Filter </a>
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
					<div class="row">
						<div class="col-sm-12">
							<div class="card-table">
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-stripped table-hover datatable" id="your_table_id">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Provider Name</th>
													<th>Package Name</th>
													<th>Subscription Type</th>
													<th>Amount</th>
													<th>service</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Status</th>
													<th>Transaction Id</th>
												</tr>
											</thead>
											<tbody>
												<?php $i = 1; ?>
												@foreach ($subData as $val)
												<tr>
													<td><?php echo $i++; ?></td>
													<td>
														@if ($val->utype==1) 
														<h2 class="table-avatar">
															<a href="{{ url('/cadetails/'.base64_encode($val->uid)) }}" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{asset('/public/uploads/profile/'.$val->comp_logo)}}" alt=""></a>
															<a href="{{ url('/cadetails/'.base64_encode($val->uid)) }}">{{ $val->name }} </a>
														</h2>
														@else
														<h2 class="table-avatar">
															<a href="{{ url('/customerprofile/'.base64_encode($val->uid)) }}" class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle" src="{{asset('/public/uploads/profile/'.$val->comp_logo)}}" alt=""></a>
															<a href="{{ url('/customerprofile/'.base64_encode($val->uid)) }}">{{ $val->name }} </a>
														</h2>
														@endif
													</td>
													<td>{{ $val->plan_name }}</td>
													<td><span class="badge badge-pill bg-success-light">{{ $val->plan_type }}</span></td>
													<td>₹{{ $val->paid_amount }}</td>
													<td>{{ $val->service }}</td>
													<td>{{ date('d-m-Y', strtotime($val->start_at)) }}</td>
													<td>{{ date('d-m-Y', strtotime($val->end_at)) }}</td>
													<td>
													@if ($val->payment_status=="SUCCESS")  
														<span class="badge badge-pill bg-success-light">{{$val->payment_status}}</span>
													@else
														<span class="badge badge-pill bg-danger-light">{{$val->payment_status}}</span>
													@endif
													</td>
													<td>{{ $val->transaction_id }}</td>	

												</tr>
												@endforeach
												
											</tbody>
										</table>
										<div class="d-flex justify-content-center">
											<?php echo $subData_pagination->links() ?>
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
										Customer
										<span class="float-end"><i class="fa-solid fa-chevron-down"></i></span>
										</a>
									</h6>
								</div>
								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
									<div class="card-body-chat">
										<div class="form-group">
											<label for="provider_name">Provider Name:</label>
											<input class="form-control filter-input" type="text" id="provider_name" name="provider_name">
										</div>
										<div class="form-group">
											<label for="package_name">Package Name:</label>
											<input class="form-control filter-input" type="text" id="package_name" name="package_name">
										</div>
										<div class="form-group">
											<label for="subscription_type">Subscription Type:</label>
											<input class="form-control filter-input" type="text" id="subscription_type" name="subscription_type">
										</div>
										<div class="form-group">
											<label for="amount">Amount:</label>
											<input class="form-control filter-input" type="text" id="amount" name="amount">
										</div>
										<div class="form-group">
											<label for="service">Service:</label>
											<input class="form-control filter-input" type="text" id="service" name="service">
										</div>
										<div class="form-group">
											<label for="start_date">Start Date:</label>
											<input class="form-control filter-input" type="date" id="start_date" name="start_date">
										</div>
										<div class="form-group">
											<label for="end_date">End Date:</label>
											<input class="form-control filter-input" type="date" id="end_date" name="end_date">
										</div>
										<div class="form-group">
											<label for="status">Status:</label>
											<select class="form-control filter-input" id="status" name="status">
												<option value="">Select</option>
												<option value="SUCCESS">Success</option>
												<option value="PAYMENT_PENDING">Payment Pending</option>
											</select>
										</div>
										<div class="form-group">
											<label for="transaction_id">Transaction ID:</label>
											<input class="form-control filter-input" type="text" id="transaction_id" name="transaction_id">
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
						var providerName = $('#provider_name').val().toLowerCase();
						var packageName = $('#package_name').val().toLowerCase();
						var subscriptionType = $('#subscription_type').val().toLowerCase();
						var amount = $('#amount').val().toLowerCase();
						var service = $('#service').val().toLowerCase();
						var startDate = $('#start_date').val();
						var endDate = $('#end_date').val();
						var status = $('#status').val().toLowerCase();
						var transactionId = $('#transaction_id').val().toLowerCase();
		
						$('#your_table_id tbody tr').each(function() {
							var rowProviderName = $(this).find('td:nth-child(2)').text().toLowerCase();
							var rowPackageName = $(this).find('td:nth-child(3)').text().toLowerCase();
							var rowSubscriptionType = $(this).find('td:nth-child(4)').text().toLowerCase();
							var rowAmount = $(this).find('td:nth-child(5)').text().toLowerCase();
							var rowService = $(this).find('td:nth-child(6)').text().toLowerCase();
							var rowStartDate = $(this).find('td:nth-child(7)').text();
							var rowEndDate = $(this).find('td:nth-child(8)').text();
							var rowStatus = $(this).find('td:nth-child(9)').text().toLowerCase();
							var rowTransactionId = $(this).find('td:nth-child(10)').text().toLowerCase();
		
							var showRow = true;
		
							if (providerName !== '' && !rowProviderName.includes(providerName)) {
								showRow = false;
							}
							if (packageName !== '' && !rowPackageName.includes(packageName)) {
								showRow = false;
							}
							if (subscriptionType !== '' && !rowSubscriptionType.includes(subscriptionType)) {
								showRow = false;
							}
							if (amount !== '' && !rowAmount.includes(amount)) {
								showRow = false;
							}
							if (service !== '' && !rowService.includes(service)) {
								showRow = false;
							}
							if (startDate !== '' && rowStartDate !== startDate) {
								showRow = false;
							}
							if (endDate !== '' && rowEndDate !== endDate) {
								showRow = false;
							}
							if (status !== '' && !rowStatus.includes(status)) {
								showRow = false;
							}
							if (transactionId !== '' && !rowTransactionId.includes(transactionId)) {
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
