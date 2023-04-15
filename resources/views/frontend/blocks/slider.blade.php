<section id="hero" class="hero hero--no-content hero--gallery p-0 revealable revealed">
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner" style="height: 100vh;">
      @if($slider!=null && $slider->images()->exists() && $slider->images!=null )
      @foreach($slider->images as $key=> $img)
      <div class="carousel-item @if($key==0) active @endif">
        <img src="{{asset('images/slider/'.$img->image)}}" class="d-block w-100" alt="...">
      </div>
      @endforeach
      @endif
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="arrow-btn arrow-btn--left slick-arrow" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="arrow-btn arrow-btn--right slick-arrow" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
  </div>

</section>
