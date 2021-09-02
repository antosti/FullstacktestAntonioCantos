@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Your petitions') }} <a href="#" class="btn btn-primary ml-5">Create petition</a></div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @foreach ($petitions as $p)
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5><?= $p->title?></h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?= $p->description?></p>
                                    <a href="{{route('viewPetition', $p->id)}}" class="btn btn-success">See the petition</a>
                                    <a href="#" class="btn btn-warning">Edit petition</a>
                                    <form class="text-center" action="{{ route('deletePetition', $p->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="m-3 btn btn-danger">Delete petition</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
