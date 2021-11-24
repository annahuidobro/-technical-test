@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1 class="mb-3">Expedition result:</h1>

        <table class="table table-striped mt-4">
          <tbody>
          <tr>
              <td>Result</td>
              <td>
                @if($success == 1)
                  <p>Great! Rover arrived succesfully!</p>
                @else
                  <p>Oh! Rover came out of the square</p>
                @endif
              </td>
            </tr>
            <tr>
              <td>Final position:</td>
              <td>{{ $final_position }}</td>
            </tr>
            <tr>
              <td>Final orientation:</td>
              <td>{{ $final_orientation }}</td>
            </tr>
            <tr>
              <td>Used commands:</td>
              <td>{{ $commands }}</td>
            </tr>
            <tr>
              <td>Rectagle dimetions (width):</td>
              <td>{{ $rectangleWidth }}</td>
            </tr>
            <tr>
              <td>Rectagle dimetions (height):</td>
              <td>{{ $rectangleHeight }}</td>
            </tr>
            <tr>
              <td>Steps</td>
              <td>
                @foreach($steps as $step)
                  <p>({{ $step['x'] }}, {{ $step['y'] }})</p>
                @endforeach
              </td>
            </tr>
          </tbody>
        </table>

        <p>
        <a class="btn btn-primary" data-toggle="collapse" href="{{route('home')}}" role="button" aria-expanded="false" aria-controls="collapseExample">
            Go back
          </a>
        </p>

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