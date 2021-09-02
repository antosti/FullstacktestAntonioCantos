@extends('layouts.app')

@section('content')

    <form method="POST" href="{{route('editPetition', $petition->id)}}">
        @csrf
        <div class="card col-6 ml-5">
            <div class="form-group">
                <label for="formGroupExampleInput" class="ml-5">Title of the petition.</label>
                <input type="text" class="form-control col-4 ml-5" id="formGroupExampleInput" placeholder="Title" name="title" value="<?= $petition->title?>">
            </div>
            <div class="form-group col-auto">
                <label for="exampleFormControlTextarea1" class="ml-4">Description</label>
                <textarea class="form-control col-8 ml-4" id="exampleFormControlTextarea1" rows="3" name="description"><?= $petition->description?></textarea>
            </div>
            <button type="submit" class="m-3 btn btn-success">Edit petition</button>
        </div>
    </form>
@endsection
