@extends('layouts.master')

@section('content')
    <form enctype = "multipart/form-data" class="form-horizontal" method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <h2>Create a new account</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }}">
                    <label for="Fname" class="col-md-4 control-label">First Name</label>

                    <div class="col-md-6">
                        <input id="Fname" type="text" class="form-control" name="Fname"
                               value="{{ old('Fname') }}" required autofocus>

                        @if ($errors->has('Fname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('Fname') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }}">
                    <label for="Lname" class="col-md-4 control-label">Last Name</label>

                    <div class="col-md-6">
                        <input id="Lname" type="text" class="form-control" name="Lname"
                               value="{{ old('Lname') }}" required>

                        @if ($errors->has('Lname'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"
                               value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class = "form-group">
                  <label for = "avatar" class = "col-sm-4 col-form-label">Profile Picture:</label>
                  <div class = "col-sm-6">
                    <input type = "file" id = "avatar" name = "avatar" accept = "image/*">
                  </div>
                </div>

                <div class="form-group{{ $errors->has('DOB') ? ' has-error' : '' }}">
                    <label for="DOB" class="col-md-4 control-label">Date of Birth</label>

                    <div class="col-md-6">
                        <input id="DOB" type="date" class="form-control" name="DOB"
                               value="{{ old('DOB') }}" required>

                        @if ($errors->has('DOB'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('DOB') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">Address</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address"
                               value="{{ old('address') }}">

                        @if ($errors->has('address'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Phone</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone"
                               value="{{ old('phone') }}">

                        @if ($errors->has('phone'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                    <label for="mobile" class="col-md-4 control-label">Mobile</label>

                    <div class="col-md-6">
                        <input id="mobile" type="text" class="form-control" name="mobile"
                               value="{{ old('mobile') }}">

                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class = "form-group">
                  <label for = "identification" class = "col-sm-4 col-form-label">Proof of identification:</label>
                  <div class = "col-sm-6">
                    <input type = "file" id = "identification" name = "identification" accept = "application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/pdf, image/*">
                  </div>
                </div><br/>

                <div class = "form-group">
                  <div class = "col-sm-12">
                    <input type = "checkbox" id = "terms-and-conditions" name = "terms-and-conditions" required> I agree to the <a href = "/auth/terms-and-conditions" target = "_blank">Terms and Conditions</a>.<br/>
                  </div>
                </div><br/>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required>
                    </div>
                </div>

                {!! app('captcha')->display() !!}

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        {{-- Make these buttons the same size and appear at opposite sides of the form. --}}
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                        <button type="reset" class="btn btn-warning">
                            Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
