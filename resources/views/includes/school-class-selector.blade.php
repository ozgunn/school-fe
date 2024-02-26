<div class="form-row">
    <div class="form-group col-md-6">
        <label for="school_id">{{__('School')}}</label>
        <select class="form-control" id="school_id" name="school_id">
                <option value="">{{__('Select')}}</option>
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
@if(isset($groups))
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="group_id">{{__('Group')}}</label>
        <select class="form-control" id="group_id" name="group_id">
            <option value="">{{__('Select')}}</option>
            @foreach($groups as $group)
                <option
                    value="{{$group['id']}}" {{ isset($data['group_id']) && $data['group_id'] == $group['id'] ? 'selected' : null  }}>{{ $group['name'] }}</option>
            @endforeach
        </select>
        @error('group_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
@endif
@if(isset($classes))
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="class_id">{{__('Class')}}</label>
            <select class="form-control" id="class_id" name="class_id">
                <option value="">{{__('Select')}}</option>
                @if(isset($data['id']) && !empty($data['class']))
                    <option value="{{ $data['class_id'] }}" selected>{{ $data['class']['name'] }}</option>
                @endif
            </select>
            @error('class_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
@endif
@if(isset($teachers))
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="teacher_id">{{__('Teacher')}}</label>
        <select class="form-control" id="teacher_id" name="teacher_id">
            @if(isset($data['id']) && !empty($data['teacher']))
                @foreach($teachers as $teacher)
                    <option
                        value="{{ $teacher['id'] }}" {{ (isset($data['teacher']) && $teacher['id'] == $data['teacher']['id']) ? "selected" : null  }}>{{ $teacher['name'] }}
                @endforeach
            @endif
        </select>
        @error('teacher_id')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
@endif
<script>
    var groups = {!! isset($groups) ? json_encode($groups) : 'null' !!};
    var teachers = {!! isset($teachers) ? json_encode($teachers) : 'null' !!};
    var classes = {!! isset($classes) ? json_encode($classes) : 'null' !!};
    var data = {!! isset($data) ? json_encode($data) : 'null' !!};
    var selectOption = {!! "\"<option value=''>". __('Select') . "</option>\""; !!};
    var school_id = $('#school_id').val();
    var group_id = $('#group_id').val();

    $('#school_id').on('change', function () {
        school_id = $(this).val();
        if (groups) {
            updateGroups(getGroups(school_id));
        }
        if (teachers) {
            updateTeachers(getTeachers(school_id));
        }
    });

    if(school_id) {
        $('#school_id').trigger('change');
    }

    $('#group_id').on('change', function () {
        group_id = $(this).val();
        school_id = $('#school_id').val();

        if (classes) {
            updateClasses(getClasses(group_id));
        }
        if (teachers) {
            updateTeachers(getTeachers(school_id));
        }
    });

    $('#class_id').on('change', function () {
        var class_id = $(this).val();

        if (teachers) {
            //updateTeachers(getTeachers(class_id));
        }
    });

    function getGroups(school_id) {
        return groups.filter(function (group) {
            return group.school.id == school_id;
        }).map(function (group) {
            return group;
        });
    }

    function getClasses(group_id) {
        return classes.filter(function (i) {
            return i.group.id == group_id;
        }).map(function (i) {
            return i;
        });
    }

    function getTeachers(school_id) {
        return teachers.filter(function (i) {
            return i.school?.id == school_id;
        }).map(function (i) {
            return i;
        });
    }

    function updateGroups(groups) {
        return;
        $('#group_id').empty().append(selectOption);
        $.each(groups, function (index, group) {
            $('#group_id').append($('<option>', {
                value: group.id,
                text: group.name,
                selected: data && (group.id === data.group.id)
            }));
        });
    }
    function updateClasses(classes) {
        $('#class_id').empty().append(selectOption);

        $.each(classes, function (index, cls) {
            $('#class_id').append($('<option>', {
                value: cls.id,
                text: cls.name,
                selected: data && (cls.id === data.class.id)
            }));
        });
    }
    function updateTeachers(teachers) {
        $('#teacher_id').empty();

        $.each(teachers, function (index, i) {
            $('#teacher_id').append($('<option>', {
                value: i.id,
                text: i.name
            }));
        });
    }
</script>
