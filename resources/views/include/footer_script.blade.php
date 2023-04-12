<script type="text/javascript" src="{{url('assetss/js/jquery-3.6.4.min.js')}}"></script>
<script type="text/javascript" src="{{url('assetss/js/bootstrap.js')}}"></script>
<script type="text/javascript" src="https://unpkg.com/vimeo-froogaloop2@0.1.0/javascript/froogaloop.min.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    
      $(document).on('click', '.nav-toggle-btn', function () {
        $(this).toggleClass('nav-toggle-btn--active');
        $('#SiteHeaderMobilePanel').toggleClass('site-header-mobi-panel--show site-header-mobi-panel--open');
      })
      $(document).on('click', '.ada-motion-toggle-btns', function () {
        $('.ada-motion-toggle-btns').toggleClass('hide-motion');
      });
      
      $(document).on('click', '.pause-motion', function () {
        var iframe = document.getElementById('videoId');
        var player = $f(iframe);
        player.api("pause");
      });

      $(document).on('click', '.play-motion', function () {
        var iframe = document.getElementById('videoId');
        var player = $f(iframe);
        player.api("play");
      });

      
      $(window).scroll(function(){
        if( $(window).scrollTop() > 30 ) {
        $(".site-header").addClass("site-header-mobi--collapse");
        $(".site-header-desktop-primary").addClass("site-header-desktop-primary--collapsed");
        } else {
        $(".site-header").removeClass("site-header-mobi--collapse");
        $(".site-header-desktop-primary").removeClass("site-header-desktop-primary--collapsed");
        }

      });

      function VideoSize() {
       var w = $(window).width();
       var h=(w*56)/100;
       var t=h/2;
      $('.hero__video-inner').css({'width':w, 'height':h, 'top':'-'+t});
    }
        VideoSize();
    $(window).resize(function() {
        VideoSize();
    });

    
  });
</script>