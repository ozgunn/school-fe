@php
$schools = session('schools');
$groups = session('groups');
@endphp

@extends('layouts.auth')

@section('title', trans('Announcements'))

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Announcements') }}</h1>
        <a href="#" class="btn btn-primary shadow-sm"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('School')}}</th>
                <th>{{__('Group')}}</th>
                <th>{{__('Class')}}</th>
                <th>{{__('Student')}}</th>
                <th>{{__('Content')}}</th>
                <th>{{__('created_at')}}</th>
                <th class="text-nowrap"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $schools[$item['school_id']] }}</td>
                    <td>{{ $item['group_id'] ? $groups[$item['group_id']] : null }}</td>
                    <td>{{ $item['class_id'] }}</td>
                    <td>{{ $item['student_id'] }}</td>
                    <td>{{ !empty($item['content']) ? $item['content'][0]['content'] : null }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['created_at'])->format('Y-m-d H:i') }}</td>
                    <td class="text-nowrap">
                        <div class="float-right">
                            <a href="{{ route('announcements.edit', ['announcement' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('announcements.destroy', ['announcement' => $item['id']]) }}" class="delete" title=""
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
