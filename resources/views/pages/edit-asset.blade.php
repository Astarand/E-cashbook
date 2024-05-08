@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="content-page-header">
                <h5>Edit Asset</h5>
            </div>
        </div>

        <div class="card">
			<form action="javascript:void(0);" method="post" name="addAssetFrm" id="addAssetFrm" enctype="multipart/form-data">
			<input type="hidden" name="id" id="assetId" value="{{ $asset->id }}">
			@csrf
            <div class="card-body">
                <div class="form-group-item">
                    <h5 class="form-title">Basic Details</h5>
                    <div class="row">
{{--                        <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                            <div class="form-group">--}}
{{--                                <label>Vendor Priroty</label>--}}
{{--                                <div class="align-center">--}}
{{--                                    <div class="form-control me-3">--}}
{{--                                        <label class="custom_radio me-3 mb-0">--}}
{{--                                            <input type="radio" class="form-control" name="value" checked><span class="checkmark"></span> High Valued--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-control">--}}
{{--                                        <label class="custom_radio mb-0">--}}
{{--                                            <input type="radio" name="value"><span class="checkmark"></span> Less Valued--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Asset Name</label>
                                <input type="text" class="form-control" name="asset_name" id="asset_name" value="{{ $asset->asset_name }}" placeholder="Enter Asset Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" id="branch_name" value="{{ $asset->branch_name }}" placeholder="Enter branch Name">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Asset Category</label>
                                <ul class="form-group-plus css-equal-heights">
                                    <li>
                                        <select class="form-select" name="asset_cat" id="asset_cat" data-select2-id="7" tabindex="-1" aria-hidden="true">
                                            <option value="">Select Category</option>
                                            <option value="Fixed Assets" <?php echo ($asset->asset_cat=='Fixed Assets')? "selected":"" ?>>Fixed Assets</option>
                                            <option value="Intangible" <?php echo ($asset->asset_cat=='Intangible')? "selected":"" ?>>Intangible</option>
                                            <option value="Tangible" <?php echo ($asset->asset_cat=='Tangible')? "selected":"" ?>>Tangible</option>
                                        </select>
                                    </li>
                                    <li>
                                        <a class="btn btn-primary form-plus-btn" data-bs-toggle="modal" data-bs-target="#add_category">
                                            <i class="fe fe-plus-circle"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Serial Number</label>
                                <input type="text" class="form-control" name="asset_sl_no" id="asset_sl_no" value="{{ $asset->asset_sl_no }}" placeholder="Enter Serial Number">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Purchase Date</label>
                                <input type="date" class="form-control" name="purchase_date" id="purchase_date" value="{{ $asset->purchase_date }}" placeholder="Purchase Date">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Purchase Cost(INR)</label>
                                <input type="text" class="form-control" name="purchase_cost" id="purchase_cost" value="{{ $asset->purchase_cost }}" placeholder="Enter Purchase Cost">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Warranty Period</label>
                                <input type="date" class="form-control" name="warranty_period" id="warranty_period" value="{{ $asset->warranty_period }}" placeholder="Warranty Period">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Opening Stocks(Units)</label>
                                <input type="text" class="form-control" name="opening_stock" id="opening_stock" value="{{ $asset->opening_stock }}" placeholder="Enter Opening Stocks">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Opening WDV IT's Act Wise</label>
                                <input type="number" class="form-control" name="opening_it_act" id="opening_it_act" value="{{ $asset->opening_it_act }}" placeholder="0">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Opening WDV Company's Act Wise</label>
                                <input type="number" class="form-control" name="opening_comp_act" id="opening_comp_act" value="{{ $asset->opening_comp_act }}" placeholder="0">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Description Till WDV IT's Act Wise</label>
                                <input type="text" class="form-control" name="desc_it" id="desc_it" value="{{ $asset->desc_it }}" placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label>Description Till WDV Company's Act Wise</label>
                                <input type="text" class="form-control" name="desc_comp" id="desc_comp" value="{{ $asset->desc_comp }}" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
				<div class="message-container"></div>
				<div id="addAssetLoader" class="loader"></div>
                <div class="add-customer-btns text-end">
					<a href="{{ url('/assets') }}" class="btn btn-primary cancel me-2">Cancel</a>
					<button type="submit" class="btn btn-primary">Update Asset</button>
                </div>
            </div>
			</form>
        </div>
    </div>
</div>
<div class="modal custom-modal fade" id="add_category" role="dialog">
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
                            <label>Asset Category Name</label>
                            <input type="number" class="form-control" placeholder="Enter Asset Category Name">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group mb-0">
                            <label>Link Bank Account</label>
                            <select class="form-select">
                                <option>Select</option>
                                <option>Kotak Bank (1234567890)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer add-tax-btns">
                <button type="reset" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn me-2">Cancel</button>
                <button type="submit" data-bs-dismiss="modal" class="btn btn-primary paid-continue-btn">Create</button>
            </div>
        </div>
    </div>
</div>
@endsection
