@extends('layouts.auth')

@section('title', trans('Messages'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ request()->get('sent') ? trans('Sent') : trans('Inbox') }}</h1>
        <div>
            <a href="{{ route('messages.index') }}" class="btn btn-secondary shadow-sm"><i
                class="fas fa-envelope fa-fw text-white"></i> {{trans('Inbox')}}</a>
            <a href="{{ route('messages.index', ['sent' => 1]) }}" class="btn btn-secondary shadow-sm ml-1"><i
                class="fas fa-paper-plane fa-fw text-white"></i> {{trans('Sent')}}</a>
            <a href="{{ route('messages.create') }}" class="btn btn-primary shadow-sm ml-5"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('Date')}}</th>
                <th>{{__('Parent')}}</th>
                <th>{{__('Student')}}</th>
                <th>{{__('Message')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['created_at'])->format("Y-m-d H:i") }}</td>
                    <td>{{ isset($item['parent']) ? $item['parent']['name'] : null }}</td>
                    <td>{{ isset($item['student']) ? $item['student']['name'] : null }}</td>
                    <td>{{ $item['message'] }}</td>
                    <td>
                        <div class="float-right">
                            <a href="{{ route('messages.show', ['message' => $item['id']]) }}" class="show" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Details')}}">
                                <i class="fas fa-fw fa-eye"></i>
                            </a>
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
