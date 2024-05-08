@extends('layouts.default')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="content-page-header">
                <h5>Add New Project</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
				<form action="javascript:void(0);" method="post" name="addProjectFrm" id="addProjectFrm" enctype="multipart/form-data">
					<input type="hidden" name="id" id="projId" value="">
					@csrf
                <div class="card-body">
                    <div class="form-group-item">
                        <h5 class="form-title">Project Details</h5>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Project Name <span class="text-danger"> *</span></label>
                                    <input type="text" name="proj_name" id="proj_name" class="form-control" placeholder="Enter Project Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label> Project Category<span class="text-danger"> *</span></label>
                                    <div class="form-group">
                                        <ul class="form-group-plus css-equal-heights">
                                            <li>
                                                <div class="form-group">
                                                    <select class="select form-select" name="proj_cat" id="proj_cat">
                                                        <option value="">Select Category</option>
                                                        <option value="1">Web Designer</option>
                                                        <option value="2">Web Developer</option>
                                                        <option value="3">App Developer</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="btn btn-primary form-plus-btn" href="#" data-bs-toggle="modal" data-bs-target="#project">
                                                    <i class="fe fe-plus-circle"></i>
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Project Status<span class="text-danger"> *</span></label>
                                    <div class="align-center">
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" class="form-control" name="proj_status" value="2" checked><span class="checkmark"></span> Yet to Start
                                            </label>
                                        </div>
                                        <div class="form-control me-3">
                                            <label class="custom_radio me-3 mb-0">
                                                <input type="radio" name="proj_status" value="3"><span class="checkmark"></span> Ongoing
                                            </label>
                                        </div>
                                        <div class="form-control">
                                            <label class="custom_radio mb-0">
                                                <input type="radio" name="proj_status" value="0"><span class="checkmark"></span> Not Complete
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs nav-bordered">
                                                <li class="nav-item">
                                                    <a href="#home-b1" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                        <strong>Client Details</strong>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#profile-b1" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                        <strong>Project Details</strong>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane show active" id="home-b1">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Name<span class="text-danger"> *</span></label>
                                                                <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Enter Client Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Email<span class="text-danger"> *</span></label>
                                                                <input type="email" name="client_email" id="client_email" class="form-control" placeholder="Enter Client Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Client Contact Number<span class="text-danger"> *</span></label>
                                                                <input type="text" name="client_contact" id="client_contact" class="form-control" placeholder="Enter Contact Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="profile-b1">
                                                    <div class="form-group-item">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Start Date<span class="text-danger"> *</span></label>
                                                                    <input type="Date" name="proj_start_date" id="proj_start_date" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project End Date<span class="text-danger"> *</span></label>
                                                                    <input type="Date" name="proj_end_date" id="proj_end_date" class="form-control" placeholder="Enter Contact Number">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Valuation<span class="text-danger"> *</span></label>
                                                                    <input type="text" name="proj_cost" id="proj_cost" class="form-control" placeholder="Enter Project Cost">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label>Project Details<span class="text-danger"> *</span></label>
                                                                    <input type="text" name="proj_details" id="proj_details" class="form-control" placeholder="Enter Project Details">
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
                    </div>

                    <div class="modal fade" id="project" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Add New Designation</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="javascript:void(0);" method="post" name="addDesignationFrm" id="addDesignationFrm">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Add New Project Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Project Name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="message-container"></div>
                                        <div id="addEmployeeLoader" class="loader"></div>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

					<div class="message-container"></div>
					<div id="addProjectLoader" class="loader"></div>
					<div class="add-customer-btns text-end">
						<a href="{{ url('/projects') }}" class="btn btn-primary cancel me-2">Cancel</a>
						<button type="submit" class="btn btn-primary">Add Project</button>
					</div>
                </div>

				</form>
			</div>
        </div>
    </div>
</div>



@endsection
