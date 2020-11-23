@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Page') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('drills.update', $drills->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $drills->title) }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
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
                                            @if($category->id === $selected_category)
                                                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @foreach($questions as $question)
                                <div class="form-group row">
                                    <label for="question{{$loop->iteration}}" class="col-md-4 col-form-label text-md-right">{{ __('Question').$loop->iteration }}</label>
                                    <div class="col-md-6">

                                        <input id="question{{$loop->iteration}}" type="text" class="form-control @error('question'.$loop->iteration) is-invalid @enderror" name="question{{$loop->iteration}}" value="{{ old('question'.$loop->iteration, $question->question) }}">

                                        @error('question'.$loop->iteration)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                    </div>
                                </div>
                            @endforeach

                            @if($questions->count()+1 < 10)
                                @for($i=$questions->count()+1; $i<=10; $i++)
                                    <div class="form-group row">
                                        <label for="question{{$i}}" class="col-md-4 col-form-label text-md-right">{{ __('Question').$i }}</label>
                                        <div class="col-md-6">

                                            <input id="question{{$i}}" type="text" class="form-control @error('question'.$i) is-invalid @enderror" name="question{{$i}}" value="{{ old('question'.$i) }}">

                                            @error('question'.$i)
                                            <span class="invalid-feedback" role="alert">
                                               <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>
                                @endfor
                            @endif
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
