<!-- sample modal content -->
<div id="TableBookingDetailModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Table Booking Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row m-0">
                    <div class="col-6">
                        <h6>Name: <b>@if(UserDetail($data->user_id)!=null){{UserDetail($data->user_id)->name}} @endif</b></h6>
                        <h6>Email: <b>@if(UserDetail($data->user_id)!=null){{UserDetail($data->user_id)->email}} @endif</b></h6>
                        <h6>Phone: <b>@if(UserDetail($data->user_id)!=null){{UserDetail($data->user_id)->phone}} @endif</b></h6>

                    </div>
                    <div class="col-6 text-end">
                        <h6>Date: <b>{{Carbon\Carbon::parse($data->booking_date)->format('D d-M-Y')}}</b></h6>
                        <h6>Sitting: <b>@if($data->sitting()->exists()) {{Carbon\Carbon::parse($data->sitting->time_from)->format('h:i A')}} @endif</b></h6>
                        <h6>Table: <b>@if($data->table()->exists() && $data->table->table->exists()) Guests {{$data->table->table->guests}} ({{$data->table->table->name}}) @endif</b></h6>

                        <h6>Price: <b>@if($data->table()->exists()) £ {{$data->table->price}}  @endif</b></h6>

                    </div>
                    <hr class="m-0 p-0 mb-3">
                    <div class="col-12">
                        <h5>Extras</h5>
                        <table class="table table-bordered table-sm w-100">
                            <thead class="text-center bg-success text-white">
                                <th class="text-center">Name</th>
                                <th class="text-center">Price</th>
                            </thead>
                            <tbody>
                                @forelse($data->extras as $extra)
                                <tr class="text-center">
                                    <td class="text-center">{{$extra->name}}</td>
                                    <td class="text-center">£ {{$extra->price}}</td>
                                </tr>
                                @empty
                                <tr class="text-center"><td colspan="2">No Extra found</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 text-end">
                        <h5>Total: <b>£ {{number_format($data->amount)}}</b></h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>