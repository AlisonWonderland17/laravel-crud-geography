@extends('geography.layout')
@section('content')

<div class="wrapperdiv">
    <div class="formcontainer">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Geography Data</h2>
                </div>
            </div>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <strong>Oops! There are some problems with your input. Try again.</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form 
        action="{{ route('geography.update', $geography->id) }}" 
        method="POST" 
        enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group row">
                        <label for="country" class="col-sm-2 col-form-control">Country</label>
                        <div class="col-sm-10">
                            <input type="text" name="country" id="country" class="form-control" value="{{ $geography->country }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="continent" class="col-sm-2 col-form-control">Continent</label>
                        <div class="col-sm-10">
                            <select name="continent" id="continent" class="form-control">
                                <option value="">Select Continent</option>
                                @if($continents)
                                @foreach($continents as $continent)
                                @if($continent == $geography->continent)
                                    <option value="{{ $continent }}" selected >{{ $continent }}</option>
                                @else
                                    <option value="{{ $continent }}">{{ $continent }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="capital" class="col-sm-2 col-form-control">Capital</label>
                        <div class="col-sm-10">
                            <input type="text" name="capital" id="capital" class="form-control" value="{{ $geography->capital }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="flag" class="col-sm-2 col-form-control">Flag</label>
                        <div class="col-sm-10">
                            <input type="file" name="flag" id="flag" class="form-control-file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" name="submit" id="submit" class="btn btn-outline-info">Update</button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>

@endsection