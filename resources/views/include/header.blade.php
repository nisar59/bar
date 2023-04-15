<header class="site-header">
      <a href="#main-content" class="skip">Skip to main content</a>
      <div class="site-header-desktop">
        <div class="site-header-desktop-primary site-header-desktop-primary--floatable" data-header-sticky>
          <div class="container">
            <div class="site-logo">
              <a class="site-logo__btn" href="{{url('/')}}">
                <img class="site-logo__expanded" src="{{url('public/img/settings/'.Settings()->website_logo)}}" alt="Bar" />
                <img class="site-logo__collapsed" src="{{url('public/img/settings/'.Settings()->website_small_logo)}}" alt="Bar" />
              </a>
            </div>
            <nav class="site-nav">
              <ul class="site-nav-menu" data-menu-type="desktop">

                @if(Menu('header')->count()>0)
                  @foreach(Menu('header') as $menu)
                <li>
                  <a class="site-nav-link " href="@if($menu->page_slug!=null) {{url($menu->page_slug)}} @else {{url($menu->url)}} @endif">{{$menu->name}}</a>
                </li>
                  @endforeach
                @endif
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div class="site-header-mobi" aria-label="Navigation Menu Modal">
        <div class="site-logo">
          <a class="site-logo__btn" href="{{url('/')}}">
            <img src="assetss/images/Dante__White.png" alt="Caffe Dante Home" />
            <img src="assetss/images/31247Dante_-sticky.png" alt="dante sticky logo" />
          </a>
        </div>
        <button type="button" class="nav-toggle-btn" aria-controls="SiteHeaderMobilePanel" aria-expanded="false">
          <span class="sr-only">Toggle Navigation</span>
          <span class="nav-toggle-btn__line"></span>
          <span class="nav-toggle-btn__line"></span>
          <span class="nav-toggle-btn__line"></span>
        </button>
        <div id="SiteHeaderMobilePanel" class="site-header-mobi-panel">
          <div class="site-header-mobi-panel__inner">
            <nav class="site-nav" aria-label="Navigation Menu">
              <ul class="site-nav-menu" data-menu-type="mobile">
                @if(Menu('header')->count()>0)
                  @foreach(Menu('header') as $menu)
                <li>
                  <a class="site-nav-link " href="@if($menu->page_slug!=null) {{url($menu->page_slug)}} @else {{url($menu->url)}} @endif">{{$menu->name}}</a>
                </li>
                  @endforeach
                @endif
              </ul>
            </nav>

            <div class="site-social site-social--bordered">
              <ul class="social-accounts">

                  @if(SocailMedia()->count()>0)
                    @foreach(SocailMedia() as $sm)
                        <li>

                          <a href="{{$sm->link}}" target="_blank" >
                            <span class="{{$sm->icon}}" aria-hidden="true"></span>
                          </a>
                        </li>
                    @endforeach
                  @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>