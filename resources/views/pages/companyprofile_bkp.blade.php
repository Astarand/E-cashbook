@extends('layouts.default')

@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="content-page-header">
                    <h5>Update Your Company Profile</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="#">
                        <div class="card-body">
                            <h5 class="form-title">Basic Details</h5>
                            <div class="profile-picture">
                                <div class="upload-profile">
                                <div class="profile-img">
                                    <img id="image-preview" class="avatar" src="{{asset('public/assets/img/profiles/avatar-10.jpg')}}" alt>
                                </div>
                                <div class="add-profile">
                                    <h5>Upload Company Logo*</h5>
                                    <span id="name-preview"></span>
                                </div>
                                </div>
                                <div class="img-upload">
                                <label class="btn btn-primary">
                                Upload <input type="file" name="profile-image-uploader" id="profile-image-uploader">
                                </label>
                                <a class="btn btn-remove">Remove</a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a href="#info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active" aria-selected="true" role="tab">Company Details</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#details" data-bs-toggle="tab" aria-expanded="false" class="nav-link" aria-selected="true" role="tab">Business Details</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a href="#bank" data-bs-toggle="tab" aria-expanded="true" class="nav-link" aria-selected="true" role="tab">Bank Details</a>
                                        </li>
                                    
                                        <li class="nav-item" role="presentation">
                                            <a href="#attachments" data-bs-toggle="tab" aria-expanded="false" class="nav-link " aria-selected="true" role="tab">Attachments</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="info" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>GST Number</label>
                                                        <input type="email" class="form-control" placeholder="Enter Company GST Number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" class="form-control" placeholder="Company Name" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Company Email</label>
                                                        <input type="email" class="form-control" placeholder="Enter Email Address" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" id="mobile_code" class="form-control" placeholder="Phone Number" name="name" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>PAN Number</label>
                                                        <input type="text" class="form-control" placeholder="Enter PAN Number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="text" class="form-control" placeholder="Enter Website Address">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group-item">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="billing-btn mb-2">
                                                            <h5 class="form-title">Billing Address</h5>
                                                            <a href="#" class="btn btn-primary" onclick="addBillingAddress()">Add Branch</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 1</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address 1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 2</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address 2">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Country">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input type="text" class="form-control" placeholder="Enter City">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="text" class="form-control" placeholder="Enter State">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pincode</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Pincode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="billing-btn">
                                                            <h5 class="form-title mb-0">Shipping Address</h5>
                                                            <a href="#" class="btn btn-primary">Same as Billing Address</a>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 1</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address 1">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address Line 2</label>
                                                            <input type="text" class="form-control" placeholder="Enter Address 2">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Country</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Country">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>City</label>
                                                                    <input type="text" class="form-control" placeholder="Enter City">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <label>State</label>
                                                                    <input type="text" class="form-control" placeholder="Enter State">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Pincode</label>
                                                                    <input type="text" class="form-control" placeholder="Enter Pincode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                                <a href="customers.html" class="btn customer-btn-save">Save Changes</a>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="details" role="tabpanel">
                                            <div class="form-group-customer customer-additional-form">
                                                <div class="row">
                                                    <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Business Details</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group row pt-3">
                                                            <label class="col-lg-4 col-form-label pt-3">Company Nature</label>
                                                            <div class="col-lg-8 pt-3">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="company_nature" id="business" value="option1">
                                                                    <label class="form-check-label" for="business">Business</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="company_nature" id="service" value="option2">
                                                                    <label class="form-check-label" for="service">Service</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Exact Nature of Business</label>
                                                            <input type="text" class="form-control" placeholder="Nature of Business">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Turn over in Last Year</label>
                                                            <input type="text" class="form-control" placeholder="Turn over">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>No. of Project Done</label>
                                                            <input type="text" class="form-control" placeholder="No. of Project Done">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Credit Period</label>
                                                            <input type="text" class="datetimepicker form-control" placeholder="Select Period">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Credit Limit</label>
                                                            <input type="text" class="form-control" placeholder="Credit Limit">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                                <a href="customers.html" class="btn customer-btn-save">Upload & Save</a>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="bank" role="tabpanel">
                                            <div class="form-group-customer customer-additional-form">
                                                <div class="row">
                                                    <div class="billing-btn">
                                                        <h5 class="form-title mb-0">Bank Account(s)</h5>
                                                        <a href="#" class="btn btn-primary">Add Another Bank Accounts</a>
                                                        </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Bank Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Bank Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Branch</label>
                                                            <input type="text" class="form-control" name="branch" placeholder="Enter Branch Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Account Holder Name</label>
                                                            <input type="text" class="form-control" placeholder="Enter Account Holder Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>Account Number</label>
                                                            <input type="text" class="form-control" placeholder="Enter Account Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>IFSC</label>
                                                            <input type="text" class="form-control" placeholder="Enter IFSC Code">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label>UPI ID</label>
                                                            <input type="text" class="form-control" placeholder="Enter UPI ID">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                    <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                                    <a href="customers.html" class="btn customer-btn-save">Save Changes</a>
                                                </div>
                                        </div>

                                        <div class="tab-pane" id="attachments" role="tabpanel">
                                            <div class="row">
                                                <h5 class="text-muted pb-3">Statutory Details</h5>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload GSTIN Documents</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload PAN Documents</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your files here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign1">
                                                            <div id="frames1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload TAN Document</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload CIN Document</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5 class="text-muted py-3">Other Documents</h5>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload Logo</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload Signeture</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12 mb-3">   
                                                    <div class="form-group mb-0 pb-0">
                                                        <label>Upload Company Stamp</label>
                                                        <div class="form-group service-upload mb-0">
                                                            <span><img src="{{asset('public/assets/img/icons/drop-icon.svg')}}" alt="upload"></span>
                                                            <h6 class="drop-browse align-center">Drop your file here or<span class="text-primary ms-1">browse</span></h6>
                                                            <p class="text-muted">Maximum size: 50MB</p>
                                                            <input type="file" id="image_sign">
                                                            <div id="frames"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="add-customer-btns text-end">
                                                <a href="customers.html" class="btn customer-btn-cancel">Cancel</a>
                                                <a href="customers.html" class="btn customer-btn-save">Upload & Save</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('jsscript')
