<style>
.tox-tinymce-aux {
    z-index: 999999!important;
}
.tox .tox-menu{
    background-color: white !important;
}
</style>
<!-- sample modal content -->
<div id="PageContentModal" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                    @php
                    $block_name=ucfirst($data->block_name);
                    @endphp
                <h5 class="modal-title" id="myModalLabel1">{{str_replace('_', ' ',$block_name)}}
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
                        <div class="@if(isset($content['class']) && $content['class']=='editor') col-md-12 @else col-md-4 @endif">
                            <label for="">{{ucfirst($label)}}</label>
                            <input type="{{$content['type']}}" class="form-control @if(isset($content['class'])) {{$content['class']}} @endif" name="{{$blck_name}}" placeholder="{{ucfirst($label)}}"
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

<script type="text/javascript">
InitEditor();
</script>