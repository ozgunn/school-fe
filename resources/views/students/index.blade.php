@extends('layouts.auth')

@section('title', trans('Students'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Students') }}</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary shadow-sm"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('No')}}</th>
                <th>{{__('School')}}</th>
                <th>{{__('Class')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Parent')}}</th>
                <th>{{__('Morning Bus')}}</th>
                <th class="text-nowrap">{{__('Evening Bus')}}</th>
                <th class="text-nowrap"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['school']['name'] }}</td>
                    <td>{{ $item['class']['name'] }}</td>
                    <td>
                        {{ $item['name'] }}
                        {!! \App\Helpers\StringHelper::fixNameForDatatable($item['name']) !!}
                    </td>
                    <td><a href="{{ route('parents.edit', ['parent' => $item['parent']['id']]) }}">{{ $item['parent']['name'] }}</a></td>
                    <td class="text-nowrap">{{ $item['morning_bus'] ? $item['morning_bus']['license_plate'] : null }}</td>
                    <td class="text-nowrap">{{ $item['evening_bus'] ? $item['evening_bus']['license_plate'] : null }}</td>
                    <td class="text-nowrap">
                        <div class="float-right">
                            <a href="{{ route('students.edit', ['student' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('students.destroy', ['student' => $item['id']]) }}" class="delete" title=""
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
