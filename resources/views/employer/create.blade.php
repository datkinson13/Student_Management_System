@extends('layouts.master')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('business.store') }}">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <h2>Create a Business Account</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                    <label for="company" class="col-md-4 control-label">Company Name</label>

                    <div class="col-md-6">
                        <input id="company" type="text" class="form-control" name="company"
                               value="{{ old('company') }}" required autofocus>

                        @if ($errors->has('company'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6" style="padding-top: .35rem">
                        <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                            <label class="form-check-label">
                                <input class="form-check-input" name="auto_enroll"
                                       type="checkbox" {{ old('auto_enroll') ? 'checked' : '' }}>
                                <span style="padding-bottom: .15rem">Auto Enroll Employees</span>
                            </label>
                        </div>
                        <p>This allows all new users who have the specified domain to auto enroll into your business.</p>
                    </div>
                </div>

                <div class="form-group{{ $errors->has('domain') ? ' has-error' : '' }}">
                    <label for="domain" class="col-md-4 control-label">E-Mail Domain</label>

                    <div class="col-md-6">
                        <input id="domain" type="text" class="form-control" name="domain"
                               value="{{ old('domain') }}">

                        @if ($errors->has('domain'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('domain') }}</strong>
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
