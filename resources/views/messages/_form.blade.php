<?php
if (old()) {
    $data = old();
}
?>

<form
    action="{{ isset($data['id']) ? route('messages.update', ['food_menu' => $data['id']]) : route('messages.store') }}"
    method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="student_id">{{__('Student')}}</label>
            <select class="form-control select-student" name="student_id" id="student_id">
                <option value="">{{__('Select')}}</option>
                @if(!empty($students))
                    @foreach($students as $student)
                        <option
                            value="{{ $student['id'] }}" {{ (isset($data['student_id']) && $student['id'] == $data['student_id']) ? "selected" : null  }}>{{ $student['name'] }}
                    @endforeach
                @endif
            </select>
            @error('student_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="message">{{__('Message')}}</label>
            <textarea class="form-control" id="message"
                      name="message">{{ $data['message'] ?? null }}</textarea>
            @error('message')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Send')}}</button>
        </div>
        <div class="ml-3">
            <a href="{{ route('messages.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
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
        $('.select-student').select2();
        $('.select-student').on('select2:open', function (e) {
            $('.select2-search__field').val('');
        });
    });
</script>
