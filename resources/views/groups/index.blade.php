@extends('layouts.auth')

@section('title', trans('Groups'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Groups') }}</h1>
        <a href="{{ route('groups.create') }}" class="btn btn-primary shadow-sm"><i
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
                <th>{{__('Age Group')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['school']['name'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['age_group'] }}</td>
                    <td>
                        <div class="float-right">
                            <a href="{{ route('groups.edit', ['group' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('groups.destroy', ['group' => $item['id']]) }}" class="delete" title=""
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
