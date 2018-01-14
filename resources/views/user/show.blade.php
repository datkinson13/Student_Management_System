@extends('layouts.master')

@section('content')
  <!-- <a  style = "float: right;" href = "/users/{{ $user->id }}/updatePassword"<button class = "btn btn-primary user-profile-buttons">Change Password</button></a> -->
  <a href = "/users/{{ $user->id }}/edit"><button class = "btn btn-primary user-profile-buttons">Edit User</button></a>
  <h1>User: {{ $user->Fname }} {{ $user->Lname }}</h1>
  <img id = "profile-picture-main" src = "/uploads/avatars/{{ $user->avatar }}" />
  <p>Email: {{ $user->email}}
  <p>Date of Birth: {{ $user->DOB }}</p>
  <p>Address: {{ $user->address }}</p>
  <p>Phone: {{ $user->phone }}</p>
  <p>Mobile: {{ $user->mobile }}</p>
  <p>Proof of identification: <br/> <a href = "/uploads/identification/{{ $user->identification }}" target = "_blank">{{ $user->identification }}</a></p>

  {{-- Allow user (not employer) to convert into a business account. --}}
  <hr>
  <h2>Business Account</h2>
  @if (!($user->isEmployee() or $user->isEmployer()))
    <a href="{{ route('business.create') }}">Click here to create a business account</a>
  @else
    @if ($user->isEmployer())
      <a href = "/business/{{ $user->employer->id }}/edit"><button class = "btn btn-primary user-profile-buttons">Edit Business</button></a>
    @endif
    <p>Email: {{ $user->employer->company}}
    <p>Address: {{ $user->employer->address }}</p>
    <p>Phone: {{ $user->employer->phone }}</p>
  @endif

  <hr>
  {{-- Display user documentation --}}
  <div>
    <form action="{{ route('user.upload', [$user->id]) }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <label for="document">Documentation upload - Your uploaded documents will appear in the table below.</label>
        <input type="file" class="form-control-file" id="document" name="document">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Upload</button>
      </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">File</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      @foreach ($user->documents() as $count=>$document)
        <tbody>
          <tr>
            <th scope="row">{{ $count+1 }}</th>
            <td>{{ $document }}</td>
            <td>
              <button type="button" class="btn btn-danger" data-title="{{ $document }}" data-toggle="modal" data-target="#deleteFileModal">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      @endforeach
    </table>
  </div>

  <!-- Delete File Modal -->
  <div class="modal fade" id="deleteFileModal" tabindex="-1" role="dialog" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteFileModalLabel">Delete file</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this file?
        </div>
        <div class="modal-footer">
          <form id="delete-form" action="{{ route('user.deletefile', [$user->id]) }}" method="post">
            <input type="hidden" value="" id="path" name="path">
            {{ csrf_field() }}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('page-script')
  <script type="text/javascript">
      jQuery(document).ready(function ($) {
          $('#deleteFileModal').on("show.bs.modal", function (e) {
              $("#path").attr("value", $(e.relatedTarget).data('title'));
          });
      });
  </script>
@endsection