//Class Active
document.addEventListener("DOMContentLoaded", function () {
    const menuLinks = document.querySelectorAll(".sidebar-menu a");

    // Get the last active menu item from localStorage, if available
    const lastActiveMenuItem = localStorage.getItem("activeMenuItem");

    menuLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            // Remove "active" class from all <li> elements
            const menuItems = document.querySelectorAll(".sidebar-menu li");
            menuItems.forEach((item) => {
                item.classList.remove("active");
            });

            // Add "active" class to the parent <li> element
            link.parentElement.classList.add("active");

            // Save the active menu item in localStorage
            localStorage.setItem("activeMenuItem", link.getAttribute("href"));
        });

        // Set the "active" class based on the stored active menu item
        if (lastActiveMenuItem && link.getAttribute("href") === lastActiveMenuItem) {
            link.parentElement.classList.add("active");
        }
    });
});


//Add More Brunch
	let branchCount = 1;

    function addBillingAddress(button) {

        const billingAddressClone = document.querySelector('.form-group-item .col-md-6:first-child').cloneNode(true);

        const inputFields = billingAddressClone.querySelectorAll('input');
        inputFields.forEach(input => {
            input.value = '';
        });

        const titleElement = billingAddressClone.querySelector('.form-title');
        titleElement.textContent = `Branch Address ${branchCount}`;

        const deleteButton = billingAddressClone.querySelector('.btn-primary');
        deleteButton.textContent = 'Delete this Branch';
        deleteButton.onclick = function () {
            deleteBranch(this);
        };
        const shippingAddressSection = document.querySelector('.form-group-item .col-md-6:last-child');
        shippingAddressSection.parentNode.insertBefore(billingAddressClone, shippingAddressSection.nextSibling);
        branchCount++;
    }

    function deleteBranch(button) {
        const branchSection = button.closest('.col-md-6');
        branchSection.parentNode.removeChild(branchSection);
    }
	//Photo Company Profile
	document.addEventListener('DOMContentLoaded', function () {
        function handleFileUpload(inputId, framesId) {
            const fileInput = document.getElementById(inputId);
            const framesDiv = document.getElementById(framesId);

            fileInput.addEventListener('change', function () {
                framesDiv.innerHTML = '';

                const files = this.files;
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    if (file.type.startsWith('image/')) {
                        const thumbnail = document.createElement('img');
                        thumbnail.classList.add('thumbnail');
                        thumbnail.src = URL.createObjectURL(file);
                        thumbnail.style.height = '150px';
                        thumbnail.style.width = '100px';
                        thumbnail.style.margin = '10px';

                        framesDiv.appendChild(thumbnail);
                    } else {
                        const unsupportedFile = document.createElement('p');
                        unsupportedFile.textContent = 'Unsupported File: ' + file.name;
                        framesDiv.appendChild(unsupportedFile);
                    }
                }
            });
        }

        handleFileUpload('gst_doc', 'frames1');
        handleFileUpload('pan_doc', 'frames2');
        handleFileUpload('tan_doc', 'frames3');
        handleFileUpload('cin_doc', 'frames4');
        handleFileUpload('other_logo_doc', 'frames5');
        handleFileUpload('signature_doc', 'frames6');
        handleFileUpload('stamp_doc', 'frames7');
    });

	function sameAsBillAddr(){
		$("#comp_ship_name").val($("#comp_bill_name").val());
		$("#comp_ship_addone").val($("#comp_bill_addone").val());
		$("#comp_ship_addtwo").val($("#comp_bill_addtwo").val());
		$('#country_ship').val($("#country option:selected").val()).prop('selected', true);

		var selStateOpt = $("#state option:selected");
		$('#state_ship').empty();
		selStateOpt.each(function(){
			$('#state_ship').append($(this).clone());
		});

		var selCityOpt = $("#city option:selected");
		$('#city_ship').empty();
		selCityOpt.each(function(){
			$('#city_ship').append($(this).clone());
		});
		$("#comp_ship_pin").val($("#comp_bill_pin").val());
	}
	
	function sameAsBillAddrSales(){
		$("#ship_name").val($("#bill_name").val());
		$("#ship_addone").val($("#bill_addone").val());
		$("#ship_addtwo").val($("#bill_addtwo").val());
		$('#country_ship').val($("#country option:selected").val()).prop('selected', true);

		var selStateOpt = $("#state option:selected");
		$('#state_ship').empty();
		selStateOpt.each(function(){
			$('#state_ship').append($(this).clone());
		});

		var selCityOpt = $("#city option:selected");
		$('#city_ship').empty();
		selCityOpt.each(function(){
			$('#city_ship').append($(this).clone());
		});
		$("#ship_pin").val($("#bill_pin").val());
	}

	function copyBillAddr(){
		$("#cust_ship_name").val($("#cust_bill_name").val());
		$("#cust_ship_addone").val($("#cust_bill_addone").val());
		$("#cust_ship_addtwo").val($("#cust_bill_addtwo").val());
		$('#country_ship').val($("#country option:selected").val()).prop('selected', true);

		var selStateOpt = $("#state option:selected");
		$('#state_ship').empty();
		selStateOpt.each(function(){
			$('#state_ship').append($(this).clone());
		});

		var selCityOpt = $("#city option:selected");
		$('#city_ship').empty();
		selCityOpt.each(function(){
			$('#city_ship').append($(this).clone());
		});
		$("#cust_ship_pin").val($("#cust_bill_pin").val());
	}

	function copVenbillAddr(){
		$("#shipping_name").val($("#billing_name").val());
		$("#shipping_address1").val($("#billing_address1").val());
		$("#shipping_address2").val($("#billing_address2").val());
		$('#country_ship').val($("#country option:selected").val()).prop('selected', true);

		var selStateOpt = $("#state option:selected");
		$('#state_ship').empty();
		selStateOpt.each(function(){
			$('#state_ship').append($(this).clone());
		});

		var selCityOpt = $("#city option:selected");
		$('#city_ship').empty();
		selCityOpt.each(function(){
			$('#city_ship').append($(this).clone());
		});
		$("#shipping_pincode").val($("#billing_pincode").val());
	}

	function sameAsAbove(){
		$("#cont_name").val($("#cust_name").val());
		$("#cont_no").val($("#cust_phone").val());
		$("#cont_email").val($("#cust_email").val());
	}

	function vansameAsAbove(){
		$("#cont_per_name").val($("#vendor_name").val());
		$("#cont_per_number").val($("#vendor_phone").val());
		$("#cont_per_email").val($("#vendor_email").val());
	}

