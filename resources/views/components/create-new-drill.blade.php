<div class="create_new_drill">
    <div class="form-group row">
        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" autocomplete="title" autofocus>

            @error('title')
            <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

        <div class="col-md-6">
            <select name="category_id" id="category_id" @error('category_id') is-invalid @enderror>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>

            @error('category_id')
            <span class="invalid-feedback" role="alert" style="font-size: 16px;">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <x-create-new-questions />

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary" style="width: 140px;">
                {{ __('Register') }}
            </button>
            <x-back-button />
        </div>
    </div>
</div>
