@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Drill List') }}</h2>
        <div class="row">

            @foreach($drills as $drill)

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ $drill->title }}</h3>
                            <a href="{{ route('drills.show', $drill->id) }}" class="btn btn-primary" style="width: 140px;">{{ __('Go Practice') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="paginate" style="margin-top: 50px;">
            {{ $drills->links() }}
        </div>
    </div>
@endsection
