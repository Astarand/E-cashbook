@extends('layouts.default')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Bank Statement Upload</h5>
                    <div class="list-btn">
                        
                    </div>
                </div>
            </div>
           
            
			<form action="javascript:void(0);" method="post" name="bankStatementFrm" id="bankStatementFrm" enctype="multipart/form-data">
			@csrf
                
				<div class="row mb-4">
				
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label>Bank</label>
							<select class="form-select select2-hidden-accessible" name="bank_id" id="bank_id" data-select2-id="7" tabindex="-1" aria-hidden="true">
								<option value="">Select Bank</option>
								@foreach($banks as $k=>$bank)
									<option value="{{ $bank->id }}" >{{ $bank->bank_name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label>Start Date</label>
							<input type="date" name="startdate" id="startdate" class="form-control" >
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-12">
						<div class="form-group">
							<label>End Date</label>
							<input type="date" name="enddate" id="enddate" class="form-control" >
						</div>
					</div>
							
					<div class="col-xl-12 col-lg-12">
						
						<div class="form-group-bank">
							<div class="form-group mb-2">
								<label>Bank Statement</label>
								<div class="form-group mb-0">
									<span><i class="fe fe-upload-cloud me-1"></i>Upload Bank Statement</span>
									<input type="file" name="bankstatement" id="bankstatement">
									<div id="frames"></div>
								</div>
							</div>
						</div>
						<a href="{{asset('public/uploads/bank_statement/bankstatement.xlsx')}}" download>Download Sample Excel</a>
					</div>
				</div>
				
				<div class="message-container"></div>
				<div id="bankStatLoader" class="loader"></div>
				<div class="add-customer-btns text-end">
					<button type="submit" class="btn btn-primary">Upload</button>
				</div>
			</form>
				
           

        </div>
    </div>

    
@endsection






