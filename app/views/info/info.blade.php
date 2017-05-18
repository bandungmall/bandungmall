@extends('user.templates.layout')

@section('content')
<div class="container main-container headerOffset">
  <h1>Info</h1>
  <div class="container">
    <p>{{ $info_data }}</p>
  </div>
</div>
@endsection
