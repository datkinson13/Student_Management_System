@extends('layouts.master')

@section('content')
<button class = "btn btn-primary" style = "float: right; margin-left: 20px;" type = "button">Email Accounts</button>
<div class="dropdown" style = "float:right;">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Export
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">as Excel</a>
    <a class="dropdown-item" href="#">as Word</a>
    <a class="dropdown-item" href="#">as PDF</a>
  </div>
</div>
<h1>Net Training Liability</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Training Expense</th>
      <th>Immediate</th>
      <th>Approaching</th>
      <th>Distant</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><strong>Business Role 1</strong></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td style = "padding-left: 30px;">Skills Course 1</td>
      <td>$100</td>
      <td>$300</td>
      <td>$1,000</td>
    </tr>
    <tr>
      <td style = "padding-left: 30px;">Skills Course 2</td>
      <td>$0</td>
      <td>$200</td>
      <td>$500</td>
    </tr>
    <tr>
      <td style = "padding-left: 30px;">Skills Course 3</td>
      <td>$0</td>
      <td>$0</td>
      <td>$0</td>
    </tr>
    <tr>
      <td><strong>Business Role 2</strong></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td style = "padding-left: 30px;">Skills Course 4</td>
      <td>$100</td>
      <td>$300</td>
      <td>$1,000</td>
    </tr>
    <tr>
      <td style = "padding-left: 30px;">Skills Course 5</td>
      <td>$0</td>
      <td>$200</td>
      <td>$500</td>
    </tr>
    <tr>
      <td style = "padding-left: 30px;">Skills Course 6</td>
      <td>$0</td>
      <td>$0</td>
      <td>$0</td>
    </tr>
    <tr style = "border-top: 2px solid #000000; border-bottom: 2px solid #000000;">
      <td><strong>Total Expense:</strong></td>
      <td><strong>$200</strong></td>
      <td><strong>$1,000</strong></td>
      <td><strong>$3,000</strong></td>
    </tr>
  </tbody>
</table>
@endsection
