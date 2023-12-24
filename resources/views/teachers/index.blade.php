@extends('layouts.auth')

@section('title', trans('Teachers'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Teachers') }}</h1>
        <a href="{{ route('teachers.create') }}" class="btn btn-primary shadow-sm"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('School')}}</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Class')}}</th>
                <th>{{__('Student Count')}}</th>
                <th>{{__('Status')}}</th>
                <th class="nowrap"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['school']['name'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['class'] ? $item['class']['name'] : null }}</td>
                    <td>{{ $item['class'] ? $item['class']['student_count'] : null }}</td>
                    <td>{{ __(\App\Models\User::STATUSES[$item['status']]) }}</td>
                    <td>
                        <div class="float-right">
                            <a href="{{ route('teachers.edit', ['teacher' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('teachers.destroy', ['teacher' => $item['id']]) }}" class="delete" title=""
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
