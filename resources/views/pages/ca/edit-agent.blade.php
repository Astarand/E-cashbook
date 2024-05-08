@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Edit Agent</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="javascript:void(0);" method="post" name="addAgentFrm" id="addAgentFrm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="agentId" value="{{ $agent->id }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group-item">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Agent Name<span class="text-danger"> *</span></label>
                                            <input type="text" name="agent_name" id="agent_name" value="{{ $agent->agent_name}}" class="form-control" placeholder="Enter Agent Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Email<span class="text-danger"> *</span></label>
                                            <input type="email" readonly name="agent_email" id="agent_email" value="{{ $agent->agent_email}}" class="form-control" placeholder="Enter Email">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Agent Phone Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="agent_phone" id="agent_phone" value="{{ $agent->agent_phone}}" class="form-control" placeholder="Enter Agent Phone Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Agent Whatsapp Number<span class="text-danger"> *</span></label>
                                            <input type="text" name="agent_whats_no" id="agent_whats_no" value="{{ $agent->agent_whats_no}}" class="form-control" placeholder="Enter Agent Whatsapp Number">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" id="company_name" value="{{ $agent->company_name}}" class="form-control" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label>Company Website</label>
                                            <input type="text" name="company_website" id="company_website" value="{{ $agent->company_website}}" class="form-control" placeholder="Enter Company Website">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Address Line 1</label>
                                            <input type="text" name="address_lineone" id="address_lineone" value="{{ $agent->address_lineone}}" class="form-control" placeholder="Enter Address Line 1">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Address Line 2</label>
                                            <input type="text" name="address_linetwo" id="address_linetwo" value="{{ $agent->address_linetwo}}" class="form-control" placeholder="Enter Address Line 2">
                                        </div>
                                    </div>
									<div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <select class="form-control select-style" name="agent_country" id="country" onChange="changeCountry(this);">
												<option value="">Select Country</option>
												@foreach($countries as $k=>$country)
												<option value="{{ $country->id }}" <?php echo ($country->id==$agent->agent_country)? "selected":"" ?>>{{ $country->name }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
									<div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>State</label>
											<select class="form-control select-style" name="agent_state" id="state" onChange="changeState(this);">
												<option value="">Select State</option>
												@foreach($states as $k=>$state)
													<option value="{{ $state->id }}" <?php echo ($state->id==$agent->agent_state)? "selected":"" ?>>{{ $state->name }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select class="form-control select-style" name="agent_city" id="city">
												<option value="">Select City</option>
												@foreach($cities as $k=>$city)
													<option value="{{ $city->id }}" <?php echo ($city->id==$agent->agent_city)? 'selected="selected"':"" ?>>{{ $city->name }}</option>
												@endforeach
											</select>
                                        </div>
                                    </div>
									
                                    
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text" name="agent_pincode" id="agent_pincode" value="{{ $agent->agent_pincode}}" class="form-control" placeholder="Enter Pincode">
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    
						<div id="addAgentLoader" class="loader"></div>
						<div class="message-container"></div>
						<div class="add-customer-btns text-end">
							<a href="{{ url('/agent')}}" id="cancel_attaBtn" class="btn customer-btn-cancel">Cancel</a>
							<button type="submit" id="save_attaBtn" class="btn customer-btn-save">Upload & Save</button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
@endsection
