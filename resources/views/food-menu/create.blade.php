@extends('layouts.auth')

@section('title', trans('Food Menu'))

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Create Food Menu') }}</h1>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        @include('food-menu/_form')

@endsection
