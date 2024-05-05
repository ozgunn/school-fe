@extends('layouts.auth')

@section('title', trans('Daily Reports'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Daily Reports') }}</h1>
{{--        <a href="{{ route('groups.create') }}" class="btn btn-primary shadow-sm"><i--}}
{{--                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>--}}
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('Date')}}</th>
                <th>{{__('Teacher')}}</th>
                <th>{{__('Student')}}</th>
                <th>{{__('Note')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['date'])->format("Y-m-d") }}</td>
                    <td>{{ isset($item['teacher']) ? $item['teacher']['name'] : null }}</td>
                    <td>{{ isset($item['student']) ? $item['student']['name'] : null }}</td>
                    <td>{{ $item['note'] }}</td>
                    <td>
                        <div class="float-right">
                            <a href="{{ route('daily-reports.show', ['daily_report' => $item['id']]) }}" class="show" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Details')}}">
                                <i class="fas fa-fw fa-eye"></i>
                            </a>
                            <a href="{{ route('daily-reports.destroy', ['daily_report' => $item['id']]) }}" class="delete" title=""
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
                    },
                    order: [[0, 'desc']]
                });
            });
        </script>
@endsection
