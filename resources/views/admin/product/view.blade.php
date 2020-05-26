@extends('admin.layouts.app')

@section('title', 'All '. ucwords(str_plural($routeType)))

@section('content')
  <div class="card">
    @include('extras.index_header')

    <div class="card-content">



          <div class="table-responsive">
            <table class="table table-shopping" id="product_table">
              <thead>
              <tr>
                <th width="40">SN.</th>
                <th>Name</th>
               

                <th width="80">Actions</th>
              </tr>
              </thead>

            </table>
          </div>






    </div>

  </div>
@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){
     $('#product_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route('product.index')}}',
        columns: [
            {title:'SN',
                 render: function( data, type, full, meta ) {
                        return meta.row+1;
                    }
            },
            {data: 'name', name: 'name'},
           
            {data: 'action', name: 'action', orderable: true, searchable: true}


        ],
            initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                .on('change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
            });
        }
    });

 });


</script>
@endpush