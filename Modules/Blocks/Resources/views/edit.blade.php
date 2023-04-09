<!-- sample modal content -->
<div id="PageContentModal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">{{$data->block_name}}
                </h5>
            </div>
            <form action="{{url('admin/pages/blocks/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @php
                        $block_data=json_decode($data->data);
                        @endphp
                        @foreach($block['data'] as $key=> $content)
                        @php
                        $label=str_replace('_',' ',$key);
                        $blck_name=$content['name'];
                        @endphp
                        <div class="col-md-4">
                            <label for="">{{ucfirst($label)}}</label>
                            <input type="{{$content['type']}}" class="form-control" name="{{$blck_name}}" placeholder="{{ucfirst($label)}}"
                            @if($content['type']!="file" && isset($block_data->$blck_name)) value="{{$block_data->$blck_name}}" @endif
                            >
                            @if($content['type']=="file" && isset($block_data->$blck_name)){{$block_data->$blck_name}} @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                    class="btn btn-primary waves-effect waves-light">Save
                    changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->