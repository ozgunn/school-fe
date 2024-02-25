<?php
if (old()) {
    $data = old();
}
?>

<form
    action="{{ isset($data['id']) ? route('food-menu.update', ['food_menu' => $data['id']]) : route('food-menu.store') }}"
    method="post">
    @if(isset($data['id']))
        @method('PUT')
    @endif
    @csrf
    <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">

    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="date">{{__('Day')}}</label>
            <input id="date" name="date" type="date" class="form-control"
                   value="{{ isset($data['date']) ? \Illuminate\Support\Carbon::parse($data['date'])->format("Y-m-d") : \Illuminate\Support\Carbon::now()->format("Y-m-d") }}">
            @error('date')
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
            <label for="first_meal">{{__('Breakfast')}}</label>
            <textarea class="form-control" id="first_meal"
                      name="first_meal">{{ $data['first_meal'] ?? null }}</textarea>
            @error('first_meal')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="second_meal">{{__('Lunch')}}</label>
            <textarea class="form-control" id="second_meal"
                      name="second_meal">{{ $data['second_meal'] ?? null }}</textarea>
            @error('second_meal')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="third_meal">{{__('Snack Time')}}</label>
            <textarea class="form-control" id="third_meal"
                      name="third_meal">{{ $data['third_meal'] ?? null }}</textarea>
            @error('third_meal')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('food-menu.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
        </div>
    </div>
</form>
