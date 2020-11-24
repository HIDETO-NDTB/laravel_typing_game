@extends('layouts.app')

@section('content')
    <div id="app">
        <example-component
            title="{{__('Practice').'「'.$drill->title.'」'}}"
            :questions="{{ $questions }}" category-name="{{ $category->category_name }}">
        </example-component>
    </div>
@endsection
