@extends('layouts.auth')

@section('title', trans('Buses'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Buses') }}</h1>
        <a href="{{ route('buses.create') }}" class="btn btn-primary shadow-sm"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('School')}}</th>
                <th>{{__('Licence Plate')}}</th>
                <th>{{__('Start Time')}}</th>
                <th>{{__('End Time')}}</th>
                <th>{{__('Teacher')}}</th>
                <th>{{__('Last Position')}}</th>
                <th>{{__('Status')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['school']['name'] }}</td>
                    <td>{{ $item['license_plate'] }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['start_time'])->format('H:i') }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['end_time'])->format('H:i') }}</td>
                    <td>{{ !empty($item['teacher']) ? $item['teacher']['name'] : null }}</td>
                    <td>{{ $item['lat'] }} {{ $item['long'] }}</td>
                    <td>{{ $item['status'] ? __('Active') : __('Passive') }}</td>
                    <td class="text-nowrap">
                        <div class="float-right">
                            <a href="{{ route('buses.edit', ['bus' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('buses.destroy', ['bus' => $item['id']]) }}" class="delete" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Delete')}}"><i
                                    class="fas fa-fw fa-trash-alt text-danger"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function () {
                $('#data-table').DataTable({
                    language: {
                        url: "{{ asset('js/dataTables-tr.json') }}"
                    }
                });
            });
        </script>
@endsection
