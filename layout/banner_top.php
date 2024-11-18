<div class="bannerMain">
  <div id="downButton"></div>
  </a>
  <div class="banner">
    <li style='background-image:url(delete/banner_1.jpg);'>
      <div class="pagewrap">
        <div class="box_title_banner">
          <ul>
            <h2>title banner silde home 1</h2>
            <p>Our standard model with long needle support makes it easy to work with thick products requiring greater insertion strength.</p>
            
            <div class="clr"></div>
          </ul>
        </div>
      </div>
    </li><li style='background-image:url(delete/banner_2.jpg);'>
      <div class="pagewrap">
        <div class="box_title_banner">
          <ul>
            <h2>title banner silde home 2</h2>
            <p>Our Bano'k fine type model with a long needle. This model is perfect for tagging thick products that require finer work.</p>
            
            <div class="clr"></div>
          </ul>
        </div>
      </div>
    </li><li style='background-image:url(delete/banner_3.jpg);'>
      <div class="pagewrap">
        <div class="box_title_banner">
          <ul>
            <h2>title banner silde home 3</h2>
            <p>VP TOOL PRO F with its exquisite design, eye-catching colors and modern. It is suitable for thin products, so as to avoid leaving holes.</p>
            
            <div class="clr"></div>
          </ul>
        </div>
      </div>
    </li>
    <li style='background-image:url(delete/banner_4.jpg);'>
      <div class="pagewrap">
        <div class="box_title_banner">
          <ul>
            <h2>title banner silde home 3</h2>
            <p>VP TOOL PRO F with its exquisite design, eye-catching colors and modern. It is suitable for thin products, so as to avoid leaving holes.</p>
            
            <div class="clr"></div>
          </ul>
        </div>
      </div>
    </li>
  </div>
  <ul class="pagiBanner">
  </ul>
  <script type="text/javascript">
        jQuery(document).ready(function(){
			$(".banner").carouFredSel({
				circular: true,
				infinite: true,
				responsive: true,
				pagination: '.pagiBanner',
				auto : {pauseDuration : 2000,pauseOnHover  : true,duration: 1200,fx 		: "crossfade",},
				scroll	: {
					fx : "slide",items	: 1,
					onBefore: function( data ) {
						$('.banner li').not(data.items.visible[0]).find('.caption').animate({opacity: 0,visibility: 'hidden',bottom: -50});
						$(data.items.visible[0]).find('.caption').animate({opacity: 1,visibility: 'visible',bottom: 0},{queue:false,duration:1000});
					},
				},
				prev  : ".placeNav.prev1",
        next  : ".placeNav.next1",
				swipe: {onMouse: true,onTouch: true},
				items: {height: "variable",visible: {min: 1,max: 1}}
			});
        });
    </script>
  <div class="clr"></div>
</div>
