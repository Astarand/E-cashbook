@extends('layouts.default')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="chat-window">
                        <div class="chat-cont-left">
                            <div class="chat-header">
                                <span>Bulk Message Send</span>
                            </div>

                            <form class="chat-search row">
                                <div class="col-8">
                                    <div class="input-group">
                                        <!--<div class="input-group-prepend">
                                            <i class="fas fa-search"></i>
                                        </div>-->
                                        <!--<input type="text" class="form-control" placeholder="Task Type">-->
										<select class="select form-select" id="taskCategorySelect">
											<option value="">Select Category</option>
											<option value="Company Incorporation">Company Incorporation</option>
											<option value="Company Compliances">Company Compliances</option>
											<option value="Licensing & Registration">Licensing & Registration</option>
											<option value="Income Tax Returns">Income Tax Returns</option>
											<option value="GST Returns">GST Returns</option>
											<option value="ROC Returns">ROC Returns</option>
											<option value="Audits">Audits</option>
											<option value="TDS, PF & ESIC">TDS, PF & ESIC</option>
											<option value="Project Report / DPR">Project Report / DPR</option>
											<option value="Accounts Preparation">Accounts Preparation</option>
											<option value="Outsourcing of Accountant">Outsourcing of Accountant</option>
											<option value="Others">Others</option>
										</select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-primary w-100 my-auto" id="filterApplyBtn" href="javascript:void(0);" style="border-radius:25px;">Apply</a>
                                </div>

                            </form>


                            <div class="chat-users-list">
                                <div class="chat-scroll">
                                    <div class="table-responsive">
                                        <table class="table table-center table-hover datatable">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Company Name</th>
                                                <th>Task Remind Type</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody id="compTaskLists">
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-cont-right">
                            <div class="chat-header">
                                <div class="media d-flex">
                                    <div class="media-body">
                                        <div class="user-name">Send Message</div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-body">
                                <div class="chat-scroll">
                                    <ul class="list-unstyled">
                                        <li class="media sent">
                                            <div class="media-body">
{{--                                                <div class="msg-box">--}}
{{--                                                    <div>--}}
{{--                                                        <p>Please Send Document</p>--}}
{{--                                                        <ul class="chat-msg-info">--}}
{{--                                                            <li>--}}
{{--                                                                <div class="chat-time">--}}
{{--                                                                    <span>8:30 AM</span>--}}
{{--                                                                </div>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="chat-footer">
								<form action="javascript:void(0);" method="post" name="bulkMessageFrm" id="bulkMessageFrm" enctype="multipart/form-data">
								@csrf
								<div class="message-container"></div>
								<div id="addReminderLoader" class="loader"></div>
					
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <!--<div class="btn-file btn">
                                            <i class="fas fa-paperclip"></i>
                                            <input type="file">
                                        </div>-->
                                    </div>
                                    <textarea rows="5" cols="5" class="form-control" name="reminderText" id="reminderText" placeholder="Enter message here" style="border-radius:0px"></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn msg-send-btn" id="reminderBtn"><i class="fas fa-paper-plane"></i></button>
                                    </div>
                                </div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
