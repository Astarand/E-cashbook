@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Add Product/Service</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
					<form action="javascript:void(0);" method="post" name="addItemFrm" id="addItemFrm" enctype="multipart/form-data">
					<input type="hidden" name="id" id="itemId" value="">
					@csrf
                    <div class="form-group-item">
                        <h5 class="form-title">Basic Details</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Choose Type<span class="text-danger"> *</span></label>
                                    <div class="align-center">
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" class="form-control" name="item_type" value="product" checked><span class="checkmark"></span> Product
                                            </label>
                                        </div>
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" name="item_type" value="service"><span class="checkmark"></span> Service
                                            </label>
                                        </div>
										<div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" name="item_type" value="manufacturing"><span class="checkmark"></span> Manufacturing
                                            </label>
                                        </div>
										<div class="form-control">
                                            <label class="custom_radio mb-0">
                                                <input type="radio" name="item_type" value="reseller"><span class="checkmark"></span> Reseller
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Item Name <span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="item_name"  id="item_name" placeholder="Enter Item Name">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#unit" style="width:100%">Select Units</button>
                            </div>
                            <!--<div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Category <span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <select class="select form-select" name="item_cat" id="item_cat" >
                                            <option value="">Select Category</option>
                                            <option value="percentage">Percentage</option>
                                            <option value="fixed">Fixed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>-->
							<div class="col-lg-6 col-md-6 col-sm-12 sac_code_sec">
                                <div class="form-group add-products">
                                    <label>SAC Code<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="sac_code" id="sac_code" placeholder="Enter SAC Code">
                                    <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                    Search SAC
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 hsn_code_sec">
                                <div class="form-group add-products">
                                    <label>HSN Code<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="hsn_code" id="hsn_code" placeholder="Enter HSN Code">
                                    <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                    Search HSN
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <li class="nav-item">
                                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        <strong>Pricing</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        <strong>Product Details</strong>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="home-b1">
													<div class="row">
                                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Billing No. <span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <div class="input-group row mb-0">
                                                                        <input type="text" class="form-control" name="item_bill_no" id="item_bill_no"  aria-label="Billing no" placeholder="Billing no.">                                                                        
                                                                    </div>
                                                                </div>																
                                                            </div>
                                                        </div>
														<div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="form-group">                                                                
																<label>Actual No. <span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <div class="input-group row mb-0">
                                                                        <input type="text" class="form-control" name="item_actual_no" id="item_actual_no"  aria-label="Actual no" placeholder="Actual no.">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
														<div class="col-lg-4 col-md-6 col-sm-12">
															<div class="form-group">
																<label>Date</label>
																<input type="Date" name="item_date" id="item_date"  class="form-control" placeholder="Enter Date">
															</div>
														</div>
													</div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Selling Price <span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <div class="input-group row mb-0">
                                                                        <input type="text" class="form-control" name="selling_price" id="selling_price" aria-label="Selling Price" placeholder="Sales Price">
                                                                        <select class="form-select" name="selling_tax" id="selling_tax" aria-label="Select Action">
                                                                            <option value="without_tax" selected>Without Tax</option>
                                                                            <option value="include_tax">Include Tax</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Discount on selling Price <span class="text-danger"> *</span></label>
                                                                <div class="form-group">
                                                                    <div class="input-group row mb-0">
                                                                        <input type="text" class="form-control" name="disc_sell" id="disc_sell" aria-label="Selling Price" placeholder="Discount">
                                                                        <select class="form-select" name="disc_sell_type" id="disc_sell_type" aria-label="Select Action">
                                                                            <option value="percentage" selected>Percentage</option>
                                                                            <option value="amount">Amount</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Wholesale Price</label>
                                                                <div class="form-group">
                                                                    <div class="input-group row mb-0">
                                                                        <input type="text" class="form-control" name="wholesale_price" id="wholesale_price" aria-label="Selling Price" placeholder="Wholesale Price">
                                                                        <select class="form-select" name="wholesale_tax" id="wholesale_tax" aria-label="Select Action">
                                                                            <option value="without_tax" selected>Without Tax</option>
                                                                            <option value="include_tax">Include Tax</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Minimum Wholesale Quantity</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="min_wholesale_quantity" id="min_wholesale_quantity" placeholder="Quantity" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" data-toggle="popover" data-placement="top" data-html="true" data-content="<h5>Popover Title</h5><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</p>">
                                                                        <i class="fa fa-info-circle"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile-b1">
                                                    <div class="form-group-item">
                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
                                                                <div class="form-group" id="summernote_container">
                                                                    <label class="form-control-label">Product Descriptions</label>
                                                                    <textarea class="summernote form-control" name="prod_desc" id="prod_desc" placeholder="Write Product Description" rows="7"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                                                                <div class="form-group">
                                                                    <label>Product Image</label>
                                                                    <div class="form-group service-upload mb-0">
                                                                        <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                                        <h6 class="drop-browse align-center">
                                                                            Drop your files here or<span class="text-primary ms-1">browse</span>
                                                                        </h6>
                                                                        <p class="text-muted">Maximum size: 50MB</p>
                                                                        <input type="file" name="prod_image[]" multiple id="prod_image" >
                                                                        <div id="frames"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Purchase Price <span class="text-danger"> *</span></label>
                                                    <div class="form-group">
                                                        <div class="input-group row mb-0">
                                                            <input type="text" class="form-control" name="purchase_price" id="purchase_price" aria-label="Selling Price" placeholder="Purchase Price">
                                                            <select class="form-select" name="purchase_tax" id="purchase_tax" aria-label="Select Action">
                                                                <option value="without_tax" selected>Without Tax</option>
                                                                <option value="include_tax">Include Tax</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label>Tax</label>
                                                <div class="form-group">
                                                    <select class="select form-select" name="item_tax" id="item_tax">
                                                        <option value="">Select Tax</option>
                                                        <option value="IVA">IVA - (21%)</option>
                                                        <option value="IRPF">IRPF - (-15%)</option>
                                                        <option value="PDV">PDV - (20%)</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
						
						<div class="message-container"></div>
						<div id="addItemLoader" class="loader"></div>
						<div class="add-customer-btns text-end">
                            <a href="{{ url('/items') }}" class="btn customer-btn-cancel">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </div>
                    </div>
						 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="unit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
			<form action="javascript:void(0);" method="post" name="baseUnitFrm" id="baseUnitFrm">
			@csrf
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Base Unit</label>
                        <div class="form-group">
                            <select class="select form-select" name="base_unit" id="base_unit">
                                <option value="">None</option>
                                <option value="bags">BAGS (Bag)</option>
                                <option value="bottle">BOTTLES (Bottle)</option>
                                <option value="box">BOXS (Box)</option>
                                <option value="can">CANS (Can)</option>
                                <option value="ctn">CARTONS (Ctn)</option>
                                <option value="dzn">DOZENS (Dzn)</option>
                                <option value="grm">GRAMMES (Gm)</option>
                                <option value="kg">KILOGRAMMES (Kg)</option>
                                <option value="ltr">LITER (Ltr)</option>
                                <option value="mtr">METERS (Mtr)</option>
                                <option value="ml">MILILITER (Ml)</option>
                                <option value="nos">NUMBERS (Nos)</option>
                                <option value="pack">PACKS (Pac)</option>
                                <option value="pair">PAIRS (Prs)</option>
                                <option value="pcs">PIECES (Pcs)</option>
                                <option value="qtl">QUINTAL (Qtl)</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Secondary Unit</label>
                        <div class="form-group">
                            <select class="select form-select" name="sec_unit" id="sec_unit">
                                <option value="">None</option>
                                <option value="IVA">IVA - (21%)</option>
                                <option value="IRPF">IRPF - (-15%)</option>
                                <option value="PDV">PDV - (20%)</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12" id="baseUnitOther">
                        <label>Other</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="base_unit_other" id="base_unit_other" >
                        </div>
                    </div>
				</div>
            </div>
            <div class="modal-footer">
                
                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Save</button>
                
            </div>
			</form>
        </div>
    </div>
</div>

@endsection