<form action="{{ isset($data['id']) ? route('buses.update', ['bus' => $data['id']]) : route('buses.store') }}"
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
                <option value="">{{ __('Select') }}</option>
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
            <label for="teacher_id">{{__('Teacher')}}</label>
            <select class="form-control" id="teacher_id" name="teacher_id">
                <option value="">{{ __('Select') }}</option>
                @foreach($teachers as $teacher)
                    <option
                        value="{{$teacher['id']}}" {{ isset($data['teacher']['id']) && $data['teacher']['id'] == $teacher['id'] ? 'selected' : null  }}>{{ $teacher['name'] }}</option>
                @endforeach
            </select>
            @error('teacher_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="license_plate">{{__('License Plate')}}</label>
            <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ $data['license_plate'] ?? null }}">
            @error('license_plate')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="start_time">{{__('Start Time')}}</label>
            <select class="form-control" id="start_time" name="start_time">
                <option value="">{{ __('Select') }}</option>
                @for($i=1; $i<=24; $i++)
                    @php
                        $str = sprintf('%02d:00', $i);
                    @endphp
                    <option {{ isset($data['start_time']) && \Illuminate\Support\Carbon::parse($data['start_time'])->format('H:i') == $str ? 'selected' : null  }}>{{ $str }}</option>
                @endfor
            </select>
            @error('start_time')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-3">
            <label for="end_time">{{__('End Time')}}</label>
            <select class="form-control" id="end_time" name="end_time">
                <option value="">{{ __('Select') }}</option>
                @for($i=1; $i<=24; $i++)
                    @php
                        $str = sprintf('%02d:00', $i);
                    @endphp
                    <option {{ isset($data['end_time']) && \Illuminate\Support\Carbon::parse($data['end_time'])->format('H:i') == $str ? 'selected' : null  }}>{{ $str }}</option>
                @endfor
            </select>
            @error('end_time')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <div class="custom-control custom-switch">
                <input type="hidden" name="status" value="0">
                <input type="checkbox" class="custom-control-input" name="status" id="status"
                       {{ isset($data['status']) && $data['status'] ? 'checked' : '' }} value="1">
                <label class="custom-control-label" for="status">{{__('Active')}}</label>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('buses.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>

