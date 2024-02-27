<?php
if(old()) {
    $data = old();
}
?>

<form action="{{ isset($data['id']) ? route('students.update', ['student' => $data['id']]) : route('students.store') }}"
      method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
        @include('../includes/school-class-selector')
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">{{__('Name')}}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] ?? null }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="parent_id">{{__('Parent')}}</label>
            <select class="form-control select-parent" name="parent_id" id="parent_id">
                <option value="">{{__('Select')}}</option>
                @if(!empty($parents))
                    @foreach($parents as $parent)
                        <option
                            value="{{ $parent['id'] }}" {{ (isset($data['parent_id']) && $parent['id'] == $data['parent_id']) ? "selected" : null  }}>{{ $parent['name'] }}
                    @endforeach
                @endif
            </select>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="morning_bus_id">{{__('Morning Bus')}}</label>
            <select class="form-control" id="morning_bus_id" name="morning_bus_id" style="padding-top:5px;">
                <option value="">{{__('Select')}}</option>
                @if(!empty($buses))
                    @foreach($buses as $bus)
                        <option
                            value="{{ $bus['id'] }}" {{ (isset($data['morning_bus_id']) && $bus['id'] == $data['morning_bus_id']) ? "selected" : null  }}>{{ $bus['license_plate'] }}
                    @endforeach
                @endif
            </select>
            @error('morning_bus_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="evening_bus_id">{{__('Evening Bus')}}</label>
            <select class="form-control" id="evening_bus_id" name="evening_bus_id">
                <option value="">{{__('Select')}}</option>
                @if(!empty($buses))
                    @foreach($buses as $bus)
                        <option
                            value="{{ $bus['id'] }}" {{ (isset($data['evening_bus_id']) && $bus['id'] == $data['evening_bus_id']) ? "selected" : null  }}>{{ $bus['license_plate'] }}
                    @endforeach
                @endif
            </select>
            @error('evening_bus_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex justify-content-between col-md-6">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('teachers.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>
<style>
    .select2 {
        width: 100% !important;
    }
    .select2-selection {
        border: 1px solid #d1d3e2 !important;
        border-radius: 5px !important;
        padding: 0.375em 0.75em !important;
        height: auto !important;
        color: #6e707e !important;
    }
</style>
<script>
    $(document).ready(function () {
        $('.select-parent').select2();
        $('.select-parent').on('select2:open', function (e) {
            $('.select2-search__field').val('');
        });
    });
</script>

