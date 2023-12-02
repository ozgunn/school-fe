@extends('layouts.auth')

@section('title', trans('Schools'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Schools') }}</h1>
        <a href="{{ route('schools.create') }}" class="btn btn-primary shadow-sm"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="school-list">
            <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Status')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{!! $item['status'] ? "<span class=\"text-success\">".__('Active')."</span>" : '<span class="text-secondary">'.__('Passive').'</span>' !!}</td>
                    <td>
                        <div class="float-right">
                            <a href="{{ route('schools.edit', ['school' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('schools.destroy', ['school' => $item['id']]) }}" class="delete" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Delete')}}"><i
                                    class="fas fa-fw fa-trash-alt text-danger"></i></a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{--    @include('includes.pagination', ['pagination' => $pagination])--}}
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#school-list').DataTable({
                    language: {
                        url: "{{ asset('js/dataTables-tr.json') }}"
                    }
                });
            });
        </script>
@endsection
