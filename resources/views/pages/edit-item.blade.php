@extends('layouts.default')
<style>
    .hidden {
        display: none;
    }
</style>

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Edit Product/Service</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
					<form action="javascript:void(0);" method="post" name="addItemFrm" id="addItemFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="itemId" value="{{ $item->id }}">
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
                                                    <input type="radio" name="item_type" value="manufacturing" <?php echo ($item->item_type=='manufacturing')? "checked":"" ?>><span class="checkmark"></span> Manufacturing
                                                </label>
                                            </div>
                                            <div class="form-control me-3">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="item_type" value="reseller" <?php echo ($item->item_type=='reseller')? "checked":"" ?>><span class="checkmark"></span> Trading/Reseller
                                                </label>
                                            </div>
                                            <div class="form-control me-3">
                                                <label class="custom_radio mb-0">
                                                    <input type="radio" name="item_type" value="service" <?php echo ($item->item_type=='service')? "checked":"" ?>><span class="checkmark"></span> Service
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Item/ Product Name <span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="item_name"  id="item_name" value="{{ $item->item_name}}" placeholder="Enter Item Name">
                                    </div>
                                </div>

                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#unit" style="width:100%; padding: 8px 15px; margin-top:28px;">Select Units</button>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12" id="sac_div">
                                    <div class="form-group add-products" >
                                        <label>SAC Code<span class="text-danger"> *</span></label>
                                        <input type="text" name="sac_code" id="sac_code" value="{{ $item->sac_code}}" class="form-control" placeholder="Enter SAC Code">
                                        <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                        Search SAC
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" id="hsn_div">
                                    <div class="form-group add-products">
                                        <label>HSN Code<span class="text-danger"> *</span></label>
                                        <input type="text" name="hsn_code" id="hsn_code" value="{{ $item->hsn_code}}" class="form-control" placeholder="Enter HSN Code">
                                        <button type="submit" class="btn btn-primary" onclick="openNewTab()">
                                        Search HSN
                                        </button>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Opening Stock / Balance</label>
                                        <input type="text" class="form-control" name="opening_stock_bal" id="opening_stock_bal" value="{{ $item->opening_stock_bal}}" placeholder="Enter Opening Stock / Balance">
                                    </div>
                                </div>
                                
                                <div class="row" id="manufacturing_content">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-bordered">
                                                    <li class="nav-item">
                                                        <a href="#manufacturing_stock" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <strong>Stock</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-details" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                                            <strong>Product Details</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-pricing" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                            <strong>Pricing</strong>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
												<?php 
													$openingStock = ($item->opening_stock!="")?json_decode($item->opening_stock):[];
													$openingStockAmt = ($item->opening_stock_amt!="")?json_decode($item->opening_stock_amt):[];
													$purchaseStock = ($item->purchase_stock!="")?json_decode($item->purchase_stock):[];
													$purchaseStockAmt = ($item->purchase_stock_amt!="")?json_decode($item->purchase_stock_amt):[];
													$closingStock = ($item->closing_stock!="")?json_decode($item->closing_stock):[];
													$closingStockAmt = ($item->closing_stock_amt!="")?json_decode($item->closing_stock_amt):[];
													$resellerStock = ($item->reseller_stock!="")?json_decode($item->reseller_stock):[];
													$resellerStockAmt = ($item->reseller_stock_amt!="")?json_decode($item->reseller_stock_amt):[];													
										
													$openingStockAmt = json_decode(json_encode($openingStockAmt), true);
													$purchaseStockAmt = json_decode(json_encode($purchaseStockAmt), true);
													$closingStockAmt = json_decode(json_encode($closingStockAmt), true);
													$resellerStockAmt = json_decode(json_encode($resellerStockAmt), true);
													//echo "<pre>";print_r($purchaseStockAmt );exit;
													//echo (array_key_exists('labour-charges',$purchaseStockAmt))?$purchaseStockAmt['labour-charges']:""; exit;
												?>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="manufacturing_stock">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <h6>Opening Stocks</h6>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="raw" value="raw" <?php if (in_array('raw', $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('raw')" style="margin-right: 5px;"><span class="checkmark"></span> Raw Materials
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="wip"  value="wip" <?php if (in_array('wip', $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('wip')" style="margin-right: 5px;"><span class="checkmark"></span> Work in Progress (WIP)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="finished-goods"  value="finished-goods" <?php if (in_array('finished-goods', $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('finished-goods')" style="margin-right: 5px;"><span class="checkmark"></span> Finished Goods
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="merchandise" value="merchandise" <?php if (in_array('merchandise', $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('merchandise')" style="margin-right: 5px;"><span class="checkmark"></span> Merchandise Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="supplies"  value="supplies" <?php if(in_array('supplies', $openingStock)){ echo 'checked="checked"'; }?> onchange="toggleInputField('supplies')" style="margin-right: 5px;"><span class="checkmark"></span> Supplies
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="spare" value="spare" <?php if (in_array('spare', $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('spare')" style="margin-right: 5px;"><span class="checkmark"></span> Spare Parts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="opening_stock[]" id="consignment" value="consignment" <?php if (in_array('consignment', $openingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('consignment')" style="margin-right: 5px;"><span class="checkmark"></span> Consignment Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock" data-row-id="1" style="width:100%; padding: 8px 15px; " onclick="saveModalData('manufacturing_stock1')">Others</button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 raw-input <?php echo (array_key_exists('raw',$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Raw Material Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('raw',$openingStockAmt))?$openingStockAmt['raw']:"";?>"  placeholder="Enter Raw Material Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 wip-input <?php echo (array_key_exists('wip',$openingStockAmt))?"":"hidden";?>">
                                                                        <div class="form-group">
                                                                            <label>WIP Amout</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('wip',$openingStockAmt))?$openingStockAmt['wip']:"";?>"  placeholder="Enter WIP Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 finished-goods-input <?php echo (array_key_exists('finished',$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Finished Goods Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('finished-goods',$openingStockAmt))?$openingStockAmt['finished-goods']:"";?>"  placeholder="Enter Finished Goods Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 merchandise-input <?php echo (array_key_exists('merchandise',$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Merchandise Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('merchandise',$openingStockAmt))?$openingStockAmt['merchandise']:"";?>"  placeholder="Enter Merchandise Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 supplies-input <?php echo (array_key_exists('supplies',$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Supplies Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('supplies',$openingStockAmt))?$openingStockAmt['supplies']:"";?>"  placeholder="Enter supplies Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 spare-input <?php echo (array_key_exists('spare',$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Spare Parts Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('spare',$openingStockAmt))?$openingStockAmt['spare']:"";?>"  placeholder="Enter spare Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 consignment-input <?php echo (array_key_exists('consignment',$openingStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">    
                                                                            <label>Consignment Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="opening_stock_amt[]" value="<?php echo (array_key_exists('consignment',$openingStockAmt))?$openingStockAmt['consignment']:"";?>"  placeholder="Enter Consignment Inventory Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row" id="staticRow1">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="1" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-4">
                                                            <h6>Purchase</h6>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="registered-purchase" value="registered-purchase" <?php if (in_array('registered-purchase', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('registered-purchase')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Registered Purchase
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="unregistered-purchase" value="unregistered-purchase" <?php if (in_array('unregistered-purchase', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('unregistered-purchase')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Unregistered Purchase
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="factory-expenses" value="factory-expenses" <?php if (in_array('factory-expenses', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('factory-expenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Factory Expenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="marketing-expenses" value="marketing-expenses" <?php if (in_array('marketing-expenses', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('marketing-expenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Marketing Expenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="packing-charges" value="packing-charges" <?php if (in_array('packing-charges', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('packing-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Packing Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="job-charges" value="job-charges" <?php if (in_array('job-charges', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('job-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Job Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="freight-charges" value="freight-charges" <?php if (in_array('freight-charges', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('freight-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Freight Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="electricity-expenses" value="electricity-expenses" <?php if (in_array('electricity-expenses', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('electricity-expenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Electricity Expenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="labour-charges" value="labour-charges" <?php if (in_array('labour-charges', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('labour-charges')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Labour Charges
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="deprecation" value="deprecation" <?php if (in_array('deprecation', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('deprecation')" style="margin-right: 5px;"><span class="checkmark"></span> Deprecation
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="inventory-purchases" value="inventory-purchases" <?php if (in_array('inventory-purchases', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('inventory-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Inventory Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="expense-purchases" value="expense-purchases" <?php if (in_array('expense-purchases', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('expense-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Expense Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="capital-purchases" value="capital-purchases" <?php if (in_array('capital-purchases', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('capital-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Capital Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="services-purchases" value="services-purchases" <?php if (in_array('services-purchases', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('services-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Services Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="subcontractor-purchases" value="subcontractor-purchases" <?php if (in_array('subcontractor-purchases', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('subcontractor-purchases')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Subcontractor Purchases
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="operating-lease-payments" value="operating-lease-payments" <?php if (in_array('operating-lease-payments', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('operating-lease-payments')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Operating Lease Payments
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="utilities-overheads" value="utilities-overheads" <?php if (in_array('utilities-overheads', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('utilities-overheads')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Utilities and Overheads
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="travel-entertainment" value="travel-entertainment" <?php if (in_array('travel-entertainment', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('travel-entertainment')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Travel and Entertainment
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="software-licenses" value="software-licenses" <?php if (in_array('software-licenses', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('software-licenses')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Software and Licenses
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="purchase_stock[]" id="insurance-premiums" value="insurance-premiums" <?php if (in_array('insurance-premiums', $purchaseStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('insurance-premiums')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Insurance Premiums
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex; ">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock" data-row-id="2" style="width:100%; padding: 8px 15px; " onclick="saveModalData('manufacturing_stock2')">Others</button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 registered-purchase-input <?php echo (array_key_exists('registered-purchase',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Registered Purchase Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('registered-purchase',$purchaseStockAmt))?$purchaseStockAmt['registered-purchase']:"";?>"  placeholder="Enter Registered Purchase Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 unregistered-purchase-input <?php echo (array_key_exists('unregistered-purchase',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Unregistered Purchase Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('unregistered-purchase',$purchaseStockAmt))?$purchaseStockAmt['unregistered-purchase']:"";?>"  placeholder="Enter Unregistered Purchase Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 factory-expenses-input <?php echo (array_key_exists('factory-expenses',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Factory Expenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('factory-expenses',$purchaseStockAmt))?$purchaseStockAmt['factory-expenses']:"";?>"  placeholder="Enter Factory Expenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 marketing-expenses-input <?php echo (array_key_exists('marketing-expenses',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Marketing Expenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('marketing-expenses',$purchaseStockAmt))?$purchaseStockAmt['marketing-expenses']:"";?>"  placeholder="Enter Marketing Expenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 packing-charges-input <?php echo (array_key_exists('packing-charges',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Packing Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('packing-charges',$purchaseStockAmt))?$purchaseStockAmt['packing-charges']:"";?>"  placeholder="Enter Packing Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 job-charges-input <?php echo (array_key_exists('job-charges',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Job Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('job-charges',$purchaseStockAmt))?$purchaseStockAmt['job-charges']:"";?>"  placeholder="Enter Job Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 freight-charges-input <?php echo (array_key_exists('freight-charges',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Freight Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('freight-charges',$purchaseStockAmt))?$purchaseStockAmt['freight-charges']:"";?>"  placeholder="Enter Freight Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 electricity-expenses-input <?php echo (array_key_exists('electricity-expenses',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Electricity Expenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('electricity-expenses',$purchaseStockAmt))?$purchaseStockAmt['electricity-expenses']:"";?>"  placeholder="Enter Electricity Expenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 labour-charges-input <?php echo (array_key_exists('labour-charges',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Labour Charges Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('labour-charges',$purchaseStockAmt))?$purchaseStockAmt['labour-charges']:"";?>"  placeholder="Enter Labour Charges Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 deprecation-input <?php echo (array_key_exists('deprecation',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Deprecation Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('deprecation',$purchaseStockAmt))?$purchaseStockAmt['deprecation']:"";?>"  placeholder="Enter Deprecation Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 inventory-purchases-input <?php echo (array_key_exists('inventory-purchases',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Inventory Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('inventory-purchases',$purchaseStockAmt))?$purchaseStockAmt['inventory-purchases']:"";?>"  placeholder="Enter Inventory Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 expense-purchases-input <?php echo (array_key_exists('expense-purchases',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Expense Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('expense-purchases',$purchaseStockAmt))?$purchaseStockAmt['expense-purchases']:"";?>"  placeholder="Enter Expense Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 capital-purchases-input <?php echo (array_key_exists('capital-purchases',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Capital Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('capital-purchases',$purchaseStockAmt))?$purchaseStockAmt['capital-purchases']:"";?>"  placeholder="Enter Capital Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 services-purchases-input <?php echo (array_key_exists('services-purchases',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Services Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('services-purchases',$purchaseStockAmt))?$purchaseStockAmt['services-purchases']:"";?>"  placeholder="Enter Services Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 subcontractor-purchases-input <?php echo (array_key_exists('subcontractor-purchases',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Subcontractor Purchases Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('subcontractor-purchases',$purchaseStockAmt))?$purchaseStockAmt['subcontractor-purchases']:"";?>"  placeholder="Enter Subcontractor Purchases Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 operating-lease-payments-input <?php echo (array_key_exists('operating-lease-payments',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Operating Lease Payments Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('operating-lease-payments',$purchaseStockAmt))?$purchaseStockAmt['operating-lease-payments']:"";?>"  placeholder="Enter Operating Lease Payments Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 utilities-overheads-input <?php echo (array_key_exists('utilities-overheads',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Utilities and Overheads Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('utilities-overheads',$purchaseStockAmt))?$purchaseStockAmt['utilities-overheads']:"";?>"  placeholder="Enter Utilities and Overheads Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 travel-entertainment-input <?php echo (array_key_exists('travel-entertainment',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Travel and Entertainment Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('travel-entertainment',$purchaseStockAmt))?$purchaseStockAmt['travel-entertainment']:"";?>"  placeholder="Enter Travel and Entertainment Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 software-licenses-input <?php echo (array_key_exists('software-licenses',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Software and Licenses Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('software-licenses',$purchaseStockAmt))?$purchaseStockAmt['software-licenses']:"";?>"  placeholder="Enter Software and Licenses Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 insurance-premiums-input <?php echo (array_key_exists('insurance-premiums',$purchaseStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Insurance Premiums Amount</label>
                                                                            <input type="text" class="form-control" name="purchase_stock_amt[]" value="<?php echo (array_key_exists('insurance-premiums',$purchaseStockAmt))?$purchaseStockAmt['insurance-premiums']:"";?>" placeholder="Enter Insurance Premiums Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="staticRow2">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="2" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-md-12 col-sm-12 mt-4">
                                                            <h6>Closing Stock</h6>
                                                            <div class="row">
                                                                <!-- Raw Materials -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="raw-materials" value="raw-materials" <?php if (in_array('raw-materials', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('raw-materials')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Raw Materials
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Work-in-Progress (WIP) -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="wip2" value="wip2" <?php if (in_array('wip2', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('wip2')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Work-in-Progress (WIP)
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Finished Goods -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="finished-goods2" value="finished-goods2" <?php if (in_array('finished-goods2', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('finished-goods2')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Finished Goods
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Obsolete or Slow-Moving Stock -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center; font-size:13px;">
                                                                            <input type="checkbox" name="closing_stock[]" id="obsolete-stock"  value="obsolete-stock" <?php if (in_array('obsolete-stock', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('obsolete-stock')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Obsolete or Slow-Moving Stock
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Perishable Goods -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="perishable-goods" value="perishable-goods" <?php if (in_array('perishable-goods', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('perishable-goods')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Perishable Goods
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Valuation Adjustments -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="valuation-adjustments" value="valuation-adjustments" <?php if (in_array('valuation-adjustments', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('valuation-adjustments')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Valuation Adjustments
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Consignment Stock -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="consignment-stock" value="consignment-stock" <?php if (in_array('consignment-stock', $closingStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('consignment-stock')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Consignment Stock
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <!-- Restricted Stock -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="closing_stock[]" id="restricted-stock" <?php if (in_array('restricted-stock', $closingStock)) { echo 'checked="checked"'; }?> value="restricted-stock" onchange="toggleInputField('restricted-stock')" style="margin-right: 5px;">
                                                                            <span class="checkmark"></span> Restricted Stock
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex; ">
                                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock" data-row-id="3" style="width:100%; padding: 8px 15px; " onclick="saveModalData('manufacturing_stock3')">Others</button>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <!-- Raw Materials Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 raw-materials-input <?php echo (array_key_exists('raw-materials',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Raw Materials Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('raw-materials',$closingStockAmt))?$closingStockAmt['raw-materialss']:"";?>" placeholder="Enter Raw Materials Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Work-in-Progress (WIP) Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 wip2-input <?php echo (array_key_exists('wip2',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Work-in-Progress (WIP) Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('wip2',$closingStockAmt))?$closingStockAmt['wip2']:"";?>" placeholder="Enter WIP Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Finished Goods Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 finished-goods2-input <?php echo (array_key_exists('finished-goods2',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Finished Goods Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('finished-goods2',$closingStockAmt))?$closingStockAmt['finished-goods2']:"";?>" placeholder="Enter Finished Goods Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 obsolete-stock-input <?php echo (array_key_exists('obsolete-stock',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Obsolete or Slow-Moving Stock Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('obsolete-stock',$closingStockAmt))?$closingStockAmt['obsolete-stock']:"";?>" placeholder="Enter Obsolete or Slow-Moving Stock Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Perishable Goods Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 perishable-goods-input <?php echo (array_key_exists('perishable-goods',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Perishable Goods Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('perishable-goods',$closingStockAmt))?$closingStockAmt['perishable-goods']:"";?>" placeholder="Enter Perishable Goods Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Valuation Adjustments Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 valuation-adjustments-input <?php echo (array_key_exists('valuation-adjustments',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Valuation Adjustments Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('valuation-adjustments',$closingStockAmt))?$closingStockAmt['valuation-adjustments']:"";?>" placeholder="Enter Valuation Adjustments Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Consignment Stock Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 consignment-stock-input <?php echo (array_key_exists('consignment-stock',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Consignment Stock Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('consignment-stock',$closingStockAmt))?$closingStockAmt['consignment-stock']:"";?>" placeholder="Enter Consignment Stock Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>

                                                                <!-- Restricted Stock Input -->
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3 restricted-stock-input <?php echo (array_key_exists('restricted-stock',$closingStockAmt))?"":"hidden";?>" >
                                                                    <div class="form-group">
                                                                        <label>Restricted Stock Amount</label>
                                                                        <input type="text" class="form-control" name="closing_stock_amt[]" value="<?php echo (array_key_exists('restricted-stock',$closingStockAmt))?$closingStockAmt['restricted-stock']:"";?>" placeholder="Enter Restricted Stock Amount" style="width: 100%;">
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="staticRow3">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="3" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
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

                                <div class="row" id="trading_content">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-bordered">
                                                    <li class="nav-item">
                                                        <a href="#trading_stock" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <strong>Stock</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-details" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                                                            <strong>Product Details</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-pricing" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                            <strong>Pricing</strong>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="trading_stock">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <h6>Opening Stocks/Trading/Reseller</h6>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="raw1" value="raw1" <?php if (in_array('raw1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('raw1')" style="margin-right: 5px;"><span class="checkmark"></span> Raw Materials
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="wip1" value="wip1" <?php if (in_array('wip1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('wip1')" style="margin-right: 5px;"><span class="checkmark"></span> Work in Progress (WIP)
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="finished-goods1" value="finished-goods1" <?php if (in_array('finished-goods1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('finished-goods1')" style="margin-right: 5px;"><span class="checkmark"></span> Finished Goods
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="merchandise1" value="merchandise1" <?php if (in_array('merchandise1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('merchandise1')" style="margin-right: 5px;"><span class="checkmark"></span> Merchandise Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="supplies1" value="supplies1" <?php if (in_array('supplies1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('supplies1')" style="margin-right: 5px;"><span class="checkmark"></span> Supplies
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="spare1" value="spare1" <?php if (in_array('spare1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('spare1')" style="margin-right: 5px;"><span class="checkmark"></span> Spare Parts
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                    <div class="form-control" style="width: 100%;">
                                                                        <label class="custom_checkbox mb-0" style="display: flex; align-items: center;">
                                                                            <input type="checkbox" name="reseller_stock[]" id="consignment1" value="consignment1" <?php if (in_array('consignment1', $resellerStock)) { echo 'checked="checked"'; }?> onchange="toggleInputField('consignment1')" style="margin-right: 5px;"><span class="checkmark"></span> Consignment Inventory
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 col-sm-12 mt-3" style="display: flex;">
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#other-open-stock" data-row-id="4" style="width:100%; padding: 8px 15px; " onclick="saveModalData('reseller_stock4')">Others</button>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 raw1-input <?php echo (array_key_exists('raw1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Raw Material Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('raw1',$resellerStockAmt))?$resellerStockAmt['raw1']:"";?>"  placeholder="Enter Raw Material Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 wip1-input <?php echo (array_key_exists('wip1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>WIP Amout</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('wip1',$resellerStockAmt))?$resellerStockAmt['wip1']:"";?>"  placeholder="Enter WIP Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 finished-goods1-input <?php echo (array_key_exists('finished-goods1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Finished Goods Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('finished-goods1',$resellerStockAmt))?$resellerStockAmt['finished-goods1']:"";?>"  placeholder="Enter Finished Goods Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 merchandise1-input <?php echo (array_key_exists('merchandise1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Merchandise Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('merchandise1',$resellerStockAmt))?$resellerStockAmt['merchandise1']:"";?>"  placeholder="Enter Merchandise Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 supplies1-input <?php echo (array_key_exists('supplies1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Supplies Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('supplies1',$resellerStockAmt))?$resellerStockAmt['supplies1']:"";?>"  placeholder="Enter supplies Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 spare1-input <?php echo (array_key_exists('spare1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">
                                                                            <label>Spare Parts Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('spare1',$resellerStockAmt))?$resellerStockAmt['spare1']:"";?>"  placeholder="Enter spare Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 consignment1-input <?php echo (array_key_exists('consignment1',$resellerStockAmt))?"":"hidden";?>" >
                                                                        <div class="form-group">    
                                                                            <label>Consignment Inventory Amount</label>
                                                                            <input type="text" class="form-control" name="reseller_stock_amt[]" value="<?php echo (array_key_exists('consignment1',$resellerStockAmt))?$resellerStockAmt['consignment1']:"";?>"  placeholder="Enter Consignment Inventory Amount" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="row" id="staticRow4">
                                                                    <div class="col-lg-3 col-md-6 col-sm-12 mt-3 new-input" data-row-id="4" style="display: none;">
                                                                        <div class="form-group">
                                                                            <label class="newLabel"></label>
                                                                            <input type="text" class="form-control newAmount" name="spare" placeholder="" style="width: 100%;">
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

                                <div class="row" id="service_content">
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <ul class="nav nav-tabs nav-bordered">
                                                    <li class="nav-item">
                                                        <a href="#service-details" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                                            <strong>Service Details</strong>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#service-pricing" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                                            <strong>Pricing</strong>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<!--------------->
								<div class="row">
									<div class="col-xl-12">
										<div class="card">
											<div class="card-body">
												<div class="tab-content">
													<div class="tab-pane" id="service-details">
														<div class="form-group-item">
															<div class="row">
																<div class="col-xl-6 col-lg-6 col-md-6 col-12 description-box">
																	<div class="form-group" id="summernote_container">
																		<label class="form-control-label">Service Descriptions</label>
																		<textarea class="summernote form-control" name="prod_desc" id="prod_desc" placeholder="Write Product Description" rows="7">{{ $item->prod_desc}}</textarea>
																	</div>
																</div>
																<div class="col-xl-6 col-lg-6 col-md-6 col-12">
																	<div class="form-group">
																		<label>Service Image</label>
																		<div class="form-group service-upload mb-0">
																			<span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
																			<h6 class="drop-browse align-center">
																				Drop your files here or<span class="text-primary ms-1">browse</span>
																			</h6>
																			<p class="text-muted">Maximum size: 50MB</p>
																			<input type="file" name="prod_image[]" multiple id="prod_image" >
																			<div id="frames"></div>
																			
																		</div>
																		@if(@$item->prod_image !="")
																			<?php $arrayOfFiles = explode(',',$item->prod_image); ?>
																			@foreach($arrayOfFiles as $img)
																			  <div class="downloadFile"><a target="_blank" href="{{ asset('/public/uploads/items-image/'.$img) }}">Download</a></div>
																			@endforeach
																		@endif
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane show" id="service-pricing">
														<div class="row">
															<div class="col-lg-4 col-md-4 col-sm-12">
																<div class="form-group">
																	<label>Billing No. <span class="text-danger"> *</span></label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="item_bill_no" id="item_bill_no" value="{{ $item->item_bill_no}}"  aria-label="Billing no" placeholder="Billing no.">                                                                        
																		</div>
																	</div>																
																</div>
															</div>
															<div class="col-lg-4 col-md-4 col-sm-12">
																<div class="form-group">                                                                
																	<label>Actual No. <span class="text-danger"> *</span></label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="item_actual_no" id="item_actual_no" value="{{ $item->item_actual_no}}"  aria-label="Actual no" placeholder="Actual no.">
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-4 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Date</label>
																	<input type="Date" name="item_date" id="item_date" value="{{ $item->item_date}}" class="form-control" placeholder="Enter Date">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Selling Price <span class="text-danger"> *</span></label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="selling_price" id="selling_price" value="{{ $item->selling_price}}" aria-label="Selling Price" placeholder="Sales Price">
																			<select class="form-select" name="selling_tax" id="selling_tax" aria-label="Select Action">
																				<option value="without_tax" <?php echo ($item->selling_price=='without_tax')? "selected":"" ?>>Without Tax</option>
																				<option value="include_tax" <?php echo ($item->selling_price=='include_tax')? "selected":"" ?>>Include Tax</option>
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
																			<input type="text" class="form-control" name="disc_sell" id="disc_sell" value="{{ $item->disc_sell}}" aria-label="Selling Price" placeholder="Discount">
																			<select class="form-select" name="disc_sell_type" id="disc_sell_type" aria-label="Select Action">
																				<option value="percentage" <?php echo ($item->disc_sell_type=='percentage')? "selected":"" ?>>Percentage</option>
																				<option value="amount" <?php echo ($item->disc_sell_type=='amount')? "selected":"" ?>>Amount</option>
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
																			<input type="text" class="form-control" name="wholesale_price" id="wholesale_price" value="{{ $item->wholesale_price}}" aria-label="Selling Price" placeholder="Wholesale Price">
																			<select class="form-select" name="wholesale_tax" id="wholesale_tax" aria-label="Select Action">
																				<option value="without_tax" <?php echo ($item->wholesale_tax=='without_tax')? "selected":"" ?>>Without Tax</option>
																				<option value="include_tax" <?php echo ($item->wholesale_tax=='include_tax')? "selected":"" ?>>Include Tax</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Minimum Wholesale Quantity</label>
																	<div class="input-group">
																		<input type="text" class="form-control" name="min_wholesale_quantity" id="min_wholesale_quantity" value="{{ $item->min_wholesale_quantity}}" placeholder="Quantity" aria-label="Recipient's username" aria-describedby="basic-addon2">
																		<span class="input-group-text" data-toggle="popover" data-placement="top" data-html="true" data-content="<h5>Popover Title</h5><p>Vivamus sagittis lacus vel augue laoreet rutrum faucibus.</p>">
																			<i class="fa fa-info-circle"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Purchase Price <span class="text-danger"> *</span></label>
																	<div class="form-group">
																		<div class="input-group row mb-0">
																			<input type="text" class="form-control" name="purchase_price" id="purchase_price" value="{{ $item->purchase_price}}" aria-label="Selling Price" placeholder="Purchase Price">
																			<select class="form-select" name="purchase_tax" id="purchase_tax" aria-label="Select Action">
																				<option value="without_tax" <?php echo ($item->purchase_tax=='without_tax')? "selected":"" ?>>Without Tax</option>
																				<option value="include_tax" <?php echo ($item->purchase_tax=='include_tax')? "selected":"" ?>>Include Tax</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-12">
																<div class="form-group">
																	<label>Tax</label>
																	<div class="form-group">
																		<select class="select form-select" name="item_tax" id="item_tax">
																			<option value="">Select Tax</option>
																			<option value="IVA" <?php echo ($item->item_tax=='IVA')? "selected":"" ?>>IVA - (21%)</option>
																			<option value="IRPF" <?php echo ($item->item_tax=='IRPF')? "selected":"" ?>>IRPF - (-15%)</option>
																			<option value="PDV" <?php echo ($item->item_tax=='PDV')? "selected":"" ?>>PDV - (20%)</option>
																		</select>
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
                            
                            <div class="message-container"></div>
                            <div id="addItemLoader" class="loader"></div>
                            <div class="add-customer-btns text-end">
                                <a href="{{ url('/items') }}" class="btn customer-btn-cancel">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Item</button>
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
			<input type="hidden" name="prodId" id="prodId" value="{{ $item->id }}">
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
                                <option value="bags" <?php echo ($item->base_unit=='bags')? "selected":"" ?>>BAGS (Bag)</option>
                                <option value="bottle" <?php echo ($item->base_unit=='bottle')? "selected":"" ?>>BOTTLES (Bottle)</option>
                                <option value="box" <?php echo ($item->base_unit=='box')? "selected":"" ?>>BOXS (Box)</option>
                                <option value="can" <?php echo ($item->base_unit=='can')? "selected":"" ?>>CANS (Can)</option>
                                <option value="ctn" <?php echo ($item->base_unit=='ctn')? "selected":"" ?>>CARTONS (Ctn)</option>
                                <option value="dzn" <?php echo ($item->base_unit=='dzn')? "selected":"" ?>>DOZENS (Dzn)</option>
                                <option value="grm" <?php echo ($item->base_unit=='grm')? "selected":"" ?>>GRAMMES (Gm)</option>
                                <option value="kg" <?php echo ($item->base_unit=='kg')? "selected":"" ?>>KILOGRAMMES (Kg)</option>
                                <option value="ltr" <?php echo ($item->base_unit=='ltr')? "selected":"" ?>>LITER (Ltr)</option>
                                <option value="mtr" <?php echo ($item->base_unit=='mtr')? "selected":"" ?>>METERS (Mtr)</option>
                                <option value="ml" <?php echo ($item->base_unit=='ml')? "selected":"" ?>>MILILITER (Ml)</option>
                                <option value="nos" <?php echo ($item->base_unit=='nos')? "selected":"" ?>>NUMBERS (Nos)</option>
                                <option value="pack" <?php echo ($item->base_unit=='pack')? "selected":"" ?>>PACKS (Pac)</option>
                                <option value="pair" <?php echo ($item->base_unit=='pair')? "selected":"" ?>>PAIRS (Prs)</option>
                                <option value="pcs" <?php echo ($item->base_unit=='pcs')? "selected":"" ?>>PIECES (Pcs)</option>
                                <option value="qtl" <?php echo ($item->base_unit=='qtl')? "selected":"" ?>>QUINTAL (Qtl)</option>
                                <option value="Other" <?php echo ($item->base_unit=='Other')? "selected":"" ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Secondary Unit</label>
                        <div class="form-group">
                            <select class="select form-select" name="sec_unit" id="sec_unit">
                                <option value="">None</option>
                                <option value="IVA" <?php echo ($item->sec_unit=='IVA')? "selected":"" ?>>IVA - (21%)</option>
								<option value="IRPF" <?php echo ($item->sec_unit=='IRPF')? "selected":"" ?>>IRPF - (-15%)</option>
								<option value="PDV" <?php echo ($item->sec_unit=='PDV')? "selected":"" ?>>PDV - (20%)</option>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12" id="baseUnitOther">
                        <label>Other</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="base_unit_other" id="base_unit_other" value="{{ $item->base_unit_other }}" >
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

<div class="modal fade" id="other-open-stock" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);" method="post" name="openingStockOtherFrm" id="openingStockOtherFrm">
				<input type="hidden" name="id" id="itemId" value="{{ $item->id }}">
				<input type="hidden" name="other_rowid" id="other_rowid">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-4">
                            <label>Open Stock Name</label>
                            <input type="text" class="form-control" id="openStockName" name="opening_stock_name" value="" placeholder="Enter Open Stock Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Enter Stock Amount</label>
                            <input type="text" class="form-control" id="stockAmount" name="op_stock_oth_amt" value="" placeholder="Enter Stock Amount">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
					<div class="message-container"></div>
                    <div id="stockLoader" class="loader"></div>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {

var itemTypeRadios = document.querySelectorAll('input[name="item_type"]');
var sacDiv = document.getElementById('sac_div');
var hsnDiv = document.getElementById('hsn_div');
var manufacturingDiv = document.getElementById('manufacturing_content');
var tradingDiv = document.getElementById('trading_content');
var serviceDiv = document.getElementById('service_content');

manufacturingDiv.style.display = 'none';
tradingDiv.style.display = 'none';
serviceDiv.style.display = 'none';
sacDiv.style.display = 'none';
hsnDiv.style.display = 'Block';

	//When it loaded DOM
	var itemType = "<?php echo $item->item_type ?>"; 
	if (itemType === 'manufacturing') {
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'block';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'none';
		$("#manufacturing_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");

    } else if(itemType === 'reseller') {
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'block';
        serviceDiv.style.display = 'none';
		$("#trading_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");
    } else {
        sacDiv.style.display = 'block';
        hsnDiv.style.display = 'none';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'block';
		$("#service-details").addClass("active");
		$("#service-pricing").removeClass("active");
    }

// Function to handle radio button change event
function handleItemTypeChange() {
    if (this.value === 'manufacturing') {
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'block';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'none';
		$("#manufacturing_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");

    } else if(this.value === 'reseller') {
        sacDiv.style.display = 'none';
        hsnDiv.style.display = 'block';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'block';
        serviceDiv.style.display = 'none';
		$("#trading_stock").addClass("active");
		$("#service-details").removeClass("active");
		$("#service-pricing").removeClass("active");
    } else {
        sacDiv.style.display = 'block';
        hsnDiv.style.display = 'none';
        manufacturingDiv.style.display = 'none';
        tradingDiv.style.display = 'none';
        serviceDiv.style.display = 'block';
		$("#service-details").addClass("active");
		$("#service-pricing").removeClass("active");
    }
}

// Attach change event listener to each radio button
itemTypeRadios.forEach(function(radio) {
    radio.addEventListener('change', handleItemTypeChange);
});

});


var count = 1; // Initialize count for incremental IDs

function saveModalData(val) {
    // Get values from modal inputs
    var openStockName = document.getElementById('openStockName').value;
    var stockAmount = document.getElementById('stockAmount').value;

    // Get the data-row-id from the button that triggered the modal
    var rowId = $('#other-open-stock').data('row-id');
	
	//start added for dynamic
	document.getElementById('other_rowid').value = val; //set value in form hidden input
	if(val == "manufacturing_stock1")
	{
		document.getElementById('openStockName').value = "<?php echo $item->opening_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->op_stock_oth_amt; ?>"
	}else if(val == "manufacturing_stock2"){
		document.getElementById('openStockName').value = "<?php echo  $item->purchase_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->pu_stock_oth_amt; ?>"
	}
	else if(val == "manufacturing_stock3"){
		document.getElementById('openStockName').value = "<?php echo  $item->closing_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->cl_stock_oth_amt; ?>"
	}
	else if(val == "reseller_stock4"){
		document.getElementById('openStockName').value = "<?php echo $item->reseller_stock_name; ?>"
		document.getElementById('stockAmount').value = "<?php echo  $item->re_stock_oth_amt; ?>"
	}
	//end added for dynamic

    // Create new elements for the next entry
    var newInputSection = document.createElement('div');
    newInputSection.className = 'col-lg-3 col-md-6 col-sm-12 mt-3 new-input';
    newInputSection.setAttribute('data-row-id', rowId);

    var newLabel = document.createElement('label');
    newLabel.textContent = openStockName;
    newLabel.className = 'newLabel';

    var newAmount = document.createElement('input');
    newAmount.setAttribute('type', 'text');
    newAmount.setAttribute('class', 'form-control newAmount');
    newAmount.setAttribute('placeholder', 'Enter Stock Amount');
    newAmount.setAttribute('style', 'width: 100%;');
    newAmount.value = stockAmount;

    // Append new elements to the form
    var staticRow = document.getElementById('staticRow' + rowId);
    staticRow.innerHTML = ''; // Clear existing content
    newInputSection.appendChild(newLabel);
    newInputSection.appendChild(newAmount);
    staticRow.appendChild(newInputSection);

    // Clear modal inputs
    document.getElementById('openStockName').value = '';
    document.getElementById('stockAmount').value = '';

    // Close the modal
    $('#other-open-stock').modal('hide');
}

function toggleInputField(el){
	var selc = '.'+el+'-input';
	//if ($('input:checkbox[name='+el+']').is(':checked')) {
	if($('#' + el).is(":checked")){
		$(selc).show();
	}else{
		$(selc).hide();
	} 
}


</script>



@endsection