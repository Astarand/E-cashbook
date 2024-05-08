@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Create Sales Invoice</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-A" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Basic Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-B" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Item Details</a>
                        </li>
                    </ul>
                    <div class="tab-content">
						
                        <div class="tab-pane active" id="info" role="tabpanel">
							<form action="javascript:void(0);" method="post" name="addSalesFrm" id="addSalesFrm" enctype="multipart/form-data">
							<input type="hidden" name="id" id="sId" value="">
							@csrf
                            <div class="form-group-item">
                                <h5 class="form-title">Basic Details</h5>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Invoice Number</label>
                                            <input type="text" class="form-control" name="inv_num" id="inv_num" value="{{ $invoiceNo }}" placeholder="Invoice Number" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                         <div class="form-group">
                                            <label>Customer Name</label>
                                                <select class="form-control select-style" name="inv_name" id="inv_name">
												<option value="">Select Customer</option>
													@foreach($custData as $k=>$cust)
														<option value="{{ $cust->id }}" >{{ $cust->cust_name }}</option>
														@endforeach
												</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group add-products">
                                                    <label>Company GST Registered</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="gst_reg" id="gst_reg">
                                                            <option value="">Select</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Company Type</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="comp_type" id="comp_type">
                                                            <option value="">Select</option>
                                                            <option value="Proprietorship">Proprietorship</option>
                                                            <option value="Partnership">Partnership</option>
                                                            <option value="One person Company (OPC)">One person Company (OPC)</option>
                                                            <option value="LLP Company">LLP Company</option>
                                                            <option value="PVT Ltd Company">PVT Ltd Company</option>
                                                            <option value="LTD Company">LTD Company</option>
                                                            <option value="Section-8 Company">Section-8 Company</option>
                                                            <option value="Society/Trust">Society/Trust</option>
                                                            <option value="Other">Other</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>PAN Number</label>
                                        <input type="text" name="cust_pan" id="cust_pan" class="form-control" placeholder="Enter PAN Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>GSTIN</label>
                                        <input type="text" name="cust_gst_no" id="cust_gst_no" class="form-control" placeholder="Enter GSTIN Number">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <label>GST Type</label>
                                    <div class="form-group">
                                        <select class="form-select" name="cust_gst_type" id="cust_gst_type">
                                            <option value="">Select</option>
                                            <option value="Registered">Registered</option>
                                            <option value="Unregistered">Unregistered </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="cust_email" id="cust_email" class="form-control" placeholder="Enter Email Address">
                                    </div>
                                </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" name="contact_no" id="contact_no" value="{{ $comp_phone }}" placeholder="Enter Contact Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch Name</label>
                                            <input type="text" class="form-control"  name="branch_name" id="branch_name" placeholder="Enter Branch">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Transaction Type</label>
                                        <div class="form-group">
                                            <select class="form-select"  name="trans_type" id="trans_type">
                                                <option value="">Select</option>
                                                <option value="B2B">B2B</option>
                                                <option value="B2C">B2C</option>
                                                <option value="CEZ">CEZ</option>
                                                <option value="Deemed Export">Deemed Export</option>
                                                <option value="Export">Export</option>                                         
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Tax Nature</label>
                                        <div class="form-group">
                                            <select class="form-select" name="tax_nature" id="tax_nature">
                                                <option value="">Select</option>
                                                <option value="With Tax">With TAX</option>
                                                <option value="Without Tax">Without TAX</option>
                                                <option value="RCM">RCM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Tax Applicable</label>
                                        <div class="form-group">
                                            <select class="form-select" name="tax_applicable" id="tax_applicable">
                                                <option value="">Select</option>
                                                <option value="TDS">TDS</option>
                                                <option value="TCS">TCS</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="nav nav-tabs nav-bordered">
                                        <li class="nav-item">
                                            <a href="#billing_details" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                <strong>Billing Details</strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#address" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                <strong>Billing Address</strong>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="billing_details">
                                            <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Contact Person name</label>
                                                        <input type="text" class="form-control"  name="cont_per_name" id="cont_per_name">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input type="text" class="form-control"  name="cont_num" id="cont_num">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Branch</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="branch" id="branch">
                                                            <option value="">Branch</option>
                                                            <option value="Kolkata">Kolkata</option>
                                                            <option value="Barrackpore">Barrackpore</option>
                                                            <option value="Barasat">Barasat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Bill to the party</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="bill_to_party" id="bill_to_party">
                                                            <option value="">select</option>
															<option value="1">Loans & Advances to Other</option>
                                                            <option value="2">Advance Income Tax</option>
                                                            <option value="3">Secured Loan from Other</option>
                                                            <option value="4">Service Tax Receivable</option>
                                                            <option value="5">Sundry Creditors for Expenses</option>
                                                            <option value="6">Sundry Creditors for Goods</option>
                                                            <option value="7">Sundry Creditors for Services</option>
                                                            <option value="8">Telephone Deposit</option>
                                                            <option value="9">Unsecured Loan from Bank</option>
                                                            <option value="10">Unsecured Loan From Others</option>
                                                            <option value="11">Unsecured Loan from Relative</option>
                                                            <option value="12">VAT Receivable</option>
                                                            <option value="13">Bank Account</option>
                                                            <option value="14">Advance Received from Customer</option>
                                                            <option value="15">Advance to Staff</option>
                                                            <option value="16">Advance to Vendor</option>
                                                            <option value="17">Loans & Advances to Related Party</option>
                                                            <option value="18">Machinery Loan from Bank</option>
                                                            <option value="19">Other Bank Loan</option>
                                                            <option value="20">Car Loan From Bank</option>
                                                            <option value="21">Cash Credit/ Overdraft/ Credit Cards</option>
                                                            <option value="22">Cash on Hand</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Ship To Party</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="ship_to_party" id="ship_to_party">
                                                            <option value="">select</option>
                                                            <option value="1">Loans & Advances to Other</option>
                                                            <option value="2">Advance Income Tax</option>
                                                            <option value="3">Secured Loan from Other</option>
                                                            <option value="4">Service Tax Receivable</option>
                                                            <option value="5">Sundry Creditors for Expenses</option>
                                                            <option value="6">Sundry Creditors for Goods</option>
                                                            <option value="7">Sundry Creditors for Services</option>
                                                            <option value="8">Telephone Deposit</option>
                                                            <option value="9">Unsecured Loan from Bank</option>
                                                            <option value="10">Unsecured Loan From Others</option>
                                                            <option value="11">Unsecured Loan from Relative</option>
                                                            <option value="12">VAT Receivable</option>
                                                            <option value="13">Bank Account</option>
                                                            <option value="14">Advance Received from Customer</option>
                                                            <option value="15">Advance to Staff</option>
                                                            <option value="16">Advance to Vendor</option>
                                                            <option value="17">Loans & Advances to Related Party</option>
                                                            <option value="18">Machinery Loan from Bank</option>
                                                            <option value="19">Other Bank Loan</option>
                                                            <option value="20">Car Loan From Bank</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
											<div class="row">
												<div class="col-lg-4 col-md-6 col-sm-12">
													<label>Transportation Type</label>
													<div class="form-group">
														<select class="form-select" name="transport_type" id="transport_type" >
															<option value="">--select--</option>
															<option value="Road Transportation">Road Transportation</option>
															<option value="Rail Transportation">Rail Transportation</option>
															<option value="Air Transportation">Air Transportation</option>
															<option value="Sea Transportation">Sea Transportation</option>
															<option value="Multi model Transportation">Multi model Transportation</option>
															<option value="Parcel & Courier Service">Parcel & Courier Service</option>
															<option value="By Hand">By Hand</option>
															<option value="Other">Other</option>
														</select>
													</div>
												</div>
												
												<div class="col-lg-4 col-md-6 col-sm-12" id="transportTypeOther">
													<div class="form-group">
														<label>Other Transportation</label>
														<textarea class="form-control" name="transport_type_other" id="transport_type_other"></textarea>
													
													</div>
												</div>

											</div>
                                        </div>
                                        <div class="tab-pane" id="address">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="billing-btn mb-2">
                                                        <h5 class="form-title">Billing Address</h5>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="bill_name" id="bill_name" class="form-control" placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" name="bill_addone" id="bill_addone" class="form-control" placeholder="Enter Address 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" name="bill_addtwo" id="bill_addtwo" class="form-control" placeholder="Enter Address 2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select class="form-control select-style" name="bill_country" id="country" onChange="changeCountry(this);">
																	<option value="">Select Country</option>
																	@foreach($countries as $k=>$country)
																	<option value="{{ $country->id }}" >{{ $country->name }}</option>
																	@endforeach
																</select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <select class="form-control select-style" name="bill_city" id="city">
																	<option value="">Select City</option>
																	@foreach($cities_bill as $k=>$city)
																		<option value="{{ $city->id }}" >{{ $city->name }}</option>
																	@endforeach
																</select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <select class="form-control select-style" name="bill_state" id="state" onChange="changeState(this);">
																	<option value="">Select State</option>
																	@foreach($states_bill as $k=>$state)
																		<option value="{{ $state->id }}" >{{ $state->name }}</option>
																	@endforeach
																</select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pincode</label>
                                                                <input type="text" name="bill_pin" id="bill_pin" class="form-control" placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="billing-btn mb-2">
                                                        <h5 class="form-title">Shipping Address</h5>
														<a href="javascript:void(0);" onclick="sameAsBillAddrSales()" class="btn btn-primary">Same as Billing Address</a>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" name="ship_name" id="ship_name" class="form-control" placeholder="Enter Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" name="ship_addone" id="ship_addone" class="form-control" placeholder="Enter Address 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" name="ship_addtwo" id="ship_addtwo" class="form-control" placeholder="Enter Address 2">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>Country</label>
                                                                <select class="form-control select-style" name="ship_country" id="country_ship" onChange="changeCountry_ship(this);">
																	<option value="">Select Country</option>
																	@foreach($countries as $k=>$country)
																	<option value="{{ $country->id }}">{{ $country->name }}</option>
																	@endforeach
																</select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <select class="form-control select-style" name="ship_city" id="city_ship">
																	<option value="">Select City</option>
																	@foreach($cities_ship as $k=>$city)
																		<option value="{{ $city->id }}">{{ $city->name }}</option>
																	@endforeach
																</select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <select class="form-control select-style" name="ship_state" id="state_ship" onChange="changeState_ship(this);">
																	<option value="">Select State</option>
																	@foreach($states_ship as $k=>$state)
																		<option value="{{ $state->id }}">{{ $state->name }}</option>
																	@endforeach
																</select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Pincode</label>
                                                                <input type="text" name="ship_pin" id="ship_pin" class="form-control" placeholder="Enter Pincode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="message-container"></div>
							<div id="addSalesLoader" class="loader"></div>
							<div class="add-customer-btns text-end">
								<a href="{{ url('/sales-invoice') }}" class="btn btn-primary cancel me-2">Cancel</a>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
							</form>
                        </div>

                        <div class="tab-pane" id="details" role="tabpanel">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Products</label>
                                        <div class="form-group">
                                            <ul class="form-group-plus css-equal-heights" data-select2-id="21">
                                                <li data-select2-id="20">
                                                    <div class="form-group">
                                                        <select class="form-select select2-hidden-accessible" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                            <option data-select2-id="6">Select Product</option>
                                                            <option data-select2-id="32">Product 1</option>
                                                            <option data-select2-id="33">Product 2</option>
                                                            <option data-select2-id="34">Product 3</option>
                                                        </select>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="btn btn-primary form-plus-btn" href="#" onclick="addForm(this);"><i class="fas fa-plus-circle"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Discount Type</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option  value="">Select</option>
                                                    <option  value="">Percentage(%)</option>
                                                    <option  value="">Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Discount %</label>
                                            <input type="text" class="form-control" placeholder="Enter Discount">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Tax</label>
                                        <div class="form-group">
                                            <select class="form-select">
                                                <option  value="">Select</option>
                                                <option  value="">SGST</option>
                                                <option  value="">IGST</option>
                                                <option  value="">Both</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-item">
                                <div class="card-table">
                                    <div class="card-body">
                                        <div class="table-responsive no-pagination">
                                            <table class="table table-center table-hover datatable">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Product / Service</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Rate</th>
                                                    <th>Discount</th>
                                                    <th>Tax</th>
                                                    <th>Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>Lorem ipsum dolor sit amet</td>
                                                    <td><input type="number" class="form-control" value="0"></td>
                                                    <td>Pcs</td>
                                                    <td><input type="number" class="form-control" value="120"></td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>$120.00</td>
                                                    <td class="d-flex align-items-center">
                                                        <a href="#" class="btn-action-icon me-2" data-bs-toggle="modal" data-bs-target="#add_discount"><span><i class="fe fe-edit"></i></span></a>
                                                        <a href="#" class="btn-action-icon" data-bs-toggle="modal" data-bs-target="#delete_discount"><span><i class="fe fe-trash-2"></i></span></a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="form-group-bank">
                                        <div class="invoice-total-box">
                                            <div class="invoice-total-inner">
                                                <p>Taxable Amount <span>$120.00</span></p>
                                                <p>Discount <span>$13.20</span></p>
                                                <p>Vat <span>$0.00</span></p>
                                                <div class="status-toggle justify-content-between">
                                                    <div class="d-flex align-center">
                                                        <p>Round Off </p>
                                                        <input id="rating_1" class="check" type="checkbox" checked>
                                                        <label for="rating_1" class="checktoggle checkbox-bg">checkbox</label>
                                                    </div>
                                                    <span>$0.00</span>
                                                </div>
                                            </div>
                                            <div class="invoice-total-footer">
                                                <h4>Total Amount <span>$107.80</span></h4>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label>Signature Image</label>
                                            <div class="form-group service-upload service-upload-info mb-0">
                                                <span><i class="fe fe-upload-cloud me-1"></i>Upload Signature</span>
                                                <input type="file" multiple id="image_sign">
                                                <div id="frames"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Signature Name</label>
                                            <input type="text" class="form-control" placeholder="Enter Signature Name">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                                <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                <a href="customers.html" class="btn customer-btn-save">Save Chnages</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="add_discount" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div class="form-header modal-header-title text-start mb-0 align-center">
                        <h4 class="mb-0">Add Tax & Discount</h4>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span class="align-center" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="number" class="form-control" placeholder="120">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Discount Amount</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group mb-0">
                                <label>GST</label>
                                <select class="form-select">
                                    <option>N/A</option>
                                    <option>CGST</option>
                                    <option>SGST</option>
                                    <option>BOTH</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer add-tax-btns">
                    <button type="reset" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
                    <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_discount" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header border-0 justify-content-center pb-0">
                    <div class="form-header modal-header-title text-center mb-0">
                        <h4 class="mb-2">Delete Product / Services</h4>
                        <p>Are you sure want to delete?</p>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
