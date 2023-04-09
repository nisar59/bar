<!-- //////////////////////////////////////Image banner///////////////////////////////////////////////// -->
@if($banner->type=="image")
<section id="hero" aria-label="hero-section" class="hero hero--gallery hero--fullheight revealable">
	<div class="hero__content container">
		<img src="assetss/images/Dante__White.png" class="fr-fic fr-dib" data-alt_text="text" alt="text" style="width: 255px;">
		<p style="text-align: center;">
			<a href="https://dante-101040.square.site/" rel="noopener noreferrer" target="_blank"></a>
		</p>
	</div>
	<div class="gallery gallery--fit gallery--dimmed">
		<div class="gallery__item gallery__item-enhancement">
			<picture>
				<source media="(max-width: 559px)" sizes="100vw" srcset="assetss/images/37253OLD_FASHIONED_WHISKEY_COCKTAIL.jpg">
				<source media="(min-width: 560px) and (max-width: 767px)" sizes="100vw" srcset="assets/images/37253OLD_FASHIONED_WHISKEY_COCKTAIL.jpg">
				<source media="(min-width: 767px) and (max-width: 1024px)" sizes="100vw" srcset="assets/images/37253OLD_FASHIONED_WHISKEY_COCKTAIL.jpg">
				<source media="(min-width: 1024px)" sizes="100vw" srcset="assetss/images/37253OLD_FASHIONED_WHISKEY_COCKTAIL.jpg">
				<img src="assets/images/37253OLD_FASHIONED_WHISKEY_COCKTAIL.jpg" class="" loading="eager" alt="Dante's Old Fashioned over the menu" style="object-position:none;">
			</picture>
		</div>
		<div class="gallery__item gallery__item-fallback" data-src="assetss/images/37253OLD_FASHIONED_WHISKEY_COCKTAIL.jpg">
			<img class="sr-only" alt="Dante's Old Fashioned over the menu">
		</div>
	</div>
</section>
@elseif($banner->type=="video")
<!-- /////////////////////////////////////////////////Video Banner/////////////////////////////////////////// -->
<section id="hero" aria-label="hero-section" class="hero hero--no-content revealable revealed" style="height: 0px;">
	<div class="hero__video" data-video-type="vimeo" data-video-title="" data-video-id="372723713" data-video-autoplay="1">
		<div class="hero__video-inner" style="width: 1349px; height: 758.812px; top: -379.406px; left: 0px;"><iframe id="videoId" src="https://player.vimeo.com/video/372723713?title=0&amp;byline=0&amp;portrait=0&amp;color=3a6774&amp;autoplay=1&amp;loop=1&amp;background=1" width="100%" height="100%" title="Vimeo Video" frameborder="0" data-ready="true" ></iframe></div>
	</div>
	<div id="motion-elements-control-section">
		<button class="btn fa fa-play play-motion ada-motion-toggle-btns hide-motion" data-action="play">
		<span class="sr-only">hero video paused, press to play video</span>
		</button>
		<button class="btn fa fa-pause pause-motion ada-motion-toggle-btns" data-action="pause">
		<span class="sr-only">Playing hero video, press to pause video</span>
		</button>
	</div>
</section>
@else

@endif