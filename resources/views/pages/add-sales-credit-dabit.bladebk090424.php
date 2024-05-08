@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add Sales Credit Debit Note</h5>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-A" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Basic Details</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="javascript:void(0);" id="tab-B"  data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Item Details</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info" role="tabpanel">
							<form action="javascript:void(0);" method="post" name="salesCreditDebitFrm" id="salesCreditDebitFrm" enctype="multipart/form-data">
							<input type="hidden" name="id" id="sId" value="">
							@csrf
                            <div class="form-group-item">
                                <h5 class="form-title">Basic Details</h5>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Voucher Number</label>
                                            <input type="text" class="form-control" name="v_num" id="v_num" value="{{ $vNo }}" placeholder="Voucher Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                         <div class="form-group">
                                            <label>Customer Name</label>
                                                <select class="form-control select-style" name="v_name" id="v_name">
												<option value="">Select Customer</option>
													@foreach($custData as $k=>$cust)
														<option value="{{ $cust->id }}" >{{ $cust->cust_name }}</option>
														@endforeach
												</select>
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
                                            <input type="text" class="form-control" name="branch_name" id="branch_name" placeholder="Enter Branch">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Note Type</label>
                                        <div class="form-group">
                                            <select class="form-select" name="note_type" id="note_type">
                                                <option value="">Select</option>
                                                <option value="Credit">Credit</option>
                                                <option value="Debit">Debit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label>Reason Of Return</label>
                                        <div class="form-group">
                                            <select class="form-select" name="return_reason" id="return_reason">
                                                <option value="">Select Reason</option>
                                                <option value="1">Credit-Debit Note issued against Sales</option>
                                                <option value="2">Change in POS</option>
                                                <option value="3">Post Sales Discount</option>
                                                <option value="4">Finalization of Provisional assessment</option>
                                                <option value="5">Deficiency in service</option>
                                                <option value="6">Correction in Invoice / Challan</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-lg-4 col-md-6 col-sm-12" id="returnReasonOther">
										<div class="form-group">
											<label>Other Reason</label>
											<textarea class="form-control" name="return_reason_other" id="return_reason_other"></textarea>
										
										</div>
									</div>
                                </div>
								
								
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <ul class="nav nav-tabs nav-bordered">
                                        <li class="nav-item">
                                            <a href="#order_details" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                <strong>Order Details</strong>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#voucher_details" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                <strong>Voucher Details</strong>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="order_details">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Purchase Order No.</label>
                                                        <input type="text" class="form-control" name="purchase_no" id="purchase_no" placeholder="Enter Purchase Order No">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Purchase Order Date</label>
                                                        <input type="Date" class="form-control" name="purchase_date" id="purchase_date" placeholder="Purchase Order Date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Sales Order No.</label>
                                                        <input type="text" class="form-control" name="sales_no" id="sales_no" placeholder="Enter Sales Order No">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Sales Order Date</label>
                                                        <input type="Date" class="form-control" name="sales_date" id="sales_date" placeholder="Sales Order Date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Document No.</label>
                                                        <input type="text" class="form-control" name="doc_no" id="doc_no" placeholder="Enter Document No">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Document Date</label>
                                                        <input type="Date" class="form-control" name="doc_date" id="doc_date" placeholder="Document Date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Challan No.</label>
                                                        <input type="text" class="form-control" name="challan_no" id="challan_no" placeholder="Enter Challan No">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Challan Date</label>
                                                        <input type="Date" class="form-control" name="challan_date" id="challan_date" placeholder="Challan Date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="voucher_details">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Date</label>
                                                        <input type="Date" name="v_date" id="v_date" class="form-control" placeholder="Date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Due Date</label>
                                                        <input type="Date" name="v_due_date" id="v_due_date" class="form-control" placeholder="Due Date">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Voucher No.</label>
                                                        <input type="text" name="v_no" id="v_no" class="form-control" placeholder="Voucher No">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Transaction Type *</label>
                                                    <div class="form-group">
                                                        <select class="form-select"  name="trans_type" id="trans_type">
															<option value="">Select</option>
															<option value="B2B">B2B</option>
															<option value="B2C">B2C</option>
															<option value="Export">Export</option>
															<option value="CEZ">CEZ</option>
															<option value="Deemed Export">Deemed Export</option>
														</select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <label>Tax Nature</label>
                                                    <div class="form-group">
                                                        <select class="form-select" name="tax_nature" id="tax_nature">
															<option value="">Select</option>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="message-container"></div>
							<div id="addSalesLoader" class="loader"></div>
                            <div class="add-customer-btns text-end">
                                <a href="{{ url('/sales-credit-debit') }}" class="btn btn-primary cancel me-2">Cancel</a>
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
                                    <!--<div class="col-lg-4">
                                        <label>Discount Type</label>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <select class="form-select">
                                                    <option data-select2-id="6">Select</option>
                                                    <option data-select2-id="32">Percentage(%)</option>
                                                    <option data-select2-id="33">Fixed</option>
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
                                                <option data-select2-id="6">Select</option>
                                                <option data-select2-id="32">SGST</option>
                                                <option data-select2-id="33">IGST</option>
                                                <option data-select2-id="33">Both</option>
                                            </select>
                                        </div>
                                    </div>-->
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
                                                    <td><input type="text" class="form-control" value="0"></td>
                                                    <td>Pcs</td>
                                                    <td><input type="text" class="form-control" value="120"></td>
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
                                                <input type="file" name="signature" id="signature" >
                                                <div id="frames"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Signature Name</label>
                                            <input type="text" name="signature_name" id="signature_name" class="form-control" placeholder="Enter Signature Name">
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
                                <input type="text" class="form-control" placeholder="120">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <label>Discount Amount</label>
                                <input type="text" class="form-control" placeholder="0">
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

