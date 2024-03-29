<?php
if (old()) {
    $data = old();
}
if (isset($data) && empty($data['role_id'])) $data['role_id'] = $data['role'];
?>
<form action="{{ isset($data['id']) ? route('users.update', ['user' => $data['id']]) : route('users.store') }}"
      method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="role">{{__('Role')}}</label>
            <select class="form-control" id="role" name="role">
                @foreach($roles as $roleKey => $roleVal)
                    @if($user['role_id'] >= $roleKey)
                        <option value="{{ $roleKey }}" {{isset($data['role_id']) && $data['role_id'] == $roleKey ? 'selected' : null}}>{{ __($roleVal) }}
                    @endif
                @endforeach
            </select>
            @error('role')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="school_id">{{__('School')}}</label>
            <select class="form-control" id="school_id" name="school_id">
                <option value="">Seçiniz..</option>
                @foreach($schools as $school)
                    <option
                        value="{{$school['id']}}" {{ isset($data['school_id']) && ($school['id'] == $data['school_id']) ? 'selected' : null  }}>{{ $school['name'] }}</option>
                @endforeach
            </select>
            @error('school_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

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
            <label for="email">{{__('Email')}}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data['email'] ?? null }}" autocomplete="off">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="phone_number">{{__('Phone')}}</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number"
                   value="{{ $data['phone_number'] ?? null }}">
            @error('phone_number')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="password">{{__('Password')}}</label>
            <input type="password" class="form-control" id="password" name="password" autocomplete="off">
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

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="language">{{__('Language')}}</label>
            <select class="form-control" id="language" name="language">
                @foreach(config('app.languages') as $lang)
                    <option value="{{$lang}}" {{ isset($data['language']) && $data['language'] == $lang ? "selected" : null }}>{{ __($lang) }}
                @endforeach
            </select>
            @error('language')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3 d-flex align-items-end justify-content-center">
            <div class="custom-control custom-switch">
                <input type="hidden" name="status" value="0">
                <input type="checkbox" class="custom-control-input" name="status" id="status"
                       {{ isset($data['status']) && $data['status'] ? 'checked' : '' }} value="10">
                <label class="custom-control-label" for="status">{{__('Active')}}</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('users.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#school_ids').select2();
        $('#phone_number').inputmask('(999) 999 99 99', { placeholder: '(___) ___ __ __', removeMaskOnSubmit: true });
    });
</script>

