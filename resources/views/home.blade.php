@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                        @foreach ($petitions as $p)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <?= $p->title?>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= $p->description?></p>
                                    <a href="#" class="btn btn-primary">See the petition</a>
                                </div>
                            </div>
                        @endforeach
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
