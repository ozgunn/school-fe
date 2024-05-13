@extends('layouts.auth')

@section('title', trans('Photos'))

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Photos') }}</h1>
{{--        <a href="{{ route('files.create') }}" class="btn btn-primary shadow-sm"><i--}}
{{--                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>--}}
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
                <th>{{__('User')}}</th>
                <th>{{__('Photo')}}</th>
                <th>{{__('created_at')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @php
                $data = $data ?? [];
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item['school_name'] }}</td>
                    <td>{{ $item['group_name'] }}</td>
                    <td>{{ $item['class_name'] }}</td>
                    <td>{{ $item['user_name'] }}</td>
                    <td><a href="{{ $item['url'] }}" target="_blank"  data-toggle="tooltip" data-original-title="{{trans('View')}}"><img src="{{ $item['url'] }}" class="img-thumbnail" alt="photo"></a></td>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['created_at'])->format('Y-m-d H:i') }}</td>
                    <td class="text-nowrap">
                        <div class="float-right">
{{--                            <a href="{{ $item['url'] }}" target="_blank"  data-toggle="tooltip" data-original-title="{{trans('View')}}"><i class="fas fa-fw fa-file-pdf"></i></a>--}}

{{--                            <a href="{{ route('files.edit', ['file' => $item['id']]) }}" class="edit" title=""--}}
{{--                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">--}}
{{--                                <i class="fas fa-fw fa-edit"></i>--}}
{{--                            </a>--}}
                            <a href="{{ route('photos.destroy', ['photo' => $item['id']]) }}" class="delete" title=""
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
                        url: "{{ asset('js/dataTables-tr.json') }}",
                    },
                    order: [[5, 'desc']]
                });
            });
        </script>

@endsection
