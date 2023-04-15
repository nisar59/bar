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
                    <li>
                      <a class="site-nav-link" href="{{url('events')}}">Events</a>
                    </li>
                    <li>
                      <a class="site-nav-link" href="book-our-venue">Book our venue</a>
                    </li>
                    <li>
                      <a class="site-nav-link" href="{{url('contact-us')}}">Contact</a>
                    </li>
                    <li>
                      <a class="site-nav-link" href="{{url('faqs')}}">FAQs</a>
                    </li>
                    <li>
                      <a class="site-nav-link" href="#">Nottingham Secret Garden</a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </footer>