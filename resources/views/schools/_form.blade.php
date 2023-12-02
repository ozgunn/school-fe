        <form action="{{ isset($data['id']) ? route('schools.update', ['school' => $data['id']]) : route('schools.store') }}" method="post">
            @if(isset($data['id']))
                @method('PUT')
            @endif
            @csrf
            <input type="hidden" name="id" value="{{ $data['id'] ?? null }}">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="name">{{__('Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] ?? null }}">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">{{__('Phone')}}</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $data['phone'] ?? null }}">
                    @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email">{{__('E-mail')}}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $data['email'] ?? null }}">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="address">{{__('Address')}}</label>
                <textarea class="form-control" id="address" name="address" rows="3">{{ $data['address'] ?? null }}</textarea>
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
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
                    <a href="{{ route('schools.index') }}" class="btn btn-light">{{__('Cancel')}}</a>
                </div>
            </div>
        </form>

