@extends('layouts.auth')

@section('title', trans('Logs'))

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Logs') }}</h1>
{{--        <a href="{{ route('files.create') }}" class="btn btn-primary shadow-sm"><i--}}
{{--                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>--}}
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('created_at')}}</th>
                <th>{{__('User')}}</th>
                <th>{{__('Log Level')}}</th>
                <th>{{__('Log')}}</th>
                <th>{{__('Details')}}</th>
            </tr>
            </thead>
            <tbody>
            @php
                $data = $data ?? [];
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['created_at'])->format('Y-m-d H:i') }}</td>
                    <td>{{ $item['user'] ? $item['user']['name'] : null }}</td>
                    <td>{{ $item['level'] }}</td>
                    <td>{{ __($item['message']) }}</td>
                    <td>{{ json_encode($item['context']) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function () {
                $('#data-table').DataTable({
                    language: {
                        url: "{{ asset('js/dataTables-tr.json') }}",
                    },
                    order: [[0, 'desc']],
                    pageLength: 100,
                });
            });
        </script>

@endsection
