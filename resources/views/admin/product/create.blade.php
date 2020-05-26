@extends('admin.layouts.app')

@section('title', 'Add a new '. ucfirst($routeType))

@section('content')

  <form action="{{$edit?route($routeType.'.update',$model):route($routeType.'.store')}}"
        method="post"
        enctype="multipart/form-data"
        id="product_validation">
    {{csrf_field()}}
    {{$edit?method_field('PUT'):''}}
    <div class="card">

      <div class="card-header card-header-text" data-background-color="green">
        <h4 class="card-title">{{ $edit?'Edit':'Add a New '. ucfirst($routeType) }}</h4>
      </div>

      <div class="card-content">

       
        

        {{--name--}}
        <div class="form-group" {{ $errors->has('name')?'has-error is-focused':'' }}>
          <label for="name">{{ ucwords('name') }}</label>
          <input type="text"
                 class="form-control"
                 id="name"
                 name="name"
                 required="true"
                 value="{{$edit?old('name')??$model->name:old('name')}}"/>



        </div>
        {{--./name--}}

       

        {{--description--}}
        <div class="form-group" {{ $errors->has('description')?'has-error is-focused':'' }}>
          <label for="address">{{ ucwords('Description') }}</label>
          <textarea class="form-control asdh-tinymce"
                        id="description"
                        name="description"
                        rows="10">{{$edit?$model->description:old('description')}}</textarea>


        </div>
        {{--.description--}}



        {{-- Product Images--}}
        @if($edit && $model->images->count()>0)
        
         <div class="image_gallery">
           <div class="row">
             @foreach($model->images as $image)
             <div class="col-md-3">
              <img src="{{$image->getImage()}}" alt="{{$model->name}}" class="img-thumbnail">
             </div>
             @endforeach
        
        </div>
      </div>
      @endif
      
  
          <div class="form-group" >
            <label class="control-label">
                   Images
                    <small></small>
                </label>
               <input id="input-b3" name="images[]" type="file" class="file" multiple
                data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
          </div>
      <!--   </div> -->

     



        {{--submit--}}
        <div class="form-footer text-right">
          <a href="{{route('product.index')}}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>
          <button type="submit" class="btn btn-success btn-fill btn-fill btn-prevent-multiple-submit2"><i class="fa fa-save"></i> {{$edit?'Update':'Save'}}</button>
        </div>
        {{--./submit--}}

      </div>

    </div>
  </form>
@endsection

@push('script')
@include('extras.tinymce')
  <script>
    $(document).ready(function () {
      $('#product_validation').validate({
            rules: {
                contact_no: {
                  required: true,
                  maxlength: 14
                }
              },
              submitHandler: function(form) {
              var $buttonToDisable = $('.btn-prevent-multiple-submit2');
              $buttonToDisable.prop('disabled', true);
               $buttonToDisable.html('<i class="fa fa-spinner fa-spin"></i> ' + $buttonToDisable.text());
               form.submit();

               }

        });

    });
  </script>
@endpush