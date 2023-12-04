<form action="{{ isset($data['id']) ? route('classes.update', ['class' => $data['id']]) : route('classes.store') }}"
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
            <label for="group_id">{{__('Group')}}</label>
            <select class="form-control" id="group_id" name="group_id" {{ isset($data['id']) ? 'readonly': null }}>
                @if(isset($data['id']))
                    <option value="{{ $data['group']['id'] }}">{{ $data['group']['name'] }}
                @else
                    <option value="">Seçiniz..</option>
                @endif
            </select>
            @error('group_id')
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

    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('classes.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>
<script>
    var groups = {!! json_encode($groups) !!};
    $('#school_id').on('change', function () {
        var school_id = $(this).val();

        var groups = getGroups(school_id);
        updateGroups(groups);
    });

    function getGroups(school_id) {
        return groups.filter(function (group) {
            return group.school.id == school_id;
        }).map(function (group) {
            return group;
        });
    }

    function updateGroups(groups) {
        $('#group_id').empty();

        $.each(groups, function (index, group) {
            $('#group_id').append($('<option>', {
                value: group.id,
                text: group.name
            }));
        });
    }
</script>

