<?php
if (old()) {
    $data = old();
}
?>

<form action="{{ isset($data['id']) ? route('announcements.update', ['announcement' => $data['id']]) : route('announcements.store') }}"
      method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
    @include('../includes/school-class-selector')

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="target">{{__('Announcement Target')}}</label>
            <select class="form-control" name="target" id="target">
                <option value="">{{__('Select')}}</option>
                <option
                    value="1" {{ (isset($data['target']) && 1 == $data['target']) ? "selected" : null  }}>{{ __('announcements.target_1') }}
                <option
                    value="2" {{ (isset($data['target']) && 2 == $data['target']) ? "selected" : null  }}>{{ __('announcements.target_2') }}
            </select>
            @error('target')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="lang">{{__('Language')}}</label>
            <select class="form-control" id="lang" name="lang">
                @foreach(config('app.languages') as $lang)
                    <option
                        value="{{$lang}}" {{ (isset($data['lang']) && $data['lang']==$lang) ? 'selected' : null }}>{{ __($lang) }}</option>
                @endforeach
            </select>
            @error('lang')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="content">{{__('Content')}}</label>
            <textarea class="form-control" id="content" name="content" rows=3>{{ $data['content'] ?? null }}</textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex justify-content-between col-md-6">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('announcements.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
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


