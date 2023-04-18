@extends('include.master')
@section('title')
Home | Dante NYC
@endsection
@section('content')
@php
$total=0;
@endphp
<div class="site-content">
    <div class="site-header-spacer-desktop" aria-hidden="true"></div><div class="site-header-spacer-mobile" aria-hidden="true" style="height:62.125px;"></div>
    <main class="site-content__main">
        <section class="content container">
            <div class="row justify-content-center" style="margin-top: 10%;">
                <div class="col-10">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4 class="card-title text-dark fw-bold">Your Bookings</h4>
                        </div>
                        <div class="card-body">
                            <div class="row text-dark">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table align-items-center text-center w-100">
                                            <thead class="text-center">
                                                <th class="text-center">Sitting</th>
                                                <th class="text-center">Table</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $table)

                                                <tr>
                                                    <td>
                                                        @if($table->sitting()->exists())
                                                        {{\Carbon\Carbon::parse($table->sitting->time_from)->format('h:i A')}}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($table->table()->exists() && $table->table->table()->exists())
                                                        Guests {{$table->table->table->guests}} ({{$table->table->table->name}})
                                                        @endif                                                        
                                                    </td>

                                                    <td>{{number_format($table->amount)}}</td>
                                                    <td>
                                                        @if($table->status==0)
                                                            <span class="btn m-0 btn-success">Active</span>
                                                        @else
                                                            <span class="btn m-0 btn-info">Served</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info m-0 show-details" href="javascript:void(0)" data-href="{{url('table-bookings/user-show/'.$table->id)}}"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection
@section('modal')
<div id="mdl"></div>
@endsection
@section('js')

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.show-details', function() {
    var url=$(this).data('href');

    $.ajax({
      url:url,
      success:function(res){
        console.log(res);

        if(res.success){
          $("#mdl").html(res.html);
          $("#TableBookingDetailModal").modal('show');
        }
        else{
          error(res.message);
        }
      },
      error:function(res) {
        console.log(res);        
        error("Something went wrong with this error: "+ res.responseJSON.message);
      }
    })

  });
    });
</script>

@endsection