@extends('layouts.default')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="content-page-header">
                    <h5>Add Expenses</h5>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
					<form  action="javascript:void(0);" method="POST" name="addExpenseFrm" id="addExpenseFrm">
                        <input type="hidden" name="id" id="eId" value="">
                        @csrf
                    <div class="form-group-item">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="Date" name="expense_date" id="expense_date" class="form-control" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Purpose Of Expenses</label>
                                    <input type="text" name="pur_of_expense" id="pur_of_expense" class="form-control" placeholder="Enter Purpose Of Expenses">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Mode of Expenses</label>
                                    <div class="form-group">
                                        <select class="form-select" name="mode_of_expense" id="mode_of_expense">
                                            <option value="">Select</option>
                                            <option value="NEFT">NEFT</option>
                                            <option value="IMPS">IMPS</option>
                                            <option value="RTGS">RTGS</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Demand Draft">Demand Draft</option>
                                            <option value="Pay Order">Pay Order</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Cash">Cash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Expenses Category</label>
                                <div class="form-group">
                                    <select class="form-select" name="expense_cat"  id="expense_cat" onchange="getExpenseOptions(this);">
                                        <option value="">Select</option>
                                        <option value="personnel">Personnel Costs</option>
                                        <option value="cogs">Cost of Goods Sold (COGS)</option>
                                        <option value="operating">Operating Expenses</option>
                                        <option value="taxes">Taxes</option>
                                        <option value="interest">Interest Expenses</option>
                                        <option value="misc">Miscellaneous</option>
                                        <option value="other">Other Income/Revenues</option>
                                    </select>
                                </div>
                            </div>
							
							<div class="col-lg-4 col-md-6 col-sm-12">
								<label>Expenses Type</label>						
								<select class="form-control select-style" name="expense_type" id="expense_type">
									<option value="">Select</option>
									
								</select>
							</div>
                            <!--<div class="col-lg-4 col-md-6 col-sm-12">
                                <label>Expenses Type</label>
                                <div class="form-group" id="personnel-expenses" style="display: none;">
                                    <select class="form-select" name="expense_type">
                                        <option value="Personnel Costs">Personnel Costs</option>
                                        <option value="Salaries and Wages">Salaries and Wages</option>
                                        <option value="Employee Benefits">Employee Benefits</option>
                                        <option value="Payroll Taxes">Payroll Taxes</option>
                                    </select>
                                </div>
                                <div class="form-group" id="cogs-expenses" style="display: none;">
                                    <select class="form-select" name="expense_type">
                                        <option value="COGS">Cost of Goods Sold (COGS)</option>
                                        <option value="Raw Materials">Raw Materials</option>
                                        <option value="Manufacturing Labor">Manufacturing Labor</option>
                                        <option value="Manufacturing Supplies">Manufacturing Supplies</option>
                                    </select>
                                </div>
                                <div class="form-group" id="operating-expenses" style="display: none;">
                                    <select class="form-select" name="expense_type">
                                        <option value="Operating Expenses">Operating Expenses</option>
                                        <option value="Rent">Rent</option>
                                        <option value="Utilities">Utilities</option>
                                        <option value="Insurance">Insurance</option>
                                        <option value="Legal and Professional Fees">Legal and Professional Fees</option>
                                        <option value="Advertising and Marketing">Advertising and Marketing</option>
                                        <option value="Repairs and Maintenance">Repairs and Maintenance</option>
                                        <option value="Depreciation">Depreciation</option>
                                        <option value="Property Taxes">Property Taxes</option>
                                        <option value="Office Supplies">Office Supplies</option>
                                        <option value="Postage and Shipping">Postage and Shipping</option>
                                        <option value="Telephone and Internet">Telephone and Internet</option>
                                        <option value="Travel and Entertainment">Travel and Entertainment</option>
                                        <option value="Training and Development">Training and Development</option>
                                        <option value="Office Rent and Equipment Leases">Office Rent and Equipment Leases</option>
                                        <option value="Vehicle Expenses">Vehicle Expenses</option>
                                        <option value="Bank Charges and Interest">Bank Charges and Interest</option>
                                        <option value="Security Expenses">Security Expenses</option>
                                        <option value="Employee Benefits">Employee Benefits</option>
                                        <option value="Administrative Software">Administrative Software</option>
                                        <option value="Membership Dues and Subscriptions">Membership Dues and Subscriptions</option>
                                        <option value="Miscellaneous General Expenses">Miscellaneous General Expenses</option>
                                    </select>
                                </div>
                                <div class="form-group" id="taxes-expenses" style="display: none;">
                                    <select class="form-select" name="expense_type">
                                        <option value="Taxes">Taxes</option>
                                        <option value="Income Taxes">Income Taxes</option>
                                        <option value="Sales Tax">Sales Tax</option>
                                        <option value="Property Tax">Property Tax</option>
                                        <option value="Other Taxes">Other Taxes</option>
                                    </select>
                                </div>
                                <div class="form-group" id="interest-expenses" style="display: none;">
                                    <input type="text" name="expense_type_interest" id="expense_type_interest" class="form-control" placeholder="Enter Interest Expenses Type">
                                </div>
                                <div class="form-group" id="miscellaneous-expenses" style="display: none;">
                                    <select class="form-select"  name="expense_type">
                                        <option value="Miscellaneous">Miscellaneous</option>
                                        <option value="Bad Debts">Bad Debts</option>
                                        <option value="Donations">Donations</option>
                                        <option value="Currency Exchange Loss/Gain">Currency Exchange Loss/Gain</option>
                                        <option value="Impairment Charges">Impairment Charges</option>
                                        <option value="Other Unusual Expenses">Other Unusual Expenses</option>
                                    </select>
                                </div>
                                <div class="form-group" id="other-revenues" style="display: none;">
                                    <select class="form-select" name="expense_type">
                                        <option value="Other Income/Revenues">Other Income/Revenues</option>
                                        <option value="Interest Income">Interest Income</option>
                                        <option value="Dividends">Dividends</option>
                                        <option value="Rental Income">Rental Income</option>
                                        <option value="Miscellaneous Income">Miscellaneous Income</option>
                                    </select>
                                </div>
                            </div>-->
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text"  name="expense_amt" id="expense_amt" class="form-control" placeholder="Enter Expense Amount">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <input type="text" name="expense_msg" id="expense_msg" class="form-control" placeholder="Enter Message">
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="message-container"></div>
					<div id="expenseLoader" class="loader"></div>
                    <div class="add-customer-btns text-end">
                        <a href="{{ url('/expenses') }}" class="btn customer-btn-cancel">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
                    </div>
					</form>
                </div>
            </div>
        </div>
    </div>
@endsection
