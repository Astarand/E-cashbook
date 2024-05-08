@extends('layouts.default')

@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Update Your Company Profile</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
					<!--<form action="#">-->
                        <div class="card-body">
                            <h5 class="form-title">Basic Details</h5>
                            <div class="profile-picture">
								
									<div class="upload-profile">
									<div class="profile-img">
										<img id="image-preview" class="avatar" src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt>
									</div>
									<div class="add-profile">
										<h5>Upload Company Logo*</h5>
										<span id="name-preview"></span>
									</div>
									</div>
									<div class="img-upload">
										<form action="javascript:void(0);">
										<label class="btn btn-primary">
										Upload <input type="file" name="profile-image-uploader" id="profile-image-uploader">
										</label>
										<a class="btn btn-remove">Remove</a>
										</form>
									</div>
								
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Company Details</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#details" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Business Details</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#bank" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">Bank Details</a>
                                        </li>
                                    
                                        <li class="nav-item" role="presentation">
                                            <a href="#attachments" data-bs-toggle="tab" aria-expanded="false" class="nav-link " aria-selected="true" role="tab">Attachments</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="info" role="tabpanel">
											<form action="javascript:void(0);" name="frmcompdet" id="frmcompdet">
											@csrf
                                            <div class="message-container"></div>
											<div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>GST Number</label>
                                                        <input type="text" name="comp_gst_no" id="comp_gst_no" value="{{ $compDetails->comp_gst_no}}" class="form-control" placeholder="Enter Company GST Number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" name="comp_name" id="comp_name" value="{{ $compDetails->comp_name}}" class="form-control" placeholder="Company Name" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Company Email</label>
                                                        <input type="email" name="comp_email" id="comp_email" value="{{ $compDetails->comp_email}}" class="form-control" placeholder="Enter Email Address" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" name="comp_phone" id="comp_phone" value="{{ $compDetails->comp_phone}}" class="form-control" placeholder="Phone Number" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>PAN Number</label>
                                                        <input type="text" name="comp_pan_no" id="comp_pan_no" value="{{ $compDetails->comp_pan_no}}" class="form-control" placeholder="Enter PAN Number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="text" name="comp_website" id="comp_website" value="{{ $compDetails->comp_website}}" class="form-control" placeholder="Enter Website Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-item">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="billing-btn mb-2">
                                                            <h5 class="form-title">Billing Address</h5>
                                                            <a href="#" class="btn btn-primary" onclick="addBillingAddress()">Add Branch</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" name="comp_bill_name" id="comp_bill_name" value="{{ $compDetails->comp_bill_name}}" placeholder="Enter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 1</label>
                                                            <input type="text" class="form-control" name="comp_bill_addone" id="comp_bill_addone" value="{{ $compDetails->comp_bill_addone}}" placeholder="Enter Address 1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 2</label>
                                                            <input type="text" class="form-control" name="comp_bill_addtwo" id="comp_bill_addtwo" value="{{ $compDetails->comp_bill_addtwo}}" placeholder="Enter Address 2">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <!--<input type="text" class="form-control" name="comp_bill_country" id="comp_bill_country" placeholder="Enter Country">-->
																	<select class="form-control select-style" name="comp_bill_country" id="country" onChange="changeCountry(this);">
																		<option value="">Select Country</option>
																		@foreach($countries as $k=>$country)
																		<option value="{{ $country->id }}" <?php echo ($country->id==$compDetails->comp_bill_country)? "selected":"" ?>>{{ $country->name }}</option>
																		@endforeach
																	</select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <!--<input type="text" class="form-control" name="comp_bill_city" id="comp_bill_city" placeholder="Enter City">-->
																	<select class="form-control select-style" name="comp_bill_city" id="city">
																		<option value="">Select City</option>
																		@foreach($cities_bill as $k=>$city)
																			<option value="{{ $city->id }}" <?php echo ($city->id==$compDetails->comp_bill_city)? 'selected="selected"':"" ?>>{{ $city->name }}</option>
																		@endforeach
																	</select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <!--<input type="text" class="form-control" name="comp_bill_state" id="comp_bill_state" placeholder="Enter State">-->
																	<select class="form-control select-style" name="comp_bill_state" id="state" onChange="changeState(this);">
																		<option value="">Select State</option>
																		@foreach($states_bill as $k=>$state)
																			<option value="{{ $state->id }}" <?php echo ($state->id==$compDetails->comp_bill_state)? "selected":"" ?>>{{ $state->name }}</option>
																		@endforeach
																	</select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pincode</label>
                                                                    <input type="text" class="form-control" name="comp_bill_pin" id="comp_bill_pin" value="{{ $compDetails->comp_bill_pin}}" placeholder="Enter Pincode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="billing-btn">
                                                            <h5 class="form-title mb-0">Shipping Address</h5>
                                                            <a href="#" class="btn btn-primary">Same as Billing Address</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" name="comp_ship_name" id="comp_ship_name" value="{{ $compDetails->comp_ship_name}}" placeholder="Enter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 1</label>
                                                            <input type="text" class="form-control" name="comp_ship_addone" id="comp_ship_addone" value="{{ $compDetails->comp_ship_addone}}" placeholder="Enter Address 1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 2</label>
                                                            <input type="text" class="form-control" name="comp_ship_addtwo" id="comp_ship_addtwo" value="{{ $compDetails->comp_ship_addtwo}}" placeholder="Enter Address 2">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <!--<input type="text" class="form-control" name="comp_ship_country" id="comp_ship_country" placeholder="Enter Country">-->
																	<select class="form-control select-style" name="comp_ship_country" id="country_ship" onChange="changeCountry_ship(this);">
																		<option value="">Select Country</option>
																		@foreach($countries as $k=>$country)
																		<option value="{{ $country->id }}" <?php echo ($country->id==$compDetails->comp_ship_country)? "selected":"" ?>>{{ $country->name }}</option>
																		@endforeach
																	</select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <!--<input type="text" class="form-control" name="comp_ship_city" id="comp_ship_city" placeholder="Enter City">-->
																	<select class="form-control select-style" name="comp_ship_city" id="city_ship">
																		<option value="">Select City</option>
																		@foreach($cities_ship as $k=>$city)
																			<option value="{{ $city->id }}" <?php echo ($city->id==$compDetails->comp_ship_city)? "selected":"" ?>>{{ $city->name }}</option>
																		@endforeach
																	</select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <!--<input type="text" class="form-control" name="comp_ship_state" id="comp_ship_state" placeholder="Enter State">-->
																	<select class="form-control select-style" name="comp_ship_state" id="state_ship" onChange="changeState_ship(this);">
																		<option value="">Select State</option>
																		@foreach($states_ship as $k=>$state)
																			<option value="{{ $state->id }}" <?php echo ($state->id==$compDetails->comp_ship_state)? "selected":"" ?>>{{ $state->name }}</option>
																		@endforeach
																		
																	</select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pincode</label>
                                                                    <input type="text" class="form-control" name="comp_ship_pin" id="comp_ship_pin" value="{{ $compDetails->comp_ship_pin}}" placeholder="Enter Pincode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" id="cancel_compDetBtn" class="btn customer-btn-cancel">Cancel</a>
                                                <button type="submit" id="save_compDetBtn" class="btn customer-btn-save">Save Changes</button>
                                            </div>
											</form>
                                        </div>
										
										
										
                                        <div class="tab-pane" id="details" role="tabpanel">
											<form action="javascript:void(0);" name="frmbusdet" id="frmbusdet" method="post">
											@csrf
                                            <div class="message-container"></div>
                                            <div class="form-group-customer customer-additional-form">
                                                <div class="row">
                                                    <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Business Details</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group row pt-3">
                                                            <label class="col-lg-4 col-form-label pt-3">Company Nature</label>
                                                            <div class="col-lg-8 pt-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="comp_nature" id="business" value="business"  {{$compDetails->comp_nature =='business' ? 'checked' : ''}} >
                                                                    <label class="form-check-label" for="business">Business</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="comp_nature" id="service" value="service" {{$compDetails->comp_nature =='service' ? 'checked' : ''}} >
                                                                    <label class="form-check-label" for="service">Service</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Exact Nature of Business</label>
                                                            <input type="text" name="exact_comp_nature" id="exact_comp_nature" class="form-control" value="{{ $compDetails->exact_comp_nature}}" placeholder="Nature of Business">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Turn over in Last Year</label>
                                                            <input type="text" name="turnover_last_year" id="turnover_last_year" class="form-control"value="{{ $compDetails->turnover_last_year}}" placeholder="Turn over">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>No. of Project Done</label>
                                                            <input type="text" name="no_of_project" id="no_of_project" class="form-control" value="{{ $compDetails->no_of_project}}" placeholder="No. of Project Done">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Credit Period</label>
                                                            <input type="text" name="credit_period" id="credit_period" class="datetimepicker form-control" value="{{ $compDetails->credit_period}}" placeholder="Select Period">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Credit Limit</label>
                                                            <input type="text" name="credit_limit" id="credit_limit" class="form-control" value="{{ $compDetails->credit_limit}}" placeholder="Credit Limit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" id="cancel_busDetBtn" class="btn customer-btn-cancel">Cancel</a>
                                                <button type="submit" id="save_busDetBtn" class="btn customer-btn-save">Upload & Save</button>
                                            </div>
											</form>
                                        </div>
										
										
                                        <div class="tab-pane" id="bank" role="tabpanel">
											<form action="javascript:void(0);" name="frmbankdet" id="frmbankdet" method="post">
											@csrf
                                            <div class="message-container"></div>
                                            <div class="form-group-customer customer-additional-form">
											
												<?php  
												if(!empty($bankDetails)) { 
												$i = 1;	
														foreach($bankDetails as $bankData ) {
												?>
													<div class="containerVariant">
														<div class="row">
															<div class="billing-btn">
															<h5 class="form-title mb-0">Bank Account(s)</h5>
															<!--<a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another Bank Accounts</a>-->
															</div>
																
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Bank Name</label>
																	<input type="text" name="bank_name[]" id="" value="{{ $bankData->bank_name }}" class="form-control" placeholder="Enter Bank Name">
																</div>
															</div>
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Branch</label>
																	<input type="text" name="bank_branch[]" id="" value="{{ $bankData->bank_branch }}" class="form-control" placeholder="Enter Branch Name">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>Account Holder Name</label>
																	<input type="text" name="bank_holder_name[]" id="" value="{{ $bankData->bank_holder_name }}" class="form-control" placeholder="Enter Account Holder Name">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>Account Number</label>
																	<input type="text" name="ac_no[]" id="" value="{{ $bankData->ac_no }}" class="form-control" placeholder="Enter Account Number">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>IFSC</label>
																	<input type="text" name="ifsc_code[]" id="" value="{{ $bankData->ifsc_code }}" class="form-control" placeholder="Enter IFSC Code">
																</div>
															</div>
															<div class="col-lg-4 col-md-12 col-sm-12">
																<div class="form-group">
																	<label>UPI ID</label>
																	<input type="text" name="ac_upid[]" id="" value="{{ $bankData->ac_upid }}" class="form-control" placeholder="Enter UPI ID">
																</div>
															</div>
														</div>	
													</div>
												<?php } }?>
												
                                                <div class="containerVariant">
													<div class="row">
														<div class="billing-btn">
														<h5 class="form-title mb-0">Bank Account(s)</h5>
														</div>
															
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="form-group">
																<label>Bank Name</label>
																<input type="text" name="bank_name[]" id="" class="form-control" placeholder="Enter Bank Name">
															</div>
														</div>
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="form-group">
																<label>Branch</label>
																<input type="text" name="bank_branch[]" id="" class="form-control" placeholder="Enter Branch Name">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>Account Holder Name</label>
																<input type="text" name="bank_holder_name[]" id="" class="form-control" placeholder="Enter Account Holder Name">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>Account Number</label>
																<input type="text" name="ac_no[]" id="" class="form-control" placeholder="Enter Account Number">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>IFSC</label>
																<input type="text" name="ifsc_code[]" id="" class="form-control" placeholder="Enter IFSC Code">
															</div>
														</div>
														<div class="col-lg-4 col-md-12 col-sm-12">
															<div class="form-group">
																<label>UPI ID</label>
																<input type="text" name="ac_upid[]" id="" class="form-control" placeholder="Enter UPI ID">
															</div>
														</div>
													</div>	
                                                </div>
												<a href="javascript:void(0);" class="btn btn-primary AddMore">Add Another Bank Accounts</a>
                                            </div>
                                            <div class="add-customer-btns text-end">
												<a href="javascript:void(0);" id="cancel_bankDetBtn" class="btn customer-btn-cancel">Cancel</a>
												<button type="submit" id="save_bankDetBtn" class="btn customer-btn-save">Save Changes</button>
											</div>
											</form>
                                        </div>
										
										
                                        <div class="tab-pane" id="attachments" role="tabpanel">
											<form action="javascript:void(0);" name="frmattadet" id="frmattadet" method="post" enctype="multipart/form-data">
											@csrf
                                            <div class="message-container"></div>
                                            <div class="row">
                                                <h5 class="text-muted pb-3">Statutory Details</h5>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload GSTIN Documents</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="gst_doc" id="gst_doc">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload PAN Documents</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="pan_doc" id="pan_doc">
                                                            <div id="frames1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload TAN Document</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="tan_doc" id="tan_doc">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload CIN Document</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="cin_doc" id="cin_doc">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="text-muted py-3">Other Documents</h5>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload Logo</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="other_logo_doc" id="other_logo_doc">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload Signeture</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="signature_doc" id="signature_doc">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload Company Stamp</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file"  name="stamp_doc" id="stamp_doc">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="javascript:void(0);" id="cancel_attaBtn" class="btn customer-btn-cancel">Cancel</a>
                                                <button type="submit" id="save_attaBtn" class="btn customer-btn-save">Upload & Save</button>
                                            </div>
											</form>
                                        </div>
										
									</div>
                                </div>
                            </div>   
                        </div>
                    <!--</form>-->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsscript')
