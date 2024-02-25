@extends('layouts.auth')

@section('title', trans('Food Menu'))

@section('content')


    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ trans('Food Menu') }}</h1>
        <a href="{{ route('food-menu.create') }}" class="btn btn-primary shadow-sm"><i
                class="fas fa-plus fa-fw text-white"></i> {{trans('Create')}}</a>
    </div>

    <!-- Content Row -->
    <div class="">
        <!-- View -->
        <table class="table display" id="data-table">
            <thead class="table-light">
            <tr>
                <th>{{__('Day')}}</th>
                <th>{{__('Breakfast')}}</th>
                <th>{{__('Lunch')}}</th>
                <th>{{__('Snack Time')}}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @php
                $data = $data ?? [];
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{ \Illuminate\Support\Carbon::parse($item['date'])->format('Y-m-d') }}</td>
                    <td>{{ $item['items'][0]['value'] }}</td>
                    <td>{{ $item['items'][1]['value'] }}</td>
                    <td>{{ $item['items'][2]['value'] }}</td>
                    <td class="text-nowrap">
                        <div class="float-right">
                            <a href="{{ route('food-menu.edit', ['food_menu' => $item['id']]) }}" class="edit" title=""
                               data-toggle="tooltip" data-original-title="{{trans('Edit')}}">
                                <i class="fas fa-fw fa-edit"></i>
                            </a>
                            <a href="{{ route('food-menu.destroy', ['food_menu' => $item['id']]) }}" class="delete" title=""
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
