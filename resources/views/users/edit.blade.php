@extends('layouts.auth')

@section('title', trans('Users'))

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Update User') }} (#{{ $data['id'] }})</h1>
    </div>
    <!-- Content Row -->
    <div class="">
        <!-- View -->
        @include('users/_form')

@endsection
