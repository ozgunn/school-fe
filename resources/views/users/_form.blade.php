<form action="{{ isset($data['id']) ? route('users.update', ['user' => $data['id']]) : route('users.store') }}"
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
                @if(isset($data['id']))
                    <option value="{{ $data['school']['id'] }}">{{ $data['school']['name'] }}
                @else
                    <option value="">Seçiniz..</option>
                    @foreach($schools as $school)
                        <option
                            value="{{$school['id']}}" {{ isset($data['school']['id']) && $data['school']['id'] == $school['id'] ? 'selected' : null  }}>{{ $school['name'] }}</option>
                    @endforeach
                @endif
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
                <input type="text" class="form-control" id="email" name="email" value="{{ $data['email'] ?? null }}">
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">{{__('Phone')}}</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['phone'] ?? null }}">
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="password">{{__('Password')}}</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ $data['password'] ?? null }}">
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-md-3">
                <label for="password2">{{__('Password (again)')}}</label>
                <input type="password" class="form-control" id="password2" name="password2" value="{{ $data['password2'] ?? null }}">
                @error('password2')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="hidden" name="status" value="0">
                <input type="checkbox" class="custom-control-input" name="status" id="status" {{ isset($data['status']) && $data['status'] ? 'checked' : '' }} value="1">
                <label class="custom-control-label" for="status">{{__('Active')}}</label>
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
    $('#phone').inputmask('(999) 999 99 99', { placeholder: '(___) ___ __ __' });
});
</script>