<script type="text/javascript">
$(document).ready(function(){
    $('#profile-image-uploader').change(function(){
        readURL(this);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#name-preview').text($('#profile-image-uploader')[0].files[0].name);
                
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#image-preview').attr('src', '');
        }
    }
});
</script>
<script>
    let branchCount = 1; // Initialize branch count

function addBillingAddress(button) {
    // Clone the billing address section
    const billingAddressClone = document.querySelector('.form-group-item .col-md-6:first-child').cloneNode(true);

    // Clear the input fields in the cloned section
    const inputFields = billingAddressClone.querySelectorAll('input');
    inputFields.forEach(input => {
        input.value = '';
    });

    // Change the title to "Branch Address"
    const titleElement = billingAddressClone.querySelector('.form-title');
    titleElement.textContent = `Branch Address ${branchCount}`;

    // Change the button text to "Delete this Branch" and add the deleteBranch function
    const deleteButton = billingAddressClone.querySelector('.btn-primary');
    deleteButton.textContent = 'Delete this Branch';
    deleteButton.onclick = function () {
        deleteBranch(this);
    };

    // Insert the cloned billing address section after the shipping address section
    const shippingAddressSection = document.querySelector('.form-group-item .col-md-6:last-child');
    shippingAddressSection.parentNode.insertBefore(billingAddressClone, shippingAddressSection.nextSibling);

    // Increment the branch count
    branchCount++;
}

function deleteBranch(button) {
    // Find the parent element of the button (the cloned billing address section) and remove it
    const branchSection = button.closest('.col-md-6');
    branchSection.parentNode.removeChild(branchSection);
}


</script>
@endsection