@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))

@section('content')
  <div class="card">
    @include('extras.index_header')

    <div class="card-content">



          <div class="table-responsive">
            <table class="table table-shopping" id="user_table">
              <thead>
              <tr>
                <th width="40">SN.</th>
                <th>Name</th>
                <th>Email Address</th>
                <th width="80">Actions</th>
              </tr>
              </thead>
              <tbody>
                @forelse($users as $key=>$v)
                  <tr id="asdh-{{$v->id}}">
                    <td>{{$key+1}}</td>
                    
                    <td>{{$v->name}}</td>
                    <td>{{$v->email}}</td>

                    <td>
                       @include('admin.user.options',['user'=>$v])
                    </td>
                   
                  </tr>
                @empty
                  <tr>
                    <td colspan="4">No data available</td>
                  </tr>
                @endforelse
                </tbody>

            </table>
          </div>






    </div>

    

  </div>
@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){
    $('table').dataTable({
          "paging": true,
          "lengthChange": true,
          "lengthMenu": [10, 15, 20],
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          'columnDefs': [{
          'orderable': false,
          'targets': [2]
          }]
    });

</script>
@endpush