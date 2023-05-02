<section id="menus" aria-label="menus-section" class="content revealable revealed">
      <div class="tabs container-sm border-0">
        <ul class="nav nav-tabs" role="tablist">
          @if(Caffe()->count()>0)
            @foreach(Caffe() as $key=> $caffe)
          <li class="nav-item" role="presentation">
            <a class="btn btn-tabs  @if($key==0) active @endif" id="menu{{$caffe->id}}-tab" data-bs-toggle="tab" data-bs-target="#menu{{$caffe->id}}" role="tab" aria-controls="menu{{$caffe->id}}" aria-selected="true">{{$caffe->title}}</a>
          </li>
            @endforeach
          @endif
        </ul>



        <div class="tab-content">
            @if(Caffe()->count()>0)
            @foreach(Caffe() as $key=> $caffe)
          <section class="tab-pane fade @if($key==0) show active @endif" id="menu{{$caffe->id}}" role="tabpanel" aria-labelledby="menu{{$caffe->id}}-tab">
            @if($caffe->description!=null)
            <div class="menu-description container-sm">
              <p>{{$caffe->description}}</p>
            </div>
            @endif
            <div class="container-sm p-0">
              <iframe class="w-100" height="500" src="{{asset('caffe-menu/'.$caffe->file)}}#toolbar=0&navpanes=0&scrollbar=0" ></iframe>
            </div>
          </section>
            @endforeach
          @endif
        </div>
      </div>

    </section>