<h1>Expedition result:</h1>


<form>
  <fieldset disabled>
    <div class="form-group">
      <label for="formGroupExampleInput">Succes=1/Fail=0:</label>
      <input type="text" clas="form-control" name="success" value="{{$success}}"
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput">Final possition:</label>
      <input type="text" class="form-control" name="final_position" value="{{$final_position}}">
    </!--div>
    <div class="form-group">
      <label for="formGroupExampleInput">Final oritentaion</label>
      <input type="text" class="form-control" name="final_orientation" value="{{$final_orientation}}">
    </div>
    <div class="form-group">
      <label for="formGroupExampleInput">Used commands:</label>
      <input type="text" class="form-control" name="commands" value="{{$commands}}">
    </div>
    <div class="form-group">Rectagle dimetions
      <label for="formGroupExampleInput">Width:</label>
      <input type="text" class="form-control" name="rectangle_width" value="{{ $rectangleWidth }}">
      <label for="formGroupExampleInput">Height:</label>
      <input type="text" class="form-control" name="rectangleHeight" value="{{$rectangleHeight}}">
    </div>
  </fieldset>
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