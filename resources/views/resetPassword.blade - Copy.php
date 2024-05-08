@extends('layouts.default')

@section('content')

	<div class="container">

        <div class="row" style="margin-top: 50px;">

            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">

                    <div class="panel-heading">

                        

                    </div>

@if (Session::has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<h4 class="alert-heading">Success!</h4>
								<p>{{ Session::get('success') }}</p>

								<button type="button" class="close" data-dismiss="alert aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						@endif
                    <div class="panel-body">

                        @if (count($errors) > 0)

                            <div class="row">

                                <div class="col-md-12">

                                    <div class="alert alert-danger alert-dismissible">

                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                                        <h4><i class="icon fa fa-ban"></i> Error!</h4>

                                        @foreach($errors->all() as $error)

                                        {{ $error }} <br>

                                        @endforeach      

                                    </div>

                                </div>

                            </div>

                        @endif

                        <form class="image-upload" method="post" action="{{ route('reset.password.store') }}" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">

                                <label>Current Password</label>

                                <input type="password" name="current_password" class="form-control" value="{{ old('current_password') }}"/>

                            </div>

                            <div class="form-group">

                                <label>New Password</label>

                                <input type="password" name="new_password" class="form-control" value="{{ old('new_password') }}"/>

                            </div>

                            <div class="form-group">

                                <label>Confirm Password</label>

                                <input type="password" name="confirm_password" class="form-control" value="{{ old('confirm_password') }}"/>

                            </div>

                            <div class="form-group text-center">

                                <button type="submit" class="btn btn-success">Save</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
