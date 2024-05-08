@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
       
        <div class="page-header">
            <div class="content-page-header">
                <h5>Add Vendor</h5>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="javascript:void(0);" id="tab-A" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Basic Details</a>

                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="javascript:void(0);" id="tab-B" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Billing Details</a>

                    </li>
                    <li class="nav-item" role="presentation">
                    <a href="javascript:void(0);" id="tab-C" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">Bank Details</a>
                    </li>
                </ul>
                @if (Session::has('errors'))
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<h4 class="alert-heading">Error!</h4>
						<p>
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</p>
					</div>
				@endif
                <div class="tab-content">
                <div class="tab-pane active" id="info" role="tabpanel">
                    <form  action="javascript:void(0);" method="POST" name="add_vendor_detail" id="add_vendor_detail">
                        <input type="hidden" name="id" id="vendorId" value="">
                        @csrf
                                         
                            <div class="form-group-item">
                                <h5 class="form-title">Basic Details</h5>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Vendor Priroty</label>
                                            <div class="align-center">
                                                <div class="form-control me-3">
                                                    <label class="custom_radio me-3 mb-0">
                                                        <input type="radio" class="form-control vendor_priority" name="vendor_priority" checked value="1"><span class="checkmark"></span> High Valued
                                                    </label>
                                                </div>
                                                <div class="form-control">
                                                    <label class="custom_radio mb-0">
                                                        <input type="radio" class="form-control" name="vendor_priority" value="2"><span class="checkmark"></span> Less Valued
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="vendor_name" id="vendor_name" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>PAN Number</label>
                                            <input type="text" class="form-control" name="vendor_pan" id="vendor_pan" placeholder="Enter PAN Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>GSTIN</label>
                                            <input type="text" class="form-control" name="vendor_gstin" id="vendor_gstin" placeholder="Enter GSTIN Number">
                                        </div>
                                    </div> 
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>GST Type</label>
                                        <div class="form-group">
                                            <select class="form-select" name="vendor_gst_type" id="vendor_gst_type">
                                                <option value="">Select</option>
                                                <option value="Registered">Registered</option>
                                                <option value="Unregistered">Unregistered</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="vendor_email" id="vendor_email" placeholder="Enter Email Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="vendor_phone" id="vendor_phone" class="form-control" placeholder="Phone Number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="billing-btn">
                                            <h5 class="form-title mb-0">Contact Person Details</h5>
                                            <a href="javascript:void(0);" onclick="vansameAsAbove()" class="btn btn-primary">Same as Above</a>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Person Name</label>
                                                    <input type="text" class="form-control" name="cont_per_name" id="cont_per_name" placeholder="Enter Name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control" name="cont_per_number" id="cont_per_number" placeholder="Enter Contact Number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>E-Mail</label>
                                                    <input type="text" class="form-control" name="cont_per_email" id="cont_per_email"  placeholder="Enter E-Mail">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Special Note</label>
                                                    <input type="text" class="form-control" name="special_note" id="special_note" placeholder="Write a Special Note about Contact Person">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                            <a href="{{ url('/vendors') }}" class="btn customer-btn-cancel" id="prevBtnOne">Cancel</a>
                            <a href="javascript:void(0);" class="btn customer-btn-save" id="nxtBtnVOne">Next</a>
                        </div>
                        </form>
                        </div>

                        <div class="tab-pane" id="details" role="tabpanel">
                        <form action="javascript:void(0);" method="post" name="add_vendor_bill" id="add_vendor_bill">
                        @csrf   
                        <div class="form-group-item">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="billing-btn mb-2">
                                            <h5 class="form-title">Billing Address</h5>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="billing_name" id="billing_name" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="billing_address1" id="billing_address1" placeholder="Enter Address 1">
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="billing_address2" id="billing_address2" placeholder="Enter Address 2">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control select-style" name="billing_country" id="country" onChange="changeCountry(this);">
													<option value="">Select Country</option>
													@foreach($countries as $k=>$country)
													<option value="{{ $country->id }}">{{ $country->name }}</option>
													@endforeach
												</select>
                                                </div>
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select class="form-control select-style" name="billing_city" id="city">
													<option value="">Select City</option>
												</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control select-style" name="billing_state" id="state" onChange="changeState(this);">
													<option value="">Select State</option>
													
												</select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" name="billing_pincode" id="billing_pincode" placeholder="Enter Pincode">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="billing-btn">
                                            <h5 class="form-title mb-0">Shipping Address</h5>
                                            <button type="button" class="btn btn-primary" onclick="copVenbillAddr()"  id="ship-copy-from-bill">Copy from Billing</button>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="shipping_name" id="shipping_name" placeholder="Enter Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" class="form-control" name="shipping_address1" id="shipping_address1" placeholder="Enter Address 1">
                                        </div>
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" class="form-control" name="shipping_address2" id="shipping_address2" placeholder="Enter Address 2">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control select-style" name="shipping_country" id="country_ship" onChange="changeCountry_ship(this);">
													<option value="">Select Country</option>
													@foreach($countries as $k=>$country)
													<option value="{{ $country->id }}">{{ $country->name }}</option>
													@endforeach
												</select>
                                                </div>
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select class="form-control select-style" name="shipping_city" id="city_ship">
													<option value="">Select City</option>
													
												</select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control select-style" name="shipping_state" id="state_ship" onChange="changeState_ship(this);">
													<option value="">Select State</option>
													
												</select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" name="shipping_pincode" id="shipping_pincode" placeholder="Enter Pincode">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                            <a href="javascript:void(0);" id="prevBtnTwo" class="btn customer-btn-cancel">Previous</a>
                            <a href="javascript:void(0);" id="nxtBtnVTwo" class="btn customer-btn-save">Next</a>
                        </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="bank" role="tabpanel">
                        <form action="javascript:void(0);" method="post" name="add_vendor_bank" id="add_vendor_bank">
                        @csrf
                            <div class="form-group-customer customer-additional-form">
                                <div class="row bank-row">
                                    <div class="billing-btn">
                                        <h5 class="form-title mb-0">Bank Account(s)</h5>
                                        <button type="button" id="add-another-bank" class="btn btn-primary">Add Another Bank Accounts</button>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name[]" id="bank_name1" placeholder="Enter Bank Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input type="text" class="form-control" name="bank_branch[]" id="bank_branch1" placeholder="Enter Branch Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Account Holder Name</label>
                                            <input type="text" class="form-control" name="acc_holder_name[]" id="acc_holder_name1" placeholder="Enter Account Holder Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="text" class="form-control" name="acc_number[]" id="acc_number1" placeholder="Enter Account Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>IFSC</label>
                                            <input type="text" class="form-control" name="acc_ifsc[]" id="acc_ifsc1" placeholder="Enter IFSC Code">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>UPI ID</label>
                                            <input type="text" class="form-control" name="acc_upi_id[]" id="acc_upi_id1" placeholder="Enter UPI ID">
                                        </div>
                                    </div>
                                    <hr class="hr" />
                                </div>
                            </div>
                            <div class="add-customer-btns text-end">
                                <a href="javascript:void(0);" id="prevBtnThree" class="btn customer-btn-cancel">Previous</a>
                                <button type="submit" id="nxtBtnVThree" class="btn customer-btn-save">Save Changes</button>
                        </div>
						<div id="addCustomerLoader" class="loader"></div>
						<div class="message-container"></div>
                                </form>
                        </div>
                    </div>
               
            </div>
        </div> 
    </div>
</div>
@endsection
