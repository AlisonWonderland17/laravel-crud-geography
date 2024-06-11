@extends('geography.layout')
@section('content')
<div class="wrapperdiv">

@if($message = Session::get('success'))
<div class="alert alert-success text-center">
    {{ $message }}
</div>
@endif

<table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Country</th>
      <th scope="col">Continent</th>
      <th scope="col">Capital</th>
      <th scope="col">Actions</th> 
    </tr>
  </thead>
  @if($geographies)
  <tbody>
    @foreach($geographies as $geography)
    <tr>
      <td class="align-middle"><img src="{{ asset('uploads/'.$geography->flag) }}" class="img-thumbnail" /></td>
      <td class="align-middle">{{ $geography->country }}</td>
      <td class="align-middle">{{ $geography->continent }}</td>
      <td class="align-middle">{{ $geography->capital }}</td>
      <td class="align-middle">
                <form action="{{ route('geography.destroy', $geography->id) }}" method="post">
      <a href="{{ route('geography.show', $geography->id) }}" class="btn btn-warning">View</a>
      <a href="{{ route('geography.edit', $geography->id) }}" class="btn btn-info">Modify</a>
      
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')">Delete</button>

      </form>
      </td>
    </tr>  
    @endforeach
  </tbody> 
  @endif
</table>
<div class="d-flex">
  <div class="mx-auto">
  {!! $geographies->appends(\Request::except('page'))->render() !!}
  </div>
</div>
</div>
@endsection