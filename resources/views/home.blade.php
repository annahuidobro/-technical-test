@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="mb-3">Launch Rover!</h1>
      </div>
      <div class="col-12">
        <form method="POST" action="{{route('launch')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="col-12">
            <h4 class="mt-4">Rectagle dimetions</h4>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="formGroupExampleInput">Width:</label>
                <input type="number" class="form-control" name="rectangle_width" value="4">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="formGroupExampleInput">Height:</label>
                <input type="number" class="form-control" name="rectangle_height" value="4">
              </div>
            </div>
          </div>

          <div class="col-12">
            <h4 class="mt-4">Initial possition(x,y)</h4>
          </div>
          <div class="row">
            <div class="col-6">
              <label for="formGroupExampleInput">Initial x:</label>
              <input type="number" class="form-control" name="initial_x" value="2">
            </div>
            <div class="col-6">
              <label for="formGroupExampleInput">Initial y:</label>
              <input type="number" class="form-control" name="initial_y" value="2">
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <h4 class="mt-4">Initial orientation (N,E,S or W)</h4>

              <label for="formGroupExampleInput">Initial oritentaion</label>
              <input type="text" class="form-control" name="initial_orientation" value="N">
            </div>
            <div class="col-6">
              <h4 class="mt-4">Commands</h4>
              <label for="formGroupExampleInput"> Commands (A,R or S)</label>
              <input type="text" class="form-control" name="commands" value="ARARARAR">
            </div>
          </div>

          </div>
          <button type="submit" class="btn btn-primary mt-5">Submit</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      </div>
    </div>
  </div>
@endsection