@extends('admin.layouts.app')

@section('title', 'Home')

@section('content')

  <div class="row">
@if(auth()->user()->hasRole('admin'))

    <h2>Admin Dashboard</h2>
@else
<h2>User Dashboard</h2>
@endif
<div class="col-md-8 col-md-offset-2">
  <h3>Please check the chekbox to calculate the value</h3>
  @for($i=1;$i<5;$i++)
  <div class="checkbox">
    <label>
      <input
      class="bsb-checkbox"
      type="checkbox"
      name="amount[]"
      value="{{$i*100}}"
      > {{$i*100}}
    </label>
  </div>
  <br/>
  @endfor
  <div class="form-group">
    <label>Total:</label><span>&nbsp;<b id="total">0</b></span>

  </div>

</div>

@endsection
@push('script')
<script>
  let total=0;
  $('.bsb-checkbox').on('change',function(){
    let val=parseInt($(this).val());
         if($(this).is(":checked")){
           total+=val;
         }else{
              total-=val;
          }
    $('#total').text(total)
    
  })

</script>
@endpush