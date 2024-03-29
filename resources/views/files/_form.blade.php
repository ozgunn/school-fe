<?php
if (old()) {
    $data = old();
}
if (isset($data['group'])) {
    $data['group_id'] = $data['group']['id'];
}
?>

<form
    action="{{ isset($data['id']) ? route('files.update', ['file' => $data['id']]) : route('files.store') }}"
    enctype="multipart/form-data"
    method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="publish_year">{{__('Year')}}</label>
            <select class="form-control" id="publish_year" name="publish_year">
                <option value="">{{ __('Select') }}</option>
                @for($i=date('Y')-1; $i<=date('Y')+1; $i++)
                    <option {{ isset($data['publish_year']) && $data['publish_year'] == $i ? "selected" : ($i == date('Y') ? "selected" : null)  }}>{{ $i }}</option>
                @endfor
            </select>
            @error('publish_year')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="publish_month">{{__('Month')}}</label>
            <select class="form-control" id="publish_month" name="publish_month">
                <option value="">{{ __('Select') }}</option>
                @for($i=1; $i<=12; $i++)
                    <option {{ (isset($data['publish_month']) && $data['publish_month'] == $i) || (!isset($data['publish_month']) && $i == date('n')) ? "selected" : null }}>{{ $i }}</option>
                @endfor
            </select>
            @error('publish_month')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="type">{{__('Newspaper Type')}}</label>
            <select class="form-control" id="type" name="type">
                <option value="">{{ __('Select') }}</option>
                <option
                    value="1" {{ isset($data['id']) && $data['type'] == 1 ? "selected" : null }}>{{ __('Parent Newspaper') }}</option>
                <option
                    value="2" {{ isset($data['id']) && $data['type'] == 2 ? "selected" : null }}>{{ __('Group Newspaper') }}</option>
            </select>
            @error('type')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row div-group {{ isset($data['type']) && $data['type'] == 1 ? 'd-none' : '' }}">
        <div class="form-group col-md-6">
            <label for="group_id">{{__('Group')}}</label>
            <select class="form-control" id="group_id" name="group_id">
                <option value="">{{__('Select')}}</option>
                @foreach($groups as $group)
                    <option
                        value="{{ $group['id'] }}" {{ isset($data['group_id']) && $data['group_id'] == $group['id'] ? "selected" : null }}>{{ $group['name'] }}</option>
                @endforeach
            </select>
            @error('group_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            @if(isset($data['id']))
                <div class="text-danger small">* {{ __('If you want to change the file, you can delete and recreate it') }}</div>
            @else
                <label for="pdf" class="form-label">{{__('File')}}</label>
                <input type="file" name="pdf" id="pdf" class="" accept="application/pdf">
                @error('pdf')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @endif
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('files.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>
<script>
    $("select[name='type']").change(function () {
        var i = $(this).val();
        if (i == 2) {
            $(".div-group").removeClass('d-none');
        } else {
            $(".div-group").addClass('d-none');
        }
    });
</script>
