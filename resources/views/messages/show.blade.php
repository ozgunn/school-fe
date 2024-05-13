@extends('layouts.auth')

@section('title', trans('Daily Report Detail'))

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Daily Report Detail') }} (#{{ $data['id'] }})</h1>
    </div>
    <!-- Content Row -->
    <div class="col-md-6">
        <!-- View -->
        <table class="table table-striped">
            <tbody>
            <tr>
                <th scope="row">{{__('Date')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($data['date'])->format("Y-m-d") }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('created_at')}}</th>
                <td>{{ \Illuminate\Support\Carbon::parse($data['created_at'])->format("Y-m-d H:i") }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('Read At')}}</th>
                <td>{{ $data['read_at'] ? \Illuminate\Support\Carbon::parse($data['read_at'])->format("Y-m-d H:i") : "-" }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('Confirmed At')}}</th>
                <td>{{ $data['confirmed_at'] ? \Illuminate\Support\Carbon::parse($data['confirmed_at'])->format("Y-m-d H:i") : "-" }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('Teacher')}}</th>
                <td>{{ isset($data['teacher']) ? $data['teacher']['name'] : null }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('Student')}}</th>
                <td>{{ isset($data['student']) ? $data['student']['name'] : null }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('Note')}}</th>
                <td>{{ $data['note'] }}</td>
            </tr>
            <tr>
                <th scope="row">{{__('Details')}}</th>
                <td>
                    @if ($data['mood'])
                        <div class="mt-4">
                            {{ $data['mood']['title'] }}:
                        </div>
                        <div class="row">
                            @foreach($data['mood']['items'] as $item)
                                <div class="col-md-6 pl-2">
                                    <i class="fas fa-fw fa-check {{$item["selected"] ? 'text-success': 'text-gray-200'}}"></i> {{$item["title"]}}
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($data['activity'])
                        <div class="mt-4">
                            {{ $data['activity']['title'] }}:
                        </div>
                        <div class="row">
                            @foreach($data['activity']['items'] as $item)
                                <div class="col-md-6 pl-2">
                                    <i class="fas fa-fw fa-check {{$item["selected"] ? 'text-success': 'text-gray-200'}}"></i> {{$item["title"]}}
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($data['food'])
                        <div class="mt-4">
                            {{ $data['food']['title'] }}:
                        </div>
                        <div>
                            @foreach($data['food']['items'] as $item)
                                <div>
                                    {{ $item['title'] }}:
                                </div>
                                <div class="row">
                                    @foreach($item['items'] as $item2)
                                        <div class="col-md-4 pl-2">
                                            <i class="fas fa-fw fa-check {{$item2["selected"] ? 'text-success': 'text-gray-200'}}"></i> {{$item2["title"]}}
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if ($data['sleep'])
                        <div class="mt-4">
                            {{ $data['sleep']['title'] }}:
                        </div>
                        <div class="row">
                            @foreach($data['sleep']['items'] as $item)
                                <div class="col-md-4 pl-2">
                                    <i class="fas fa-fw fa-check {{$item["selected"] ? 'text-success': 'text-gray-200'}}"></i> {{$item["title"]}}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </td>
            </tr>

            </tbody>
        </table>

@endsection