$(function() {
	var base_url = $("#base_url").val();
	$.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//Start register
	var signupform = $('#signupform').validate({
			rules: {
				u_type: {
					required: true
				},
				name: {
					required: true,
					minlength: 3,
				},
				phone: {
					required: true,
					//minlength: 10,
					//maxlength: 10,
					number: true
				},
				email: {
					required: true,
					email:true
				},
				state_id: {
					required: true
				},
				city_id: {
					required: true
				},
				password: {
					required: true,
					minlength: 6
				},
				 confirm_Password: {
					required: true,
					minlength: 6,
					equalTo: "#password"
				},

			},
			messages: {
					u_type: {
						required: "Type is required",
					},
					name: {
						required: "Name is required",
					},
					phone: {
						required: "Mobile is required",
						//minlength: "10 characters at least"
					},
					email: {
						required: "Email is required",
					},
					state_id: {
						required: "State is required"
					},
					city_id: {
						required: "City is required"
					},
					password: {
						required: "Password is required",
						minlength: "6 characters at least"
					},
					 confirm_Password: {
						required: "Re-type your password",
						equalTo: "Password does not match"
					},

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#signupform').bind('submit',function(){

				if (signupform.form()) {

					$('#registerLoader').show();
					var formDataReg = {
						 u_type : $('input[name="u_type"]:checked').val(),
						 name : $("#signupform #name").val(),
						 phone : $("#signupform #phone").val(),
						 email : $("#signupform #email").val(),
						 state_id : $("#state option:selected").val(),
						 city_id : $("#city option:selected").val(),
						 password : $("#signupform #password").val()

					}

					$.ajax({
						url: base_url + '/register/user',
						type:'POST',
						data:formDataReg,
						success: function(response) {
							//$("#signupform button[type=submit]").removeAttr('disabled');
							$('#registerLoader').hide();
							if (response.class=="succ") {
								//$("#signupform .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								window.location.href=response.redirect;

							} else {
								/* if(response.email!=""){
									$("#signupform .message-container").html('<div class="err">'+response.email+'</div>');
								}
								*/
								$('#loader').hide();
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#signupform .message-container").html('<div class="err">'+obj+'</div>');
								});

							}
						}
					});


				}
			});
		//Start login user
		var loginform = $('#loginform').validate({
			rules: {

				username: {
					required: true,
					email:true
				},
				password: {
					required: true,
				}

			},
			messages: {

				username: {
					required: "Email is required",
				},
				password: {
					required: "Password is required",
				}

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `help-block` class to the error element
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
			submitHandler: function(form) {
				//$("#loginform button[type=submit]").attr('disabled', true);
				$("#loginLoader").show();
				var username = $("#loginform #username").val();
				var Password = $("#loginform #password").val();
				var remember = $('#cb1').prop('checked'); // true


				var loginForm = $("#loginForm");
				var formData = loginForm.serialize();
				 var formData = {
						email: $("#loginform #username").val(),
						password: $("#loginform #password").val(),
						remember : $('#cb1').prop('checked')
					}

				$.ajax({
					url: base_url + '/login/user',
					type:'POST',
					data:formData,
					success:function(response){
						$("#loginLoader").hide();
						if (response.class=="succ") {
							window.location=response.redirect;
						}else{
							$("#loginform .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							setTimeout(function() {
								$("#loginform .message-container div").fadeOut(300, function() {
									$("#loginform .message-container").html('');
								});
							}, 10000);

						}
					},
					error: function (data) {

					}
				});

			}
		});

		//Start forgot password
		var forgotform = $('#forgotform').validate({
			rules: {

				username: {
					required: true,
					email:true
				}

			},
			messages: {

				username: {
					required: "Email is required",
				}

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				// Add the `help-block` class to the error element
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
			submitHandler: function(form) {
				//$("#forgotform button[type=submit]").attr('disabled', true);
				var username = $("#forgotform #username").val();



				var forgotform = $("#forgotform");
				var formDataPass = forgotform.serialize();
				var formDataPass = {
						email: $("#forgotform #username").val()
					}

				$.ajax({
					url: base_url + '/save_forgotpassword',
					type:'POST',
					data:formDataPass,
					success:function(response){
							$("#forgotform .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							setTimeout(function() {
								$("#forgotform .message-container div").fadeOut(300, function() {
									$("#forgotform .message-container").html('');
								});
							}, 10000);
					},
					error: function (data) {

					}
				});

			}
		});

	//Start update company details
	var frmcompdet = $('#frmcompdet').validate({
			rules: {
				comp_gst_no: {
					required: true
				},
				comp_name: {
					required: true,
					minlength: 3,
				},
				comp_phone: {
					required: true,
					minlength: 10,
					maxlength: 10,
					number: true
				},
				comp_email: {
					required: true,
					email:true
				},
				comp_pan_no: {
					required: true,
					minlength: 10
				},
				comp_website: {
					//required: true
				},
				comp_bill_name: {
					required: true
				},
				comp_bill_addone: {
					required: true
				},
				comp_bill_country: {
					required: true
				},
				comp_bill_state: {
					required: true
				},
				comp_bill_city: {
					required: true
				},
				comp_bill_pin: {
					required: true
				},

				comp_ship_name: {
					required: true
				},
				comp_ship_addone: {
					required: true
				},
				comp_ship_country: {
					required: true
				},
				comp_ship_state: {
					required: true
				},
				comp_ship_city: {
					required: true
				},
				comp_ship_pin: {
					required: true
				},

			},

			messages: {
					comp_gst_no: {
						required: "GST no. is required",
					},
					comp_name: {
						required: "Name is required",
					},
					comp_phone: {
						required: "Mobile is required",
						minlength: "10 digits at least"
					},
					comp_email: {
						required: "Email is required",
					},
					comp_pan_no: {
						required: "PAN no. is required",
						minlength: "10 characters at least"
					},
					 comp_website: {
						//required: "website is required"
					},
					comp_bill_name: {
						required: "Name is required",
					},
					comp_bill_addone: {
						required: "Address line1 is required",
					},
					comp_bill_country: {
						required: "Country is required",
					},
					comp_bill_state: {
						required: "State is required",
					},
					comp_bill_city: {
						required: "City is required",
					},
					comp_bill_pin: {
						required: "Pincode is required",
					},
					comp_ship_name: {
						required: "Name is required",
					},
					comp_ship_addone: {
						required: "Address line1 is required",
					},
					comp_ship_country: {
						required: "Country is required",
					},
					comp_ship_state: {
						required: "State is required",
					},
					comp_ship_city: {
						required: "City is required",
					},
					comp_ship_pin: {
						required: "Pincode is required",
					},

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#frmcompdet').bind('submit',function(){

				if (frmcompdet.form()) {

					$('#loader').show();
					var formCompData = {
						 comp_gst_no : $("#frmcompdet #comp_gst_no").val(),
						 comp_name : $("#frmcompdet #comp_name").val(),
						 comp_phone : $("#frmcompdet #comp_phone").val(),
						 comp_email : $("#frmcompdet #comp_email").val(),
						 comp_pan_no : $("#frmcompdet #comp_pan_no").val(),
						 comp_website : $("#frmcompdet #comp_website").val(),

						 comp_bill_name : $("#frmcompdet #comp_bill_name").val(),
						 comp_bill_addone : $("#frmcompdet #comp_bill_addone").val(),
						 comp_bill_addtwo : $("#frmcompdet #comp_bill_addtwo").val(),
						 comp_bill_country : $("#frmcompdet #country option:selected").val(),
						 comp_bill_state : $("#frmcompdet #state option:selected").val(),
						 comp_bill_city : $("#frmcompdet #city option:selected").val(),
						 comp_bill_pin : $("#frmcompdet #comp_bill_pin").val(),

						 comp_ship_name : $("#frmcompdet #comp_ship_name").val(),
						 comp_ship_addone : $("#frmcompdet #comp_ship_addone").val(),
						 comp_ship_addtwo : $("#frmcompdet #comp_ship_addtwo").val(),
						 comp_ship_country : $("#frmcompdet #country_ship option:selected").val(),
						 comp_ship_state : $("#frmcompdet #state_ship option:selected").val(),
						 comp_ship_city : $("#frmcompdet #city_ship option:selected").val(),
						 comp_ship_pin : $("#frmcompdet #comp_ship_pin").val(),


					}
					$.ajax({
						url: base_url + '/update_compdet',
						type:'POST',
						data:formCompData,
						success: function(response) {
							if (response.class=="succ") {
								$("#frmcompdet .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							} else {
								$('#loader').hide();
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#frmcompdet .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});

	//Start company business details
	var frmbusdet = $('#frmbusdet').validate({
			rules: {
				comp_nature: {
					required: true
				},
				exact_comp_nature: {
					required: true
				},
				turnover_last_year: {
					required: true,
					number: true
				},
				no_of_project: {
					required: true
				},
				credit_period: {
					required: true
				},
				 credit_limit: {
					required: true
				},

			},
			messages: {
					comp_nature: {
						required: "Company nature is required",
					},
					exact_comp_nature: {
						required: "Nature of business is required",
					},
					turnover_last_year: {
						required: "Turnover is required",
					},
					no_of_project: {
						required: "No. of project is required",
					},
					credit_period: {
						required: "credit period is required",
					},
					 credit_limit: {
						required: "credit limit is required"
					},

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#frmbusdet').bind('submit',function(){

				if (frmbusdet.form()) {
					$('#loader').show();
					var formCompBusData = {
						 comp_nature : $('input[name="comp_nature"]:checked').val(),
						 exact_comp_nature : $("#frmbusdet #exact_comp_nature").val(),
						 turnover_last_year : $("#frmbusdet #turnover_last_year").val(),
						 no_of_project : $("#frmbusdet #no_of_project").val(),
						 credit_period : $("#frmbusdet #credit_period").val(),
						 credit_limit : $("#frmbusdet #credit_limit").val()
					}
					$.ajax({
						url: base_url + '/update_businessdet',
						type:'POST',
						data:formCompBusData,
						success: function(response) {
							if (response.class=="succ") {
								$("#frmbusdet .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							} else {
								$('#loader').hide();
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#frmbusdet .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});

	//Start company bank details
	var frmbankdet = $('#frmbankdet').validate({
		rules: {
			bank_name: {
				required: true
			},
			bank_branch: {
				required: true
			},
			bank_holder_name: {
				required: true
			},
			ac_no: {
				required: true,
				number: true
			},
			ifsc_code: {
				required: true
			},
			 ac_upid: {
				required: true
			},

		},
		messages: {
				bank_name: {
					required: "Bank name is required",
				},
				bank_branch: {
					required: "Brance is required",
				},
				bank_holder_name: {
					required: "Name is required",
				},
				ac_no: {
					required: "A/C is required",
				},
				ifsc_code: {
					required: "IFSC is required",
				},
				 ac_upid: {
					required: "UPID is required"
				},

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		//$('form#frmbankdet').bind('submit',function(){
		$('form#frmbankdet').on('submit',function(e){
			//e.preventDefault();
			if (frmbankdet.form()) {
				$('#loader').show();
				var formCompBank = $('form#frmbankdet').serialize();
				$.ajax({
					url: base_url + '/update_bankdet',
					type:'POST',
					data:formCompBank,
					success: function(response) {
						if (response.class=="succ") {
							$("#frmbankdet .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								$("#frmbankdet .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});

		//Start company attachments update
		var gstdocstate = $("#gstdocstate").val();
		if(gstdocstate =="")
		{
			var frmattadet = $('#frmattadet').validate({
				rules: {
					gst_doc: {
						required: true
					},
					pan_doc: {
						required: true
					},
					tan_doc: {
						required: true
					},
					cin_doc: {
						required: true
					},
					other_logo_doc: {
						required: true
					},
					signature_doc: {
						required: true
					},
					stamp_doc: {
						required: true
					},
				},
				messages: {
					gst_doc: {
						required: "GST doc is required"
					},
					pan_doc: {
						required: "PAN doc is required"
					},
					tan_doc: {
						required: "TAN doc is required"
					},
					cin_doc: {
						required: "CIN doc is required"
					},
					other_logo_doc: {
						required: "Logo is required"
					},
					signature_doc: {
						required: "Signature doc is required"
					},
					stamp_doc: {
						required: "Stamp doc is required"
					},
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
		}else{
				var frmattadet = $('#frmattadet').validate({
				rules: {
				},
				messages: {
				},
			});

		}

		$('form#frmattadet').bind('submit',function(){
			if (frmattadet.form()) {
				$('#loader').show();
				let gst_doc = $('#frmattadet #gst_doc').prop('files')[0];
				let pan_doc = $('#frmattadet #pan_doc').prop('files')[0];
				let tan_doc = $('#frmattadet #tan_doc').prop('files')[0];
				let cin_doc =   $('#frmattadet #cin_doc').prop('files')[0];
				let other_logo_doc =   $('#frmattadet #other_logo_doc').prop('files')[0];
				let signature_doc =   $('#frmattadet #signature_doc').prop('files')[0];
				let stamp_doc =   $('#frmattadet #stamp_doc').prop('files')[0];

				let comp_atta_data = new FormData();

				comp_atta_data.append('gst_doc', gst_doc);
				comp_atta_data.append('pan_doc', pan_doc);
				comp_atta_data.append('tan_doc', tan_doc);
				comp_atta_data.append('cin_doc', cin_doc);
				comp_atta_data.append('other_logo_doc', other_logo_doc);
				comp_atta_data.append('signature_doc', signature_doc);
				comp_atta_data.append('stamp_doc', stamp_doc);
				comp_atta_data.append('gstdocstate', gstdocstate);
				$.ajax({
					url: base_url + '/update_comp_attachment',
					type:'POST',
					data:comp_atta_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.class=="succ") {
							$("#gstdocstate").val(response.gstdocstate);
							$("#frmattadet .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								//alert(obj);
								$("#frmattadet .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});

		//Start company update profile
		var frmprofileimage = $('#frmprofileimage').validate({
			rules: {
				comp_logo: {
					required: true
				},
			},
			messages: {
				comp_logo: {
					required: "Image is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$("#comp_logo").change(function() {
			if (frmprofileimage.form()) {
				$('#loader').show();
				let comp_logo = $('#frmprofileimage #comp_logo').prop('files')[0];
				let comp_profile_data = new FormData();
				comp_profile_data.append('comp_logo', comp_logo);

				$.ajax({
					url: base_url + '/update_comp_logo',
					type:'POST',
					data:comp_profile_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.class=="succ") {
							$("#frmprofileimage .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							$('#image-preview').attr('src', base_url+'/public/uploads/profile/'+response.image_name);
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								console.log(obj);
								$("#frmprofileimage .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});

		//Delete company logo delete
		$(".compimagedel").click(function() {
				$('#loader').show();
				let comp_logo_data = new FormData();

				$.ajax({
					url: base_url + '/delete_comp_logo',
					type:'POST',
					data:comp_logo_data,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.class=="succ") {
							$("#frmprofileimage .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							$('#image-preview').attr('src', base_url+'/public/assets/img/profiles/avatar-10.jpg');
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								console.log(obj);
								$("#frmprofileimage .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
		});

		//Start add customer
		$("form#add_cust_bill #prevBtnTwo").on("click",function(){
			$("#tab-B").removeClass("active");
			$("#tab-A").addClass("active");

			$("#details") .hide();
			$("#info") .show();
			$("#info") .addClass('show');
			$("#info") .addClass('active');
		});

		$("form#add_cust_bank #prevBtnThree").on("click",function(){
			$("#tab-C").removeClass("active");
			$("#tab-B").addClass("active");

			$("#bank") .hide();
			$("#details") .show();
			$("#details") .addClass('show');
			$("#details") .addClass('active');
		});

		var addCustDetails = $("#add_cust_detail").validate({
			rules: {

				cust_value: {
					required: true
				},
				cust_pan: {
					required: true
				},
				cust_name: {
					required: true
				},
				cust_gst_no: {
					required: true
				},
				cust_gst_type: {
					required: true
				},
				cust_email: {
					required: true,
					email: true
				},
				cust_phone: {
					required: true,
					number: true,
					minlength:10,
					maxlength:10
				},
				cont_name: {
					required: true
				},
				cont_no: {
					required: true,
					number: true,
					minlength:10,
					maxlength:10
				},
				cont_email: {
					required: true,
					email: true
				},
				cont_notes: {
					required: true
				},

			},
		messages: {
				cust_value: {
					required: "Priority is required"
				},
				cust_pan: {
					required: "PAN is required"
				},
				cust_name: {
					required: "Name is required"
				},
				cust_gst_no: {
					required: "GST no. is required"
				},
				cust_gst_type: {
					required: "GST type is required"
				},
				cust_email: {
					required: "Email is required"
				},
				cust_phone: {
					required: "Phone is required"
				},
				cont_name: {
					required: "Name is required"
				},
				cont_no: {
					required: "Contact is required"
				},
				cont_email: {
					required: "Email is required"
				},
				cont_notes: {
					required: "Notes is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});


		$("form#add_cust_detail #nxtBtnOne").on("click",function(){
				if (addCustDetails.form()) {

					//$("#add_cust_form .message-container").html('');

					$("#tab-A").removeClass("active");
					$("#tab-B").addClass("active");

					$("#info") .hide();
					$("#details") .show();
					$("#details") .addClass('show');
					$("#details") .addClass('active');
				}
		});


		var addCustBillDet = $("#add_cust_bill").validate({
			rules: {

				cust_bill_name: {
					required: true
				},
				cust_bill_addone: {
					required: true
				},
				cust_bill_country: {
					required: true
				},
				cust_bill_state: {
					required: true
				},
				cust_bill_city: {
					required: true
				},
				cust_bill_pin: {
					required: true,
					number: true
				},

				cust_ship_name: {
					required: true
				},
				cust_ship_addone: {
					required: true
				},
				cust_ship_country: {
					required: true
				},
				cust_ship_state: {
					required: true
				},
				cust_ship_city: {
					required: true
				},
				cust_ship_pin: {
					required: true,
					number: true
				},

			},
		messages: {
				cust_bill_name: {
					required: "Name is required",
				},
				cust_bill_addone: {
					required: "Address line1 is required",
				},
				cust_bill_country: {
					required: "Country is required",
				},
				cust_bill_state: {
					required: "State is required",
				},
				cust_bill_city: {
					required: "City is required",
				},
				cust_bill_pin: {
					required: "Pincode is required",
				},
				cust_ship_name: {
					required: "Name is required",
				},
				cust_ship_addone: {
					required: "Address line1 is required",
				},
				cust_ship_country: {
					required: "Country is required",
				},
				cust_ship_state: {
					required: "State is required",
				},
				cust_ship_city: {
					required: "City is required",
				},
				cust_ship_pin: {
					required: "Pincode is required",
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$("form#add_cust_bill #nxtBtnTwo").on("click",function(){
			if (addCustBillDet.form()) {
				//$("#add_cust_form .message-container").html('');

				$("#tab-B").removeClass("active");
				$("#tab-C").addClass("active");

				$("#details") .hide();
				$("#bank") .show();
				$("#bank") .addClass('show');
				$("#bank") .addClass('active');
			}
		});

		var addCustBank = $('#add_cust_bank').validate({
		rules: {
			cust_bank_name: {
				required: true
			},
			cust_bank_branch: {
				required: true
			},
			cust_bank_holder_name: {
				required: true
			},
			cust_ac_no: {
				required: true,
				number: true
			},
			cust_ifsc_code: {
				required: true
			},
			cust_ac_upid: {
				required: true
			},

		},
		messages: {
				cust_bank_name: {
					required: "Bank name is required",
				},
				cust_bank_branch: {
					required: "Brance is required",
				},
				cust_bank_holder_name: {
					required: "Name is required",
				},
				cust_ac_no: {
					required: "A/C is required",
				},
				cust_ifsc_code: {
					required: "IFSC is required",
				},
				cust_ac_upid: {
					required: "UPID is required"
				},

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#add_cust_bank').bind('submit',function(){
			if (addCustBank.form()) {
				$('#addCustomerLoader').show();
				var formCustomerData = $('form#add_cust_detail').serialize()+ '&' + $('form#add_cust_bill').serialize() + '&' + $('form#add_cust_bank').serialize();
				var custId = $("#custId").val();
				if(custId =="") {
					var suburl = base_url + '/add_customer';
				}else{
					var suburl = base_url + '/update_customer';
				}
				$.ajax({
					url: suburl,
					type:'POST',
					data:formCustomerData,
					success: function(response) {
						$('#addCustomerLoader').hide();
						if (response.class=="succ") {
							//$("#add_cust_bank .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#add_cust_bank .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});
		//End add customer

		//Activate customer
		$('.cust_active').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/changeStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		//Delete customer
		$('.custdelete').click(function() {
			var cust_id = $(this).data('id');
			$('#del_cust').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delCustomer',
					data: {'id': cust_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});

		//start CA
		var chooseca = $("input[name='choose_ca']:checked").val();
		if(chooseca == 1){
			$("#nearestSearchDiv").show();
			$('#searchca').html("");
		}else{
			$("#nearestSearchDiv").hide();
			var ca_city = "";
			var ca_state = "";
			var ca_pincode = "";
			$.ajax({
				method: "POST",
				url: base_url + '/choose_ca',
				data: {'chooseca': chooseca, ca_city:ca_city, ca_state:ca_state, ca_pincode:ca_pincode},
				datatype: 'json',
				success: function(result){
				  //console.log(result)
				  $('#searchca').html(result);
				}
			});
		}
		$('input[type=radio][name=choose_ca]').change(function () {
			var chooseca = $(this).val();
			var ca_city = "";
			var ca_state = "";
			var ca_pincode = "";
			if(chooseca == 1){
				$("#nearestSearchDiv").show();
				$('#searchca').html("");
			}else{
				$("#nearestSearchDiv").hide();
				$.ajax({
					method: "POST",
					url: base_url + '/choose_ca',
					data: {'chooseca': chooseca, ca_city:ca_city, ca_state:ca_state, ca_pincode:ca_pincode},
					datatype: 'json',
					success: function(result){
					  //console.log(result)
					  $('#searchca').html(result);
					}
				});
			}
        });

		$('#searchyourca').click(function () {
			var chooseca = $(this).val();
			var ca_state = $("#state_ship option:selected").val();
			var ca_city = $("#city_ship option:selected").val();
			var ca_pincode = $("#ca_pincode").val();
			$('#searchca').html("");

			if(ca_city == "" || ca_state == ""){
				alert("Please fill state ans city details.");
			}else{
				$("#searchCaLoader").show();
				$.ajax({
					method: "POST",
					url: base_url + '/choose_ca',
					data: {'chooseca': chooseca, ca_city:ca_city, ca_state:ca_state, ca_pincode:ca_pincode},
					datatype: 'json',
					success: function(result){
					  //console.log(result)
					  $('#searchca').html(result);
					  $("#searchCaLoader").hide();
					}
				});
			}
        });

		var frmAssignCA = $('#frmAssignCA').validate({
		rules: {
			ca_name: {
				required: true
			},
			ca_email: {
				required: true,
				email: true
			},
			ca_phone: {
				required: true,
				number: true
			},
			ca_addr_one: {
				required: true
			},
			ca_state: {
				required: true
			},
			ca_city: {
				required: true
			},
			ca_pincode: {
				required: true,
				number: true
			},

		},
		messages: {
				ca_name: {
					required: "CA name is required"
				},
				ca_email: {
					required: "CA email is required"
				},
				ca_phone: {
					required: "CA phone is required"
				},
				ca_addr_one: {
					required: "CA address is required"
				},
				ca_state: {
					required: "CA state is required"
				},
				ca_city: {
					required: "CA city is required"
				},
				ca_pincode: {
					required: "pincode is required"
				},

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		//$('form#frmAssignCA').bind('submit',function(){
		$("form#frmAssignCA #nxtBtnAssign").on("click",function(){
			if (frmAssignCA.form()) {

				$("#firmlist-A").removeClass("active");
				$("#assignsection-B").addClass("active");

				$("#firmlist") .hide();
				$("#assignsection").show();
				$("#assignsection").addClass('show');
				$("#assignsection").addClass('active');
			}
		});

		//
		$("form#frmAssignSection #prevBtnTwo").on("click",function(){
			$("#assignsection-B").removeClass("active");
			$("#firmlist-A").addClass("active");

			$("#assignsection").hide();
			$("#firmlist").show();
			$("#firmlist").addClass('show');
			$("#firmlist").addClass('active');
		});

		$('form#frmAssignSection').bind('submit',function(){

				$('#frmAssignCALoader').show();
				//var formCAData = $('form#frmAssignCA').serialize();
				//var formCAData = $('form#frmAssignCA').serialize()+ '&' + $('form#frmAssignSection').serialize();
				var arr = [];
				var ca_set_permission = "";
				$("input[name='ca_set_permission[]']:checked").each(function ()
				{
					arr.push(($(this).val()));
				});
				ca_set_permission = arr.join(',');
				var formCAData = {
					 assign_ca_firm : $('input[name="assign_ca_firm"]:checked').val(),
					 ca_name : $("#frmAssignCA #ca_name").val(),
					 ca_email : $("#frmAssignCA #ca_email").val(),
					 ca_phone : $("#frmAssignCA #ca_phone").val(),
					 ca_addr_one : $("#frmAssignCA #ca_addr_one").val(),
					 ca_addr_two : $("#frmAssignCA #ca_addr_two").val(),
					 ca_state : $("#frmAssignCA #state option:selected").val(),
					 ca_city : $("#frmAssignCA #city option:selected").val(),
					 ca_pincode : $("#frmAssignCA #ca_pincode").val(),
					 ca_set_permission: ca_set_permission,
				}
				var subcaurl = base_url + '/register_ca';
				$.ajax({
					url: subcaurl,
					type:'POST',
					data:formCAData,
					success: function(response) {
						$('#frmAssignCALoader').hide();
						if (response.class=="succ") {
							$("#frmAssignSection .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
						} else {
							$.each(response, function(idx, obj) {
								$("#frmAssignSection .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});

		});

		//

		$('.request_active').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/completeStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		$('.is_email').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/isEmailStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		$('.is_whatsapp').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/isWhatsappStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		//add ca in admin
		var frmAssignOurCA = $('#frmAssignOurCA').validate({
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				number: true
			},
			addr_one: {
				required: true
			},
			ca_state: {
				required: true
			},
			ca_city: {
				required: true
			},
			pincode: {
				required: true,
				number: true
			},

		},
		messages: {
				name: {
					required: "CA name is required"
				},
				email: {
					required: "CA email is required"
				},
				phone: {
					required: "CA phone is required"
				},
				addr_one: {
					required: "CA address is required"
				},
				state: {
					required: "CA state is required"
				},
				ca_city: {
					required: "CA city is required"
				},
				pincode: {
					required: "pincode is required"
				},

			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#frmAssignOurCA').bind('submit',function(){
			if (frmAssignOurCA.form()) {
				$('#loader').show();
				var caId = $("#caId").val();
				//var formCAData = $('form#frmAssignOurCA').serialize();
				var formCAData = {
					 caId:caId,
					 //assign_ca_firm : 'ourca',
					 name : $("#frmAssignOurCA #name").val(),
					 email : $("#frmAssignOurCA #email").val(),
					 phone : $("#frmAssignOurCA #phone").val(),
					 addr_one : $("#frmAssignOurCA #addr_one").val(),
					 addr_two : $("#frmAssignOurCA #addr_two").val(),
					 ca_state : $("#frmAssignOurCA #state option:selected").val(),
					 ca_city : $("#frmAssignOurCA #city option:selected").val(),
					 pincode : $("#frmAssignOurCA #pincode").val(),
				}
				//var subcaurl = base_url + '/register_our_ca';
				if(caId =="") {
					var subcaurl = base_url + '/register_our_ca';
				}else{
					var subcaurl = base_url + '/update_ca';
				}
				$.ajax({
					url: subcaurl,
					type:'POST',
					data:formCAData,
					success: function(response) {
						if (response.class=="succ") {
							$('#loader').hide();
							$("#frmAssignOurCA .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								$("#frmAssignOurCA .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
		});

		$('.show_status').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/updateCaStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		$("#frmAssignCA").hide();
		$("#caFillOut").click(function(){
			$("#frmAssignCA").show();
		});
		//End CA

		//start add items

		var item_type = $("input[name='item_type']:checked").val();
		if (item_type == 'product') {
			$('#sac_code').attr('readonly', true);
			$('#hsn_code').attr('readonly', false);
			$(".sac_code_sec").hide();
			$(".hsn_code_sec").show();
		}
		else if (item_type == 'service') {
			$('#hsn_code').attr('readonly', true);
			$('#sac_code').attr('readonly', false);
			$(".sac_code_sec").show();
			$(".hsn_code_sec").hide();
		}

		$('input[type=radio][name=item_type]').change(function() {
			if (this.value == 'product') {
				$('#sac_code').attr('readonly', true);
				$('#hsn_code').attr('readonly', false);
				$(".sac_code_sec").hide();
				$(".hsn_code_sec").show();
			}
			else if (this.value == 'service') {
				$('#hsn_code').attr('readonly', true);
				$('#sac_code').attr('readonly', false);
				$(".sac_code_sec").show();
				$(".hsn_code_sec").hide();
			}
		});

		var addItemFrm = $('#addItemFrm').validate({
		rules: {
			item_name: {
				required: true
			},
			selling_price: {
				required: true,
				number: true
			},
			purchase_price: {
				required: true,
				number: true
			},
			 disc_sell: {
				required: true,
				number: true
			},

		},
		messages: {
				item_name: {
					required: "Item name is required"
				},
				selling_price: {
					required: "Selling price is required"
				},
				purchase_price: {
					required: "Purchase price is required"
				},
				 disc_sell: {
					required: "Discount is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addItemFrm').bind('submit',function(){
			//e.preventDefault();
			if (addItemFrm.form()) {
				$('#addItemLoader').show();
				var itemId = $("#itemId").val();
				if(itemId =="") {
					var itemurl = base_url + '/save_add_item';
				}else{
					var itemurl = base_url + '/update_item';
				}
				//var itemData = $('form#addItemFrm').serialize()+ '&' + $('form#baseUnitFrm').serialize();
				let  item_type = $("input[name='item_type']:checked").val();
				let  item_name = $("#addItemFrm #item_name").val();
				let  base_unit = $("#baseUnitFrm #base_unit option:selected").val();
				let  sec_unit = $("#baseUnitFrm #sec_unit option:selected").val();
				let  sac_code = $("#addItemFrm #sac_code").val();
				let  hsn_code = $("#addItemFrm #hsn_code").val();
				let  selling_price = $("#addItemFrm #selling_price").val();
				let  selling_tax = $("#addItemFrm #selling_tax option:selected").val();
				let  wholesale_price = $("#addItemFrm #wholesale_price").val();
				let  wholesale_tax = $("#addItemFrm #wholesale_tax option:selected").val();
				let  purchase_price = $("#addItemFrm #purchase_price").val();
				let  purchase_tax = $("#addItemFrm #purchase_tax option:selected").val();
				let  disc_sell = $("#addItemFrm #disc_sell").val();
				let  disc_sell_type = $("#addItemFrm #disc_sell_type option:selected").val();
				let  min_wholesale_quantity = $("#addItemFrm #min_wholesale_quantity").val();
				let  item_tax = $("#addItemFrm #item_tax").val();
				let  prod_desc = $("#addItemFrm #prod_desc").val();

				//let prod_image =   $('#addItemFrm #prod_image').prop('files')[0];
				const totalImages = $('#prod_image')[0].files.length;
				let prod_image =   $('#prod_image')[0];
				let itemData = new FormData();

				itemData.append('id', itemId);
				itemData.append('item_type', item_type);
				itemData.append('item_name', item_name);
				itemData.append('base_unit', base_unit);
				itemData.append('sec_unit', sec_unit);
				itemData.append('sac_code', sac_code);
				itemData.append('hsn_code', hsn_code);
				itemData.append('selling_price', selling_price);
				itemData.append('selling_tax', selling_tax);
				itemData.append('wholesale_price', wholesale_price);
				itemData.append('wholesale_tax', wholesale_tax);
				itemData.append('purchase_price', purchase_price);
				itemData.append('purchase_tax', purchase_tax);
				itemData.append('disc_sell', disc_sell);
				itemData.append('disc_sell_type', disc_sell_type);
				itemData.append('min_wholesale_quantity', min_wholesale_quantity);
				itemData.append('item_tax', item_tax);
				itemData.append('prod_desc', prod_desc);
				for(let i=0; i< totalImages;i++){
				 itemData.append('prod_image'+i, prod_image.files[i]);
				}
				itemData.append('totalImages', totalImages);

				$.ajax({
					url: itemurl,
					type:'POST',
					data:itemData,
					cache: false,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#addItemLoader').hide();
						if (response.class=="succ") {
							$("#addItemFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addItemFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});

		$('.itemdelete').click(function() {
			var itemId = $(this).data('id');
			$('#del_item').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delItem',
					data: {'id': itemId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});

		//end add items
		
		//Start add project
		
		var addProjectFrm = $('#addProjectFrm').validate({
		rules: {
			proj_name: {
				required: true
			},
			proj_cat: {
				required: true
			},
			proj_status: {
				required: true
			},
			client_name: {
				required: true
			},
			client_contact: {
				required: true,
				number:true
			},
			client_email: {
				required: true,
				email: true
			},
			proj_start_date: {
				required: true
			},
			proj_end_date: {
				required: true
			},
			proj_cost: {
				required: true,
				number: true
			},
			proj_details: {
				required: true
			},

		},
		messages: {
				proj_name: {
					required: "Project name is required"
				},
				proj_cat: {
					required: "Project category is required"
				},
				proj_status: {
					required: "Project status is required"
				},
				client_name: {
					required: "Client name is required"
				},
				client_contact: {
					required: "Client contact is required"
				},
				client_email: {
					required: "Client email is required"
				},
				proj_start_date: {
					required: "Project start date is required"
				},
				proj_end_date: {
					required: "Project end date is required"
				},
				proj_cost: {
					required: "Project cost is required"
				},
				proj_details: {
					required: "Project details is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addProjectFrm').bind('submit',function(){
			//e.preventDefault();
			if (addProjectFrm.form()) {
				$('#addProjectLoader').show();
				var projId = $("#projId").val();
				if(projId =="") {
					var projurl = base_url + '/save_add_project';
				}else{
					var projurl = base_url + '/update_project';
				}
				var projectData = $('form#addProjectFrm').serialize();
				

				$.ajax({
					url: projurl,
					type:'POST',
					data:projectData,
					success: function(response) {
						$('#addProjectLoader').hide();
						if (response.class=="succ") {
							$("#addProjectFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addProjectFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});
		
		$('.projectdelete').click(function() {
			var itemId = $(this).data('id');
			$('#del_project').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delProject',
					data: {'id': itemId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		$('.proj_active').click(function() {
			var status = $(this).data('stat');
			var cust_id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/changeProjectStatus',
				data: {'status': status, 'id': cust_id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		
		//End add project
		
		//Start add assets
		
		var addAssetFrm = $('#addAssetFrm').validate({
		rules: {
			asset_name: {
				required: true
			},
			branch_name: {
				required: true
			},
			asset_cat: {
				required: true
			},
			asset_sl_no: {
				required: true
			},
			purchase_date: {
				required: true
			},
			purchase_cost: {
				required: true,
				number: true
			},
			warranty_period: {
				required: true
			},
			opening_stock: {
				required: true
			},
			opening_it_act: {
				required: true
			},
			opening_comp_act: {
				required: true
			},
			desc_it: {
				required: true
			},
			desc_comp: {
				required: true
			},

		},
		messages: {
				asset_name: {
					required: "Asset name is required"
				},
				branch_name: {
					required: "Branch name is required"
				},
				asset_cat: {
					required: "Category is required"
				},
				asset_sl_no: {
					required: "Serial no. is required"
				},
				purchase_date: {
					required: "Date is required"
				},
				purchase_cost: {
					required: "Cost is required"
				},
				warranty_period: {
					required: "Date is required"
				},
				opening_stock: {
					required: "Stock is required"
				},
				opening_it_act: {
					required: "IT Act Wise is required"
				},
				opening_comp_act: {
					required: "Company Act is required"
				},
				desc_it: {
					required: "Description is required"
				},
				desc_comp: {
					required: "Description is required"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addAssetFrm').bind('submit',function(){
			//e.preventDefault();
			if (addAssetFrm.form()) {
				$('#addAssetLoader').show();
				var assetId = $("#assetId").val();
				if(assetId =="") {
					var projurl = base_url + '/save_add_asset';
				}else{
					var projurl = base_url + '/update_asset';
				}
				var projectData = $('form#addAssetFrm').serialize();
				

				$.ajax({
					url: projurl,
					type:'POST',
					data:projectData,
					success: function(response) {
						$('#addAssetLoader').hide();
						if (response.class=="succ") {
							$("#addAssetFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addAssetFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});
		
		$('.assetdelete').click(function() {
			var itemId = $(this).data('id');
			$('#del_asset').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delAsset',
					data: {'id': itemId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		//End add assets
		
		//Start Asset Voucher
		
		var addAssetVoucherFrm = $('#addAssetVoucherFrm').validate({
		rules: {
			v_type: {
				required: true
			},
			voucher_no: {
				required: true
			},
			voucher_name: {
				required: true
			},
			branch_name: {
				required: true
			},
			series_id: {
				required: true
			},
			invoice_date: {
				required: true
			},
			vendor_id: {
				required: true
			},
			inv_voucher_no: {
				required: true,
				number:true
			},
			total_cost: {
				required: true,
				number:true
			}

		},
		messages: {
				v_type: {
					required: "Type is required"
				},
				voucher_no: {
					required: "Voucher no. is required"
				},
				voucher_name: {
					required: "Name is required"
				},
				branch_name: {
					required: "Branch is required"
				},
				series_id: {
					required: "Series is required"
				},
				invoice_date: {
					required: "Date is required"
				},
				vendor_id: {
					required: "Vendor is required"
				},
				inv_voucher_no: {
					required: "Invoice no. is required"
				},
				total_cost: {
					required: "Total cost is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addAssetVoucherFrm').bind('submit',function(){
			//e.preventDefault();
			if (addAssetVoucherFrm.form()) {
				$('#addVocherLoader').show();
				var vId = $("#vId").val();
				if(vId =="") {
					var projurl = base_url + '/save_add_voucher';
				}else{
					var projurl = base_url + '/update_voucher';
				}
				var projectData = $('form#addAssetVoucherFrm').serialize();
				

				$.ajax({
					url: projurl,
					type:'POST',
					data:projectData,
					success: function(response) {
						$('#addVocherLoader').hide();
						if (response.class=="succ") {
							$("#addAssetVoucherFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addAssetVoucherFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});


			}
		});
		
		$('.assetVoucherDelete').click(function() {
			var itemId = $(this).data('id');
			$('#del_voucher').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delAssetVoucher',
					data: {'id': itemId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		var addSeriesFrm = $('#addSeriesFrm').validate({
		rules: {
			series_name: {
				required: true
			}
		},
		messages: {
				series_name: {
					required: "Series name is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addSeriesFrm').bind('submit',function(){
			//e.preventDefault();
			if (addSeriesFrm.form()) {
				var addurl = base_url + '/save_add_series_name';
				var seriesData = $('form#addSeriesFrm').serialize();

				$.ajax({
					url: addurl,
					type:'POST',
					data:seriesData,
					success: function(response) {
						if (response.class=="succ") {
							window.location.reload();
						} else {
							$.each(response, function(idx, obj) {
								$("#addSeriesFrm .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
						
					}
				});

			}
		});
		
		//End Asset Voucher
		
		//Start Add Sales
		
		var addSalesFrm = $('#addSalesFrm').validate({
			rules: {
				inv_num: {
					required: true
				},
				inv_name: {
					required: true,
					minlength: 3,
				},
				contact_no: {
					required: true,
					minlength: 10,
					maxlength: 10,
					number: true
				},
				branch_name: {
					required: true
				},
				trans_type: {
					required: true
				},
				tax_nature: {
					required: true
				},
				branch: {
					required: true
				},
				bill_to_party: {
					required: true
				},
				ship_to_party: {
					required: true
				},
				bill_name: {
					required: true
				},
				bill_addone: {
					required: true
				},
				bill_country: {
					required: true
				},
				bill_state: {
					required: true
				},
				bill_city: {
					required: true
				},
				bill_pin: {
					required: true
				},

				ship_name: {
					required: true
				},
				ship_addone: {
					required: true
				},
				ship_country: {
					required: true
				},
				ship_state: {
					required: true
				},
				ship_city: {
					required: true
				},
				ship_pin: {
					required: true
				},

			},

			messages: {
					inv_num: {
					required: "Invoice number is required"
					},
					inv_name: {
						required: "Invoice name is required"
					},
					contact_no: {
						required: "Contact is required"
					},
					branch_name: {
						required: "Branch is required"
					},
					trans_type: {
						required: "Type is required"
					},
					tax_nature: {
						required: "Tax nature is required"
					},
					branch: {
						required: "Branch is required"
					},
					bill_to_party: {
						required: "Party is required"
					},
					ship_to_party: {
						required: "Party is required"
					},
					bill_name: {
						required: "Name is required",
					},
					bill_addone: {
						required: "Address line1 is required",
					},
					bill_country: {
						required: "Country is required",
					},
					bill_state: {
						required: "State is required",
					},
					bill_city: {
						required: "City is required",
					},
					bill_pin: {
						required: "Pincode is required",
					},
					ship_name: {
						required: "Name is required",
					},
					ship_addone: {
						required: "Address line1 is required",
					},
					ship_country: {
						required: "Country is required",
					},
					ship_state: {
						required: "State is required",
					},
					ship_city: {
						required: "City is required",
					},
					ship_pin: {
						required: "Pincode is required",
					},

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#addSalesFrm').bind('submit',function(){

				if (addSalesFrm.form()) {
					$('#addSalesLoader').show();
					var sId = $("#sId").val();
					if(sId == ""){
						var surl = base_url + '/save_sales_invoice';
					}else{
						var surl = base_url + '/update_sales_invoice';
					}
					var salesData = $('form#addSalesFrm').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:salesData,
						success: function(response) {
							$('#addSalesLoader').hide();
							if (response.class=="succ") {
								//$("#addSalesFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								if(sId =="") {
									window.location.href=response.redirect;
								}
								$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#info") .hide();
								$("#details") .show();
								$("#details") .addClass('show');
								$("#details") .addClass('active');
							} else {								
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#addSalesFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
			$("form#addSalesFrm #nextBtn").on("click",function(){
				$("#tab-A").removeClass("active");
				$("#tab-B").addClass("active");

				$("#info") .hide();
				$("#details") .show();
				$("#details") .addClass('show');
				$("#details") .addClass('active');
			});
			
			$("form#addSalesFrmTwo #prevBtn").on("click",function(){
				$("#tab-B").removeClass("active");
				$("#tab-A").addClass("active");

				$("#details") .hide();
				$("#info") .show();
				$("#info") .addClass('show');
				$("#info") .addClass('active');
			});
			
		var signature = $("form#addSalesFrmTwo #sign").val();
		if(signature =="")
		{
			var addSalesFrmTwo = $('#addSalesFrmTwo').validate({
				rules: {
					signature: {
						required: true
					},
					signature_name: {
						required: true
					}
				},
				messages: {
					signature: {
						required: "Signature image is required"
					},
					signature_name: {
						required: "Signature name is required"
					}
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
		}else{
				var addSalesFrmTwo = $('#addSalesFrmTwo').validate({
					rules: {
						signature_name: {
							required: true
						}
					},
					messages: {
						signature_name: {
							required: "Signature name is required"
						}
					}			
				});
		}

		$('form#addSalesFrmTwo').bind('submit',function(){
			if (addSalesFrmTwo.form()) {
				$('#editSalesLoader').show();
				let signature = $('#addSalesFrmTwo #signature').prop('files')[0];
				let signature_name = $('#addSalesFrmTwo #signature_name').val();
				let id = $('#sId').val();
				let sales_data = new FormData();

				sales_data.append('signature', signature);
				sales_data.append('signature_name', signature_name);
				sales_data.append('id', id);
				
				$.ajax({
					url: base_url + '/update_sales_invoice_final',
					type:'POST',
					data:sales_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#editSalesLoader').hide();
						if (response.class=="succ") {
							$("#addSalesFrmTwo .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addSalesFrmTwo .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});

			}
		});
			
		var addSalesFrmThree = $('#addSalesFrmThree').validate({
		rules: {
			rate: {
				required: true,
				number:true
			},
			disc_amt: {
				required: true,
				number:true
			},
			tax_type: {
				required: true
			}

		},
		messages: {
				rate: {
					required: "Rate is required"
				},
				disc_amt: {
					required: "Discount is required"
				},
				tax_type: {
					required: "Tax type is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addSalesFrmThree').bind('submit',function(){
			//e.preventDefault();
			if (addSalesFrmThree.form()) {
				var itemurl = base_url + '/update_sales_item';
				var editData = $('form#addSalesFrmThree').serialize();
				
				$('form#addSalesFrmTwo #invoiceData').html('');
				$.ajax({
					url: itemurl,
					type:'POST',
					data:editData,
					success: function(result) {
						$('form#addSalesFrmTwo #invoiceData').html(result);
					}
				});


			}
		});
			
		$('#prod_id').change(function () {
			var prod_id = $('#prod_id option:selected').val();
			var sId = $("#sId").val();
			if(prod_id != ""){
				$("#invoiceData").html('');
				$.ajax({
					method: "POST",
					url: base_url + '/sales_items_display',
					data: {'sId':sId,'prod_id': prod_id},
					datatype: 'json',
					success: function(result){
					  //console.log(result)
					  $('#invoiceData').html(result);
					}
				});
			}
		});
		
		$('.invoicedelete').click(function() {
			var sId = $(this).data('id');
			$('#del_invoice').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delInvoice',
					data: {'id': sId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		$('.inv_active').click(function() {
			var status = $(this).data('stat');
			var id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/activateStatus',
				data: {'status': status, 'id': id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		//End Add Sales
		
		//Start Add Sales creditdebit
		
		var salesCreditDebitFrm = $('#salesCreditDebitFrm').validate({
			rules: {
				v_num: {
					required: true
				},
				v_name: {
					required: true,
					minlength: 3,
				},
				contact_no: {
					required: true,
					minlength: 10,
					maxlength: 10,
					number: true
				},
				branch_name: {
					required: true
				},
				note_type: {
					required: true
				},
				return_reason: {
					required: true
				},
				purchase_no: {
					required: true
				},
				purchase_date: {
					required: true
				},
				sales_no: {
					required: true
				},
				sales_date: {
					required: true
				},
				doc_no: {
					required: true
				},
				doc_date: {
					required: true
				},
				challan_no: {
					required: true
				},
				challan_date: {
					required: true
				},
				v_date: {
					required: true
				},

				v_due_date: {
					required: true
				},
				v_no: {
					required: true
				},
				trans_type: {
					required: true
				},
				tax_nature: {
					required: true
				}

			},

			messages: {
					v_num: {
						required: "Voucher no. is required"
					},
					v_name: {
						required: "Voucher name is required"
					},
					contact_no: {
						required: "Contact no. is required"
					},
					branch_name: {
						required:  "Branch is required"
					},
					note_type: {
						required:  "Note is required"
					},
					return_reason: {
						required:  "Reason is required"
					},
					purchase_no: {
						required:  "Purchase no. is required"
					},
					purchase_date: {
						required:  "Purchase date is required"
					},
					sales_no: {
						required:  "Sales no. is required"
					},
					sales_date: {
						required:  "Sales date is required"
					},
					doc_no: {
						required:  "Document date is required"
					},
					doc_date: {
						required:  "Document date is required"
					},
					challan_no: {
						required:  "Challan no. is required"
					},
					challan_date: {
						required:  "Challan date is required"
					},
					v_date: {
						required:  "Date is required"
					},
					v_due_date: {
						required:  "Due date is required"
					},
					v_no: {
						required:  "Voucher no. is required"
					},
					trans_type: {
						required: "Transaction type is required"
					},
					tax_nature: {
						required:  "Tax nature is required"
					}

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#salesCreditDebitFrm').bind('submit',function(){

				if (salesCreditDebitFrm.form()) {
					$('#addSalesLoader').show();
					var sId = $("#sId").val();
					if(sId == ""){
						var surl = base_url + '/save_sales_invoice_creditdebit';
					}else{
						var surl = base_url + '/update_sales_invoice_creditdebit';
					}
					var salesData = $('form#salesCreditDebitFrm').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:salesData,
						success: function(response) {
							$('#addSalesLoader').hide();
							if (response.class=="succ") {
								//$("#salesCreditDebitFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								if(sId =="") {
									window.location.href=response.redirect;
								}
								$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#info") .hide();
								$("#details") .show();
								$("#details") .addClass('show');
								$("#details") .addClass('active');
							} else {								
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#salesCreditDebitFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
			$("form#salesCreditDebitFrm #nextBtn").on("click",function(){
				$("#tab-A").removeClass("active");
				$("#tab-B").addClass("active");

				$("#info") .hide();
				$("#details") .show();
				$("#details") .addClass('show');
				$("#details") .addClass('active');
			});
			
			$("form#salesCreditDebitFrmTwo #prevBtn").on("click",function(){
				$("#tab-B").removeClass("active");
				$("#tab-A").addClass("active");

				$("#details") .hide();
				$("#info") .show();
				$("#info") .addClass('show');
				$("#info") .addClass('active');
			});
			
		var signature = $("form#salesCreditDebitFrmTwo #sign").val();
		if(signature =="")
		{
			var salesCreditDebitFrmTwo = $('#salesCreditDebitFrmTwo').validate({
				rules: {
					signature: {
						required: true
					},
					signature_name: {
						required: true
					}
				},
				messages: {
					signature: {
						required: "Signature image is required"
					},
					signature_name: {
						required: "Signature name is required"
					}
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
		}else{
				var salesCreditDebitFrmTwo = $('#salesCreditDebitFrmTwo').validate({
					rules: {
						signature_name: {
							required: true
						}
					},
					messages: {
						signature_name: {
							required: "Signature name is required"
						}
					}			
				});
		}

		$('form#salesCreditDebitFrmTwo').bind('submit',function(){
			if (salesCreditDebitFrmTwo.form()) {
				$('#editSalesLoader').show();
				let signature = $('#salesCreditDebitFrmTwo #signature').prop('files')[0];
				let signature_name = $('#salesCreditDebitFrmTwo #signature_name').val();
				let id = $('#sId').val();
				let sales_data = new FormData();

				sales_data.append('signature', signature);
				sales_data.append('signature_name', signature_name);
				sales_data.append('id', id);
				
				$.ajax({
					url: base_url + '/update_sales_invoice_final_creditdebit',
					type:'POST',
					data:sales_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#editSalesLoader').hide();
						if (response.class=="succ") {
							$("#salesCreditDebitFrmTwo .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#salesCreditDebitFrmTwo .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});

			}
		});
			
		var salesCreditDebitFrmThree = $('#salesCreditDebitFrmThree').validate({
		rules: {
			rate: {
				required: true,
				number:true
			},
			disc_amt: {
				required: true,
				number:true
			},
			tax_type: {
				required: true
			}

		},
		messages: {
				rate: {
					required: "Rate is required"
				},
				disc_amt: {
					required: "Discount is required"
				},
				tax_type: {
					required: "Tax type is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#salesCreditDebitFrmThree').bind('submit',function(){
			//e.preventDefault();
			if (salesCreditDebitFrmThree.form()) {
				var itemurl = base_url + '/update_sales_item_creditdebit';
				var editData = $('form#salesCreditDebitFrmThree').serialize();
				
				$('form#salesCreditDebitFrmTwo #invoiceData').html('');
				$.ajax({
					url: itemurl,
					type:'POST',
					data:editData,
					success: function(result) {
						$('form#salesCreditDebitFrmTwo #invoiceData').html(result);
					}
				});


			}
		});
			
		$('#prod_id_credit_debit').change(function () {
			var prod_id = $('#prod_id_credit_debit option:selected').val();
			var sId = $("#sId").val();
			if(prod_id != ""){
				$("#invoiceData").html('');
				$.ajax({
					method: "POST",
					url: base_url + '/sales_items_display_creditdebit',
					data: {'sId':sId,'prod_id': prod_id},
					datatype: 'json',
					success: function(result){
					  //console.log(result)
					  $('#invoiceData').html(result);
					}
				});
			}
		});
		
		$('.invoiceCreditDebitdelete').click(function() {
			var sId = $(this).data('id');
			$('#del_invoice_creditdebit').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delInvoiceCreditDebit',
					data: {'id': sId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		$('.inv_active_creditDebit').click(function() {
			var status = $(this).data('stat');
			var id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/activateSalesCreditDebitStatus',
				data: {'status': status, 'id': id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		
		$('.inv_paid_creditDebit').click(function() {
			var status = $(this).data('stat');
			var id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/paidInvCreditDebit',
				data: {'status': status, 'id': id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		//End Add Sales creditdebit

			//Start add Vendor
			$("form#add_vendor_bill #prevBtnTwo").on("click",function(){	
				$("#tab-B").removeClass("active");
				$("#tab-A").addClass("active");
	
				$("#details") .hide();
				$("#info") .show();
				$("#info") .addClass('show');
				$("#info") .addClass('active');
			});
	
			$("form#add_vendor_bank #prevBtnThree").on("click",function(){
					$("#tab-C").removeClass("active");
					$("#tab-B").addClass("active");
	
					$("#bank") .hide();
					$("#details") .show();
					$("#details") .addClass('show');
					$("#details") .addClass('active');
			});
	
			var addVendorDetails = $("#add_vendor_detail").validate({
				rules: {
	
					vendor_priority: {
						required: true
					},
					vendor_name: {
						required: true
					},
					vendor_pan: {
						required: true
					},
					vendor_gstin: {
						required: true
					},
					vendor_gst_type: {
						required: true
					},
					vendor_email: {
						required: true,
						email: true
					},
					vendor_phone: {
						required: true,
						number: true,
						minlength:10,
						maxlength:10
					},
					cont_per_name: {
						required: true
					},
					cont_per_number: {
						required: true,
						number: true,
						minlength:10,
						maxlength:10
					},
					cont_per_email: {
						required: true,
						email: true
					},
					special_note: {
						required: true
					},
	
				},
			messages: {
				vendor_priority: {
						required: "Priority is required"
					},
					vendor_pan: {
						required: "PAN is required"
					},
					vendor_name: {
						required: "Name is required"
					},
					vendor_gstin: {
						required: "GST no. is required"
					},
					vendor_gst_type: {
						required: "GST type is required"
					},
					vendor_email: {
						required: "Email is required"
					},
					vendor_phone: {
						required: "Phone is required"
					},
					cont_per_name: {
						required: "Name is required"
					},
					cont_per_number: {
						required: "Contact is required"
					},
					cont_per_email: {
						required: "Email is required"
					},
					special_note: {
						required: "Notes is required"
					},
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
	
	
			$("form#add_vendor_detail #nxtBtnVOne").on("click",function(){
				
					if (addVendorDetails.form()) {
	
						//$("#add_cust_form .message-container").html('');
	
						$("#tab-A").removeClass("active");
						$("#tab-B").addClass("active");
	
						$("#info") .hide();
						$("#details") .show();
						$("#details") .addClass('show');
						$("#details") .addClass('active');
					}
			});
	
	
			var addVendorBillDet = $("#add_vendor_bill").validate({
				rules: {
	
					billing_name: {
						required: true
					},
					billing_address1: {
						required: true
					},
					billing_country: {
						required: true
					},
					billing_state: {
						required: true
					},
					billing_city: {
						required: true
					},
					billing_pincode: {
						required: true,
						number: true
					},
	
					shipping_name: {
						required: true
					},
					shipping_address1: {
						required: true
					},
					shipping_country: {
						required: true
					},
					shipping_state: {
						required: true
					},
					shipping_city: {
						required: true
					},
					shipping_pincode: {
						required: true,
						number: true
					},
	
				},
			messages: {
				billing_name: {
						required: "Name is required",
					},
					billing_address1: {
						required: "Address line1 is required",
					},
					billing_country: {
						required: "Country is required",
					},
					billing_state: {
						required: "State is required",
					},
					billing_city: {
						required: "City is required",
					},
					billing_pincode: {
						required: "Pincode is required",
					},
					shipping_name: {
						required: "Name is required",
					},
					shipping_address1: {
						required: "Address line1 is required",
					},
					shipping_country: {
						required: "Country is required",
					},
					shipping_state: {
						required: "State is required",
					},
					shipping_city: {
						required: "City is required",
					},
					shipping_pincode: {
						required: "Pincode is required",
					},
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
	
			$("form#add_vendor_bill #nxtBtnVTwo").on("click",function(){
				if (addVendorBillDet.form()) {
					//$("#add_cust_form .message-container").html('');
	
					$("#tab-B").removeClass("active");
					$("#tab-C").addClass("active");
	
					$("#details") .hide();
					$("#bank") .show();
					$("#bank") .addClass('show');
					$("#bank") .addClass('active');
				}
			});
	
			var addVendorBank = $('#add_vendor_bank').validate({
			rules: {
				bank_name: {
					required: true
				},
				bank_branch: {
					required: true
				},
				acc_holder_name: {
					required: true
				},
				acc_number: {
					required: true,
					number: true
				},
				acc_ifsc: {
					required: true
				},
				acc_upi_id: {
					required: true
				},
	
			},
			messages: {
				bank_name: {
						required: "Bank name is required",
					},
					bank_branch: {
						required: "Brance is required",
					},
					acc_holder_name: {
						required: "Name is required",
					},
					acc_number: {
						required: "A/C is required",
					},
					acc_ifsc: {
						required: "IFSC is required",
					},
					acc_upi_id: {
						required: "UPID is required"
					},
	
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
	
			$('form#add_vendor_bank').bind('submit',function(){
				if (addVendorBank.form()) {
					$('#addCustomerLoader').show();
					var formVendorData = $('form#add_vendor_detail').serialize()+ '&' + $('form#add_vendor_bill').serialize() + '&' + $('form#add_vendor_bank').serialize();
					
					var vendorId = $("#vendorId").val();
					//alert(vendorId);
					if(vendorId =="") {						
						var suburl = base_url + '/saveaddvendor';
					}else{						
						var suburl = base_url + '/update_vendor';
					}
					$.ajax({
						url: suburl,
						type:'POST',
						data:formVendorData,					
						success: function(response) {
							//alert(response);
							$('#addCustomerLoader').hide();
							if (response.class=="succ") {
								//alert('Helwo');
								//$("#add_vendor_bank .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								window.location.href=response.redirect;
							} else {
								//alert('Hello');
								$.each(response, function(idx, obj) {
									$("#add_vendor_bank .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});
				}
			});
			//End vendor

				//Delete customer
		$('.vendordelete').click(function() {
			var vendor_id = $(this).data('id');			
			$('#del_vendor').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/deleteVendor',
					data: {'id': vendor_id},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		
		//Start Add Purchase Invoice
		var addPurchaseFrm = $('#addPurchaseFrm').validate({
			rules: {
				inv_num: {
					required: true
				},
				inv_name: {
					required: true,
					minlength: 3,
				},
				contact_no: {
					required: true,
					minlength: 10,
					maxlength: 10,
					number: true
				},
				branch_name: {
					required: true
				},
				trans_type: {
					required: true
				},
				tax_nature: {
					required: true
				},
				branch: {
					required: true
				},
				bill_to_party: {
					required: true
				},
				ship_to_party: {
					required: true
				},
				bill_name: {
					required: true
				},
				bill_addone: {
					required: true
				},
				bill_country: {
					required: true
				},
				bill_state: {
					required: true
				},
				bill_city: {
					required: true
				},
				bill_pin: {
					required: true
				},

				ship_name: {
					required: true
				},
				ship_addone: {
					required: true
				},
				ship_country: {
					required: true
				},
				ship_state: {
					required: true
				},
				ship_city: {
					required: true
				},
				ship_pin: {
					required: true
				},

			},

			messages: {
					inv_num: {
					required: "Invoice number is required"
					},
					inv_name: {
						required: "Invoice name is required"
					},
					contact_no: {
						required: "Contact is required"
					},
					branch_name: {
						required: "Branch is required"
					},
					trans_type: {
						required: "Type is required"
					},
					tax_nature: {
						required: "Tax nature is required"
					},
					branch: {
						required: "Branch is required"
					},
					bill_to_party: {
						required: "Party is required"
					},
					ship_to_party: {
						required: "Party is required"
					},
					bill_name: {
						required: "Name is required",
					},
					bill_addone: {
						required: "Address line1 is required",
					},
					bill_country: {
						required: "Country is required",
					},
					bill_state: {
						required: "State is required",
					},
					bill_city: {
						required: "City is required",
					},
					bill_pin: {
						required: "Pincode is required",
					},
					ship_name: {
						required: "Name is required",
					},
					ship_addone: {
						required: "Address line1 is required",
					},
					ship_country: {
						required: "Country is required",
					},
					ship_state: {
						required: "State is required",
					},
					ship_city: {
						required: "City is required",
					},
					ship_pin: {
						required: "Pincode is required",
					},

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#addPurchaseFrm').bind('submit',function(){

				if (addPurchaseFrm.form()) {
					$('#addSalesLoader').show();
					var sId = $("#sId").val();
					if(sId == ""){
						var surl = base_url + '/save_purchase_invoice';
					}else{
						var surl = base_url + '/update_purchase_invoice';
					}
					var salesData = $('form#addPurchaseFrm').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:salesData,
						success: function(response) {
							$('#addSalesLoader').hide();
							if (response.class=="succ") {
								//$("#addPurchaseFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								if(sId =="") {
									window.location.href=response.redirect;
								}
								$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#info") .hide();
								$("#details") .show();
								$("#details") .addClass('show');
								$("#details") .addClass('active');
							} else {								
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#addPurchaseFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
			$("form#addPurchaseFrm #nextBtn").on("click",function(){
				$("#tab-A").removeClass("active");
				$("#tab-B").addClass("active");

				$("#info") .hide();
				$("#details") .show();
				$("#details") .addClass('show');
				$("#details") .addClass('active');
			});
			
			$("form#addPurchaseFrmTwo #prevBtn").on("click",function(){
				$("#tab-B").removeClass("active");
				$("#tab-A").addClass("active");

				$("#details") .hide();
				$("#info") .show();
				$("#info") .addClass('show');
				$("#info") .addClass('active');
			});
			
		var signature = $("form#addPurchaseFrmTwo #sign").val();
		if(signature =="")
		{
			var addPurchaseFrmTwo = $('#addPurchaseFrmTwo').validate({
				rules: {
					signature: {
						required: true
					},
					signature_name: {
						required: true
					}
				},
				messages: {
					signature: {
						required: "Signature image is required"
					},
					signature_name: {
						required: "Signature name is required"
					}
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
		}else{
				var addPurchaseFrmTwo = $('#addPurchaseFrmTwo').validate({
					rules: {
						signature_name: {
							required: true
						}
					},
					messages: {
						signature_name: {
							required: "Signature name is required"
						}
					}			
				});
		}

		$('form#addPurchaseFrmTwo').bind('submit',function(){
			if (addPurchaseFrmTwo.form()) {
				$('#editSalesLoader').show();
				let signature = $('#addPurchaseFrmTwo #signature').prop('files')[0];
				let signature_name = $('#addPurchaseFrmTwo #signature_name').val();
				let id = $('#sId').val();
				let sales_data = new FormData();

				sales_data.append('signature', signature);
				sales_data.append('signature_name', signature_name);
				sales_data.append('id', id);
				
				$.ajax({
					url: base_url + '/update_purchase_invoice_final',
					type:'POST',
					data:sales_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#editSalesLoader').hide();
						if (response.class=="succ") {
							$("#addPurchaseFrmTwo .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#addPurchaseFrmTwo .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});

			}
		});
			
		var addPurchaseFrmThree = $('#addPurchaseFrmThree').validate({
		rules: {
			rate: {
				required: true,
				number:true
			},
			disc_amt: {
				required: true,
				number:true
			},
			tax_type: {
				required: true
			}

		},
		messages: {
				rate: {
					required: "Rate is required"
				},
				disc_amt: {
					required: "Discount is required"
				},
				tax_type: {
					required: "Tax type is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#addPurchaseFrmThree').bind('submit',function(){
			//e.preventDefault();
			if (addPurchaseFrmThree.form()) {
				var itemurl = base_url + '/update_purchase_item';
				var editData = $('form#addPurchaseFrmThree').serialize();
				
				$('form#addPurchaseFrmTwo #invoiceData').html('');
				$.ajax({
					url: itemurl,
					type:'POST',
					data:editData,
					success: function(result) {
						$('form#addPurchaseFrmTwo #invoiceData').html(result);
					}
				});


			}
		});
			
		$('#purchase_prod_id').change(function () {
			var prod_id = $('#purchase_prod_id option:selected').val();
			var sId = $("#sId").val();
			if(prod_id != ""){
				$("#invoiceData").html('');
				$.ajax({
					method: "POST",
					url: base_url + '/purchase_items_display',
					data: {'sId':sId,'prod_id': prod_id},
					datatype: 'json',
					success: function(result){
					  //console.log(result)
					  $('#invoiceData').html(result);
					}
				});
			}
		});
		
		$('.invoicePurdelete').click(function() {
			var sId = $(this).data('id');
			$('#del_purchase_invoice').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delInvoicePurchase',
					data: {'id': sId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		$('.inv_pur_active').click(function() {
			var status = $(this).data('stat');
			var id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/activateStatusPurchase',
				data: {'status': status, 'id': id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		//End Add Purchase Invoice
		
		//Start Add Purchase creditdebit
		
		var purchaseCreditDebitFrm = $('#purchaseCreditDebitFrm').validate({
			rules: {
				v_num: {
					required: true
				},
				v_name: {
					required: true,
					minlength: 3,
				},
				contact_no: {
					required: true,
					minlength: 10,
					maxlength: 10,
					number: true
				},
				branch_name: {
					required: true
				},
				note_type: {
					required: true
				},
				return_reason: {
					required: true
				},
				purchase_no: {
					required: true
				},
				purchase_date: {
					required: true
				},
				sales_no: {
					required: true
				},
				sales_date: {
					required: true
				},
				doc_no: {
					required: true
				},
				doc_date: {
					required: true
				},
				challan_no: {
					required: true
				},
				challan_date: {
					required: true
				},
				v_date: {
					required: true
				},

				v_due_date: {
					required: true
				},
				v_no: {
					required: true
				},
				trans_type: {
					required: true
				},
				tax_nature: {
					required: true
				}

			},

			messages: {
					v_num: {
						required: "Voucher no. is required"
					},
					v_name: {
						required: "Voucher name is required"
					},
					contact_no: {
						required: "Contact no. is required"
					},
					branch_name: {
						required:  "Branch is required"
					},
					note_type: {
						required:  "Note is required"
					},
					return_reason: {
						required:  "Reason is required"
					},
					purchase_no: {
						required:  "Purchase no. is required"
					},
					purchase_date: {
						required:  "Purchase date is required"
					},
					sales_no: {
						required:  "Sales no. is required"
					},
					sales_date: {
						required:  "Sales date is required"
					},
					doc_no: {
						required:  "Document date is required"
					},
					doc_date: {
						required:  "Document date is required"
					},
					challan_no: {
						required:  "Challan no. is required"
					},
					challan_date: {
						required:  "Challan date is required"
					},
					v_date: {
						required:  "Date is required"
					},
					v_due_date: {
						required:  "Due date is required"
					},
					v_no: {
						required:  "Voucher no. is required"
					},
					trans_type: {
						required: "Transaction type is required"
					},
					tax_nature: {
						required:  "Tax nature is required"
					}

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#purchaseCreditDebitFrm').bind('submit',function(){

				if (purchaseCreditDebitFrm.form()) {
					$('#addSalesLoader').show();
					var sId = $("#sId").val();
					if(sId == ""){
						var surl = base_url + '/save_purchase_invoice_creditdebit';
					}else{
						var surl = base_url + '/update_purchase_invoice_creditdebit';
					}
					var salesData = $('form#purchaseCreditDebitFrm').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:salesData,
						success: function(response) {
							$('#addSalesLoader').hide();
							if (response.class=="succ") {
								//$("#purchaseCreditDebitFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								if(sId =="") {
									window.location.href=response.redirect;
								}
								$("#tab-A").removeClass("active");
								$("#tab-B").addClass("active");

								$("#info") .hide();
								$("#details") .show();
								$("#details") .addClass('show');
								$("#details") .addClass('active');
							} else {								
								$.each(response, function(idx, obj) {
									//alert(obj);
									$("#purchaseCreditDebitFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
			$("form#purchaseCreditDebitFrm #nextBtn").on("click",function(){
				$("#tab-A").removeClass("active");
				$("#tab-B").addClass("active");

				$("#info") .hide();
				$("#details") .show();
				$("#details") .addClass('show');
				$("#details") .addClass('active');
			});
			
			$("form#purchaseCreditDebitFrmTwo #prevBtn").on("click",function(){
				$("#tab-B").removeClass("active");
				$("#tab-A").addClass("active");

				$("#details") .hide();
				$("#info") .show();
				$("#info") .addClass('show');
				$("#info") .addClass('active');
			});
			
		var signature = $("form#purchaseCreditDebitFrmTwo #sign").val();
		if(signature =="")
		{
			var purchaseCreditDebitFrmTwo = $('#purchaseCreditDebitFrmTwo').validate({
				rules: {
					signature: {
						required: true
					},
					signature_name: {
						required: true
					}
				},
				messages: {
					signature: {
						required: "Signature image is required"
					},
					signature_name: {
						required: "Signature name is required"
					}
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});
		}else{
				var purchaseCreditDebitFrmTwo = $('#purchaseCreditDebitFrmTwo').validate({
					rules: {
						signature_name: {
							required: true
						}
					},
					messages: {
						signature_name: {
							required: "Signature name is required"
						}
					}			
				});
		}

		$('form#purchaseCreditDebitFrmTwo').bind('submit',function(){
			if (purchaseCreditDebitFrmTwo.form()) {
				$('#editSalesLoader').show();
				let signature = $('#purchaseCreditDebitFrmTwo #signature').prop('files')[0];
				let signature_name = $('#purchaseCreditDebitFrmTwo #signature_name').val();
				let id = $('#sId').val();
				let sales_data = new FormData();

				sales_data.append('signature', signature);
				sales_data.append('signature_name', signature_name);
				sales_data.append('id', id);
				
				$.ajax({
					url: base_url + '/update_purchase_invoice_final_creditdebit',
					type:'POST',
					data:sales_data,
					contentType: false,
					processData: false,
					success: function(response) {
						$('#editSalesLoader').hide();
						if (response.class=="succ") {
							$("#purchaseCreditDebitFrmTwo .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
							window.location.href=response.redirect;
						} else {
							$.each(response, function(idx, obj) {
								$("#purchaseCreditDebitFrmTwo .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});

			}
		});
			
		var purchaseCreditDebitFrmThree = $('#purchaseCreditDebitFrmThree').validate({
		rules: {
			rate: {
				required: true,
				number:true
			},
			disc_amt: {
				required: true,
				number:true
			},
			tax_type: {
				required: true
			}

		},
		messages: {
				rate: {
					required: "Rate is required"
				},
				disc_amt: {
					required: "Discount is required"
				},
				tax_type: {
					required: "Tax type is required"
				}
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
				error.addClass("help-block");
				error.insertAfter(element);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("has-error").removeClass("has-success");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("has-success").removeClass("has-error");
			},
		});

		$('form#purchaseCreditDebitFrmThree').bind('submit',function(){
			//e.preventDefault();
			if (purchaseCreditDebitFrmThree.form()) {
				var itemurl = base_url + '/update_purchase_item_creditdebit';
				var editData = $('form#purchaseCreditDebitFrmThree').serialize();
				
				$('form#purchaseCreditDebitFrmTwo #invoiceData').html('');
				$.ajax({
					url: itemurl,
					type:'POST',
					data:editData,
					success: function(result) {
						$('form#purchaseCreditDebitFrmTwo #invoiceData').html(result);
					}
				});


			}
		});
			
		$('#prod_id_purchase_credit_debit').change(function () {
			var prod_id = $('#prod_id_purchase_credit_debit option:selected').val();
			var sId = $("#sId").val();
			if(prod_id != ""){
				$("#invoiceData").html('');
				$.ajax({
					method: "POST",
					url: base_url + '/purchase_items_display_creditdebit',
					data: {'sId':sId,'prod_id': prod_id},
					datatype: 'json',
					success: function(result){
					  //console.log(result)
					  $('#invoiceData').html(result);
					}
				});
			}
		});
		
		$('.purchaseCreditDebitdelete').click(function() {
			var sId = $(this).data('id');
			$('#del_purchase_creditdebit').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delPurchaseCreditDebit',
					data: {'id': sId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		$('.pur_active_creditDebit').click(function() {
			var status = $(this).data('stat');
			var id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/activatePurchaseCreditDebitStatus',
				data: {'status': status, 'id': id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});
		
		$('.pur_paid_creditDebit').click(function() {
			var status = $(this).data('stat');
			var id = $(this).data('id');
			$.ajax({
				type: "GET",
				dataType: "json",
				url: base_url + '/paidPurchaseCreditDebit',
				data: {'status': status, 'id': id},
				success: function(data){
				  //console.log(data.success)
				  window.location.href=data.redirect;

				}
			});
		});

		//End Add Purchase creditdebit
		
		//Start for Expenses
		
		var addExpenseFrm = $('#addExpenseFrm').validate({
			rules: {
				expense_date: {
					required: true
				},
				pur_of_expense: {
					required: true,
					minlength: 3,
				},
				mode_of_expense: {
					required: true
				},
				expense_cat: {
					required: true
				},
				expense_type: {
					required: true
				},
				expense_amt: {
					required: true,
					number:true
				},
				expense_msg: {
					required: true
				}

			},

			messages: {
					expense_date: {
						required: "Expense date is required"
					},
					pur_of_expense: {
						required: "Purpose is required",
					},
					mode_of_expense: {
						required: "Mode of expense is required"
					},
					expense_cat: {
						required: "Expense category is required"
					},
					expense_type: {
						required: "Expense type is required"
					},
					expense_amt: {
						required: "Amount is required"
					},
					expense_msg: {
						required: "Message is required"
					}

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#addExpenseFrm').bind('submit',function(){

				if (addExpenseFrm.form()) {
					$('#expenseLoader').show();
					var eId = $("#eId").val();
					if(eId == ""){
						var surl = base_url + '/save_expenses';
					}else{
						var surl = base_url + '/update_expenses';
					}
					var expensesData = $('form#addExpenseFrm').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:expensesData,
						success: function(response) {
							$('#expenseLoader').hide();
							if (response.class=="succ") {
								$("#addExpenseFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								window.location.href=response.redirect;
							} else {								
								$.each(response, function(idx, obj) {
									$("#addExpenseFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
			
		$('.expensedelete').click(function() {
			var eId = $(this).data('id');
			$('#del_expense').click(function() {
				$.ajax({
					type: "GET",
					dataType: "json",
					url: base_url + '/delExpenses',
					data: {'id': eId},
					success: function(data){
					  //console.log(data.success)
					  window.location.href=data.redirect;

					}
				});
			});
		});
		
		//End for Expenses

		//Start for Payment
		
		var addPaymentFrm = $('#payment_detail').validate({
			rules: {
				payment_date: {
					required: true
				},
				purpose_of_payment: {
					required: true
				},
				mode_of_payment: {
					required: true
				},
				payment_type: {
					required: true
				},
				amount: {
					required: true
				},
				message: {
					required: true
				},
				

			},

			messages: {
				payment_date: {
						required: "Payment date is required"
					},
					purpose_of_payment: {
						required: "Purpose is required",
					},
					mode_of_payment: {
						required: "Mode of expense is required"
					},
					payment_type: {
						required: "Expense category is required"
					},
					amount: {
						required: "Expense type is required"
					},
					message: {
						required: "Message is required"
					}

				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#payment_detail').bind('submit',function(){
				//alert('Hi');
				if (addPaymentFrm.form()) {
					$('#paymentLoader').show();
					var payId = $("#custId").val();
					//alert(payId);
					if(payId == ""){
						var surl = base_url + '/savepayment';
					}else{
						var surl = base_url + '/update_payment';
					}
					var paymentData = $('form#payment_detail').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:paymentData,
						success: function(response) {
							$('#paymentLoader').hide();
							if (response.class=="succ") {
								$("#addPaymentFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								window.location.href=response.redirect;
							} else {								
								$.each(response, function(idx, obj) {
									$("#addPaymentFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
			
			$('.paymentdelete').click(function() {
				var payId = $(this).data('id');
				$('#del_payment').click(function() {
					//alert('hi');
					$.ajax({
						type: "GET",
						dataType: "json",
						url: base_url + '/delPayment',
						data: {'id': payId},
						success: function(data){
						  //console.log(data.success)
						  window.location.href=data.redirect;
	
						}
					});
				});
			});
		// End Payment
		//Start for statutory
		
		var addStatutoryFrm = $('#addStatutoryFrm').validate({
			rules: {
				statutory_doc: {
					required: true
				},
				statutory_due_date: {
					required: true
				},
				statutory_msg: {
					required: true,
					minlength: 3,
				}
			},

			messages: {
				
					statutory_doc: {
						required: "Document is required"
					},
					statutory_due_date: {
						required: "Due date is required"
					},
					statutory_msg: {
						required: "Message is required",
					}
				},
				errorElement: "em",
				errorPlacement: function(error, element) {
					// Add the `help-block` class to the error element
					error.addClass("help-block");
					error.insertAfter(element);
				},
				highlight: function(element, errorClass, validClass) {
					$(element).addClass("has-error").removeClass("has-success");
				},
				unhighlight: function(element, errorClass, validClass) {
					$(element).addClass("has-success").removeClass("has-error");
				},
			});

			$('form#addStatutoryFrm').bind('submit',function(){

				if (addStatutoryFrm.form()) {
					$('#statutoryLoader').show();
					var eId = $("#eId").val();
					if(eId == ""){
						var surl = base_url + '/save_statutory';
					}else{
						var surl = base_url + '/update_statutory';
					}
					var expensesData = $('form#addStatutoryFrm').serialize();
					$.ajax({
						url: surl,
						type:'POST',
						data:expensesData,
						success: function(response) {
							$('#statutoryLoader').hide();
							if (response.class=="succ") {
								$("#addStatutoryFrm .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
								window.location.href=response.redirect;
							} else {								
								$.each(response, function(idx, obj) {
									$("#addStatutoryFrm .message-container").html('<div class="err">'+obj+'</div>');
								});
							}
						}
					});


				}
			});
		
		
		//End for statutory

});

	//Start sales items
	function delItem(el)
	{
		var salesItemId = "";
		var sid = "";
		salesItemId = $(el).data('id');
		sid = $(el).data('sid');
		var base_url = $("#base_url").val();
		$('#delItem').click(function() {
			$('form#addSalesFrmTwo #invoiceData').html('');
			$.ajax({
				method: "POST",
				//dataType: "json",
				url: base_url + '/delSalesItem',
				data: {'id': salesItemId,'sid': sid},
				success: function(result){
				 $('form#addSalesFrmTwo #invoiceData').html(result);
				}
			});	
		});
	}
	
	function editItem(el)
	{
		var id = $(el).data('id');
		var rate = $(el).data('rate');
		var discamt = $(el).data('discamt');
		var taxtype = $(el).data('taxtype');
		$("#sItemId").val(id);
		$("#rateEdit").val(rate);
		$("#disc_amt_edit").val(discamt);
		$("#tax_type_edit").val(taxtype);
	}
	
	function changeQuantity(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var prod_id = $(el).data('prod_id');
		var quantity = $("#quantity_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#addSalesFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_sales_item_quantity',
			data: {'id': id,'sid': sid,'prod_id':prod_id,'quantity':quantity},
			success: function(result){
			 $('form#addSalesFrmTwo #invoiceData').html(result);
			}
		});	
		
	}
	
	function changeRate(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var rate = $("#rate_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#addSalesFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_sales_item_rate',
			data: {'id': id,'sid': sid,'rate':rate},
			success: function(result){
			 $('form#addSalesFrmTwo #invoiceData').html(result);
			}
		});	
		
	}

	//End sales items
	
	//Start sales items credit debit
	function delItemCreditDebit(el)
	{
		var salesItemId = "";
		var sid = "";
		salesItemId = $(el).data('id');
		sid = $(el).data('sid');
		var base_url = $("#base_url").val();
		$('#delItem').click(function() {
			$('form#salesCreditDebitFrmTwo #invoiceData').html('');
			$.ajax({
				method: "POST",
				//dataType: "json",
				url: base_url + '/delSalesItemCreditDebit',
				data: {'id': salesItemId,'sid': sid},
				success: function(result){
				 $('form#salesCreditDebitFrmTwo #invoiceData').html(result);
				}
			});	
		});
	}
	
	function editItemCreditDebit(el)
	{
		var id = $(el).data('id');
		var rate = $(el).data('rate');
		var discamt = $(el).data('discamt');
		var taxtype = $(el).data('taxtype');
		$("#sItemId").val(id);
		$("#rateEdit").val(rate);
		$("#disc_amt_edit").val(discamt);
		$("#tax_type_edit").val(taxtype);
	}
	
	function changeQuantityCreditDebit(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var prod_id = $(el).data('prod_id');
		var quantity = $("#quantity_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#salesCreditDebitFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_sales_item_quantity_creditdebit',
			data: {'id': id,'sid': sid,'prod_id':prod_id,'quantity':quantity},
			success: function(result){
			 $('form#salesCreditDebitFrmTwo #invoiceData').html(result);
			}
		});	
		
	}
	
	function changeRateCreditDebit(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var rate = $("#rate_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#salesCreditDebitFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_sales_item_rate_creditdebit',
			data: {'id': id,'sid': sid,'rate':rate},
			success: function(result){
			 $('form#salesCreditDebitFrmTwo #invoiceData').html(result);
			}
		});	
		
	}

	//End sales items credit debit
	
	//Start purchase items
	function delItemPurchase(el)
	{
		var salesItemId = "";
		var sid = "";
		salesItemId = $(el).data('id');
		sid = $(el).data('sid');
		var base_url = $("#base_url").val();
		$('#delItemPurchase').click(function() {
			$('form#addPurchaseFrmTwo #invoiceData').html('');
			$.ajax({
				method: "POST",
				//dataType: "json",
				url: base_url + '/delPurchaseItem',
				data: {'id': salesItemId,'sid': sid},
				success: function(result){
				 $('form#addPurchaseFrmTwo #invoiceData').html(result);
				}
			});	
		});
	}
	
	function editItemPurchase(el)
	{
		var id = $(el).data('id');
		var rate = $(el).data('rate');
		var discamt = $(el).data('discamt');
		var taxtype = $(el).data('taxtype');
		$("#sItemId").val(id);
		$("#rateEdit").val(rate);
		$("#disc_amt_edit").val(discamt);
		$("#tax_type_edit").val(taxtype);
	}
	
	function changeQuantityPurchase(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var prod_id = $(el).data('prod_id');
		var quantity = $("#quantity_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#addPurchaseFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_purchase_item_quantity',
			data: {'id': id,'sid': sid,'prod_id':prod_id,'quantity':quantity},
			success: function(result){
			 $('form#addPurchaseFrmTwo #invoiceData').html(result);
			}
		});	
		
	}
	
	function changeRatePurchase(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var rate = $("#rate_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#addPurchaseFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_purchase_item_rate',
			data: {'id': id,'sid': sid,'rate':rate},
			success: function(result){
			 $('form#addPurchaseFrmTwo #invoiceData').html(result);
			}
		});	
		
	}
	//End purchase items
	
	//Start purchase items credit debit
	function delItemPurchaseCreditDebit(el)
	{
		var salesItemId = "";
		var sid = "";
		salesItemId = $(el).data('id');
		sid = $(el).data('sid');
		var base_url = $("#base_url").val();
		$('#delItemPurchase').click(function() {
			$('form#purchaseCreditDebitFrmTwo #invoiceData').html('');
			$.ajax({
				method: "POST",
				//dataType: "json",
				url: base_url + '/delPurchaseItemCreditDebit',
				data: {'id': salesItemId,'sid': sid},
				success: function(result){
				 $('form#purchaseCreditDebitFrmTwo #invoiceData').html(result);
				}
			});	
		});
	}
	
	function editItemPurchaseCreditDebit(el)
	{
		var id = $(el).data('id');
		var rate = $(el).data('rate');
		var discamt = $(el).data('discamt');
		var taxtype = $(el).data('taxtype');
		$("#sItemId").val(id);
		$("#rateEdit").val(rate);
		$("#disc_amt_edit").val(discamt);
		$("#tax_type_edit").val(taxtype);
	}
	
	function changeQuantityPurchaseCreditDebit(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var prod_id = $(el).data('prod_id');
		var quantity = $("#quantity_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#purchaseCreditDebitFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_purchase_item_quantity_creditdebit',
			data: {'id': id,'sid': sid,'prod_id':prod_id,'quantity':quantity},
			success: function(result){
			 $('form#purchaseCreditDebitFrmTwo #invoiceData').html(result);
			}
		});	
		
	}
	
	function changeRatePurchaseCreditDebit(el)
	{
		var id = $(el).data('id');
		var sid = $(el).data('sid');
		var rate = $("#rate_"+id).val();
		var base_url = $("#base_url").val();
		
		$('form#purchaseCreditDebitFrmTwo #invoiceData').html('');
		$.ajax({
			method: "POST",
			//dataType: "json",
			url: base_url + '/update_purchase_item_rate_creditdebit',
			data: {'id': id,'sid': sid,'rate':rate},
			success: function(result){
			 $('form#purchaseCreditDebitFrmTwo #invoiceData').html(result);
			}
		});	
		
	}
	//End purchase items credit debit
	
	//start for expense
	function getExpenseOptions(el)
	{
		var base_url = $("#base_url").val();
		var id = el.value;

		 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		  });
	  $.ajax({
		url: base_url + "/getExpenseOptions?"+id,
		dataType: "json",
		//type: "post",
		data: {id: id},
		success: function( data ) {
		  $("#expense_type").empty();
		  var str ='<option value="">Select</option>';
		  $.each(data, function (idx, item) {
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#expense_type").html(str);

		}

	  });
	}
	//End for expense

	function assign_ca(el){
			var base_url = $("#base_url").val();
			var btn = $(this);
			btn.prop('disabled', true);
			var id = el.value;

			 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
			const that = this;
			var ca_id = $(el).data('id');
			var ca_assign_status = $(el).data('status');
			if(ca_assign_status == 1){
				ca_assign_status = 0;
			}else{
				ca_assign_status = 1;
			}

			if(ca_id > 0){
				$.ajax({
					url: base_url + '/assign_ca',
					type:'POST',
					data:{'ca_id': ca_id, 'ca_assign_status':ca_assign_status, 'set_permission': ""},
					success: function(response) {
						btn.prop('disabled', false);
						if (response.class=="succ") {
							$('#loader').hide();
							if(response.ca_assign_status == 1){
								$(el).find('span').text("Un-Assign");
							}else{
								$(el).find('span').text("Assign");
							}
							$(el).data('status',response.ca_assign_status);
							$("#searchca .message-container").html('<div class="'+response.class+'">'+response.message+'</div>');
						} else {
							$('#loader').hide();
							$.each(response, function(idx, obj) {
								$("#searchca .message-container").html('<div class="err">'+obj+'</div>');
							});
						}
					}
				});
			}
    }

	function show_ca_permission(el){
			var base_url = $("#base_url").val();
			var id = $(el).data('id');
			 $.ajaxSetup({
				  headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
				  }
			  });
			$("#permissionDiv").html("");
			if(id > 0){
				$.ajax({
					url: base_url + '/get_ca_set_permission',
					type:'POST',
					data:{'id': id},
					success: function(res) {
						$("#permissionDiv").html(res);
					}
				});
			}
    }


	function changeCountry(el)
	{
	 var base_url = $("#base_url").val();
	 var id = el.value;
		 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		  });
	  $.ajax({
		url: base_url + "/getState?"+id,
		dataType: "json",
		//type: "post",
		data: {id: id},
		success: function( data ) {
		  $("#state").empty();
		  $("#city").empty();
		  var str ='<option value="">Select State</option>';
		  $.each(data, function (idx, item) {
				//$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#state").html(str);


		}

	  });
	}

	function changeState(el)
	{
		var base_url = $("#base_url").val();
		var id = el.value;

		 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		  });
	  $.ajax({
		url: base_url + "/getCity?"+id,
		dataType: "json",
		//type: "post",
		data: {id: id},
		success: function( data ) {
		  $("#city").empty();
		  var str ='<option value="">Select City</option>';
		  $.each(data, function (idx, item) {
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#city").html(str);

		}

	  });
	}

	function changeCountry_ship(el)
	{
	 var base_url = $("#base_url").val();
	 var id = el.value;
		 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		  });
	  $.ajax({
		url: base_url + "/getState?"+id,
		dataType: "json",
		//type: "post",
		data: {id: id},
		success: function( data ) {
		  $("#state_ship").empty();
		  $("#city_ship").empty();
		  var str ='<option value="">Select State</option>';
		  $.each(data, function (idx, item) {
				//$("#state").append('<option value="' + item.id + '">' + item.name + '</option>');
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#state_ship").html(str);


		}

	  });
	}

	function changeState_ship(el)
	{
		var base_url = $("#base_url").val();
		var id = el.value;

		 $.ajaxSetup({
			  headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			  }
		  });
	  $.ajax({
		url: base_url + "/getCity?"+id,
		dataType: "json",
		//type: "post",
		data: {id: id},
		success: function( data ) {
		  $("#city_ship").empty();
		  var str ='<option value="">Select City</option>';
		  $.each(data, function (idx, item) {
				str +='<option value="' + item.id + '">' + item.name + '</option>';
			});
		  $("#city_ship").html(str);

		}

	  });
	}

	//Add more bank
	$(document).ready(function(){

		  var i=1;
		  var n=-1;
		  var num=100;

		$("body").on("click",".AddMore",function(){

			var i = $('.containerVariant').length + 1;
			$('.containerVariant').first().clone().find("select").attr('name', function(idx, attrVal) {
				//return attrVal+'['+i+']'; // change the name
				 var name;
				name = $(this).attr('name');
				name = name.replace(/\[[0-9]+\]/g, '['+i+']');
				$(this).attr('name',name);
			}).end().insertBefore(this);

		 });

		$("body").on("click",".btn_remove",function(){
			$(this).parents(".containerVariant").remove();
		});
	});
	//27-09-2023
	//Button
	function openNewTab() {
		window.open("https://services.gst.gov.in/services/searchhsnsac", "_blank");
	}

	$(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
	//Show Password
	const passwordInput = document.getElementById("passwordInput");
	const showPasswordBtn = document.getElementById("showPasswordBtn");
	const passwordIcon = document.getElementById("passwordIcon");

	showPasswordBtn.addEventListener("click", function (e) {
		e.preventDefault();

		if (passwordInput.type === "password") {
			passwordInput.type = "text";
			passwordIcon.classList.remove("fa-eye");
			passwordIcon.classList.add("fa-eye-slash");
		} else {
			passwordInput.type = "password";
			passwordIcon.classList.remove("fa-eye-slash");
			passwordIcon.classList.add("fa-eye");
		}
	});
//Product Select
function addForm(plusButton) {
    // Clone the entire form group
    var formGroup = plusButton.closest(".form-group");
    var formGroupClone = formGroup.cloneNode(true);

    // Reset the selected option in the cloned form
    var selectElement = formGroupClone.querySelector("select");
    selectElement.value = "Select Product";

    // Append the cloned form group to its parent
    formGroup.parentElement.appendChild(formGroupClone);
}
//HSN & SAC
const productRadio = document.querySelector('input[name="item_type"][value="product"]');
const serviceRadio = document.querySelector('input[name="item_type"][value="service"]');
const sacCodeSection = document.getElementById('sac_code_section');
const hsnCodeSection = document.getElementById('hsn_code_section');

productRadio.addEventListener('change', function() {
    if (productRadio.checked) {
        hsnCodeSection.style.display = 'block';
        sacCodeSection.style.display = 'none';
    }
});

serviceRadio.addEventListener('change', function() {
    if (serviceRadio.checked) {
        sacCodeSection.style.display = 'block';
        hsnCodeSection.style.display = 'none';
    }
});

//Custom Select
function showExpensesType() {
    var selectedCategory = document.getElementById("expenses-category").value;

    // Hide all expenses type selects
    var allExpenses = document.querySelectorAll(".form-group[id$='-expenses']");
    for (var i = 0; i < allExpenses.length; i++) {
        allExpenses[i].style.display = "none";
    }

    // Show the selected expenses type
    if (selectedCategory !== "Select") {
        var selectedExpenses = document.getElementById(selectedCategory + "-expenses");
        selectedExpenses.style.display = "block";
    }
}
