<form action="{{ isset($data['id']) ? route('groups.update', ['group' => $data['id']]) : route('groups.store') }}"
      method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="school_id">{{__('School')}}</label>
            <select class="form-control" id="school_id" name="school_id">
                <option value="">Seçiniz..</option>
                @foreach($schools as $school)
                    <option
                        value="{{$school['id']}}" {{ isset($data['school']['id']) && $data['school']['id'] == $school['id'] ? 'selected' : null  }}>{{ $school['name'] }}</option>
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
            <label for="age_group">{{__('Age Group')}}</label>
            <select class="form-control" id="age_group" name="age_group">
                @for($i=1; $i<7; $i++)
                    <option {{ isset($data['age_group']) && $data['age_group'] == $i ? 'selected' : null  }}>{{ $i  }}</option>
                @endfor
            </select>
            @error('age_group')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('schools.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>