<script type="text/javascript">
$(document).ready(function(){
    $('#profile-image-uploader').change(function(){
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#name-preview').text($('#profile-image-uploader')[0].files[0].name);
                
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#image-preview').attr('src', '');
        }
    }
});
</script>
<script>
    let branchCount = 1; // Initialize branch count

function addBillingAddress(button) {
    // Clone the billing address section
    const billingAddressClone = document.querySelector('.form-group-item .col-md-6:first-child').cloneNode(true);

    // Clear the input fields in the cloned section
    const inputFields = billingAddressClone.querySelectorAll('input');
    inputFields.forEach(input => {
        input.value = '';
    });

    // Change the title to "Branch Address"
    const titleElement = billingAddressClone.querySelector('.form-title');
    titleElement.textContent = `Branch Address ${branchCount}`;

    // Change the button text to "Delete this Branch" and add the deleteBranch function
    const deleteButton = billingAddressClone.querySelector('.btn-primary');
    deleteButton.textContent = 'Delete this Branch';
    deleteButton.onclick = function () {
        deleteBranch(this);
    };

    // Insert the cloned billing address section after the shipping address section
    const shippingAddressSection = document.querySelector('.form-group-item .col-md-6:last-child');
    shippingAddressSection.parentNode.insertBefore(billingAddressClone, shippingAddressSection.nextSibling);

    // Increment the branch count
    branchCount++;
}

function deleteBranch(button) {
    // Find the parent element of the button (the cloned billing address section) and remove it
    const branchSection = button.closest('.col-md-6');
    branchSection.parentNode.removeChild(branchSection);
}




</script>
@endsection