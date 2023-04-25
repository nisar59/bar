<footer class="fixed-bottom">
          <div class="site-footer-desktop-spacer" aria-hidden="true" style="height: 63.5469px;"></div>
          <div class="site-footer-desktop site-footer-desktop--show">
            <div class="site-footer-desktop-primary" data-footer-sticky="">
              <div class="site-footer-desktop-primary__container container">
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
                <nav class="site-nav" aria-label="Footer">
                  <ul class="site-nav-menu">

                @if(Menu('footer')->count()>0)
                  @foreach(Menu('footer') as $menu)
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
        </footer>