@extends('layouts.master')

@section('content')
  <h1>Edit User</h1>
  <form enctype = "multipart/form-data" action = "/users/{{ $user->id }}" method = "POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class = "form-group row">
      <label for = "Fname" class = "col-sm-2 col-form-label">First Name:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "Fname" name = "Fname" value = "{{ $user->Fname }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "Lname" class = "col-sm-2 col-form-label">Last Name:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "Lname" name = "Lname" value = "{{ $user->Lname }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "email" class = "col-sm-2 col-form-label">Email:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "email" name = "email" value = "{{ $user->email }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "avatar" class = "col-sm-2 col-form-label">Profile Picture:</label>
      <div class = "col-sm-6">
        <input type = "file" id = "avatar" name = "avatar" accept = "image/*">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "DOB" class = "col-sm-2 col-form-label">Date of Birth:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "DOB" name = "DOB" value = "{{ $user->DOB }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "address" class = "col-sm-2 col-form-label">Address:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "address" name = "address" value = "{{ $user->address }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "phone" class = "col-sm-2 col-form-label">Phone:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "phone" name = "phone" value = "{{ $user->phone }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "mobile" class = "col-sm-2 col-form-label">Mobile:</label>
      <div class = "col-sm-6">
        <input type = "text" class = "form-control" id = "mobile" name = "mobile" value = "{{ $user->mobile }}">
      </div>
    </div>
    <div class = "form-group row">
      <label for = "identification" class = "col-sm-2 col-form-label">Proof of identification:</label>
      <div class = "col-sm-6">
        <input type = "file" id = "identification" name = "identification" accept = "application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/msword, application/pdf, image/*">
      </div>
    </div>
      @can('permissions', App\User::class)
          <div class="form-group row">
              <label class="col-sm-2 col-form-label">Permissions:</label>
              <div class="form-check">
                  @foreach(\App\Role::all() as $role)
                      <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="roles[{{ $role->id }}]{{ $role->slug }}"
                                 id="{{ $role->slug }}" {{ $user->inRole($role->slug) ? 'Checked' : '' }}>
                          {{ $role->name }}
                      </label>
                  @endforeach
              </div>
          </div>
      @endcan
    <button class="btn btn-primary user-edit-buttons" type="submit">Update User</button>
    <a href = "/users/{{ $user->id }}"><button class="btn btn-primary user-edit-buttons" type="button">Cancel</button></a>
  </form>
@endsection
