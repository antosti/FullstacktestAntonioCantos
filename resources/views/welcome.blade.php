@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Petitions page') }}</div>

                        @foreach ($petitions as $p)
                            <div class="card mt-3 m-2">
                                <div class="card-header">

                                    <h5><?= $p->title?></h5>

                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= $p->description?></p>
                                    <a href="{{route('viewPetition', $p->id)}}" class="btn btn-primary">See the petition</a>
                                </div>
                            </div>
                        @endforeach


                </div>
            </div>
        </div>
    </div>

@endsection


