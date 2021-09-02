@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5><?=$petition->title?></h5></div>
                    <h6 class="m-3">Petition created by: <?= $user->name?></h6>
                    <div class="card-body">
                        <div class="card-text"><?= $petition->description?></div>
                    </div>

                    <p class="m-3"><?= $count?> signatures.</p>

                    <?php if($signed):?>
                        <a href="#" class="btn btn-success">You already signed this petition!</a>
                    <?php else: ?>
                        <a href="{{route('newSign', [auth()->user()->id, $petition->id])}}" class="btn btn-primary">Sign this petition</a>
                    <?php endif;?>

                </div>
            </div>
        </div>
    </div>
@endsection
