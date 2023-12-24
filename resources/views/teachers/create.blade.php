@extends('layouts.auth')

@section('title', trans('Teachers'))

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Create Teacher') }}</h1>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        @include('teachers/_form')

@endsection
