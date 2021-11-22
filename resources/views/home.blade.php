<h1>Launch Rover!</h1>

<form method="POST" action="{{route('launch')}}">
<input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <div class="form-group">Rectagle dimetions
    <label for="formGroupExampleInput">Width:</label>
    <input type="text" class="form-control" name="rectangle_width" value="4">
    <label for="formGroupExampleInput">Height:</label>
    <input type="text" class="form-control" name="rectangle_height" value="4">
  </div>
  <div class="form-group">Initial possition(x,y)
    <label for="formGroupExampleInput">Initial x:</label>
    <input type="text" class="form-control" name="initial_x" value="2">
    <label for="formGroupExampleInput">Initial y:</label>
    <input type="text" class="form-control" name="initial_y" value="2">
  </div>
  <div class="form-group">Initial orientation (N,E,S or W)
    <label for="formGroupExampleInput">Initial oritentaion</label>
    <input type="text" class="form-control" name="initial_orientation" value="N">
    
  </div>
  <div class="form-group">Commnds
    <label for="formGroupExampleInput"> Commands (A,R or S)</label>
    <input type="text" class="form-control" name="commands" value="ARAR">
  </div>
  <button type="submit" class="btn btn-primary mb-2">Submit</button>
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