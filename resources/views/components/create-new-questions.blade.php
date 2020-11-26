<div>
    @for($i=1; $i<=10; $i++)
        <div class="form-group row">
            <label for="question{{ $i-1 }}" class="col-md-4 col-form-label text-md-right">{{ __('Question').$i }}</label>

            <div class="col-md-6">
                <input id="question{{ $i-1 }}" type="text" class="form-control @error('question'.($i - 1)) is-invalid @enderror" name="question{{ $i-1 }}" value="{{ old('question'.($i-1)) }}">

                @error('question'.($i - 1))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror

            </div>
        </div>
    @endfor
</div>
