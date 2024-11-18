<div class="bannerMain">
  <div id="downButton"></div>
  </a>
  <div class="banner">
    <?php
      $banner_top = LAY_banner_new("`id_parent` = 16");
      foreach ($banner_top as $rows) {
        $oclick = "";
        if($rows['seo_name'] != "") {
          $oclick = " onclick='window.location.href=\".".GET_link($full_url, $rows['seo_name']).".\"'";
        }
    ?>
    <!-- <li style='background-image:url(<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>);' <?=$oclick ?>> -->
        <!-- <?php if($rows['seo_name'] != "") { ?><a <?=full_href($rows) ?>><?php } ?>
          <img src="<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>" alt="<?=$rows['tenbaiviet_'.$lang] ?>">
        <?php if($rows['seo_name'] != "") { ?></a><?php } ?> -->
    <li style='background-image:url(<?=$fullpath."/".$rows['duongdantin']."/".$rows['icon'] ?>);' <?=$oclick ?>>
      <div class="pagewrap">
        <div class="box_title_banner">
          <ul>
            <h2><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h2>
            <p><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></p>
            
            <div class="clr"></div>
          </ul>
        </div>
      </div>
    </li>
    <?php } ?>
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
        auto : {pauseDuration : 20009999,pauseOnHover  : true,duration: 12009999,fx     : "crossfade",},
        scroll  : {
          fx : "slide",items  : 1,
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
