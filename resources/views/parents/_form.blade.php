<?php
//if(old()) {
//    $data = old();
//}
//dd($data);
?>

<form action="{{ isset($data['id']) ? route('parents.update', ['parent' => $data['id']]) : route('parents.store') }}"
      method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="school_id">{{__('School')}}</label>
            <select class="form-control" id="school_id" name="school_id" {{ isset($data['id']) ? 'readonly': null }}>
                @if(false)
                    <option value="{{ $data['school']['id'] }}">{{ $data['school']['name'] }}
                @else
                    <option value="">Seçiniz..</option>
                    @foreach($schools as $school)
                        <option
                            value="{{$school['id']}}" {{ (isset($data['school']['id']) && $data['school']['id'] == $school['id']) || old('school_id')==$school['id'] ? 'selected' : null  }}>{{ $school['name'] }}</option>
                    @endforeach
                @endif
            </select>
            @error('school_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="first_name">{{__('Name')}}</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $data['user_data']['first_name'] ?? null }}">
            @error('first_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="last_name">{{__('Lastname')}}</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data['user_data']['last_name'] ?? null }}">
            @error('last_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">{{__('Email')}}</label>
            <input type="text" class="form-control" id="email" name="email" value="{{ $data['email'] ?? null }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone">{{__('Phone')}}</label>
            <input type="text" class="form-control" id="phone" name="phone_number" value="{{ $data['phone_number'] ?? null }}">
            @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="password">{{__('Password')}}</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="password_confirmation">{{__('Password (again)')}}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            @error('password_confirmation')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row align-items-end">
        <div class="form-group col-md-3">
            <label for="language">{{__('Language')}}</label>
            <select class="form-control" id="language" name="language">
                @foreach(config('app.languages') as $lang)
                    <option
                        value="{{$lang}}" {{ (isset($data['language']) && $data['language']==$lang) ? 'selected' : null }}>{{ $lang }}</option>
                @endforeach
            </select>
            @error('language')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <div class="custom-control custom-switch">
                <input type="hidden" name="status" value="0">
                <input type="checkbox" class="custom-control-input" name="status" id="status"
                       {{ isset($data['status']) && $data['status'] ? 'checked' : '' }} value="{{ \App\Models\User::STATUS_ACTIVE }}">
                <label class="custom-control-label" for="status">{{__('Active')}}</label>
            </div>
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
<script>
    $(document).ready(function () {
        $('#phone').inputmask('(999) 999 99 99', {placeholder: '(___) ___ __ __'});
    });
</script>

