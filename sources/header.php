<div class="header_top">
    <div class="pagewrap">
        <ul class="left_id_top">
            <li><i class="fa fa-map-marker"></i><?= $thongtin['diachi_' . $lang] ?></li>
            <div class="clr"></div>
        </ul>
        <ul class="right_id_top">
            <li><i class="fa fa-volume-control-phone"></i><?= $glo_lang['hotline'] ?>: <?php
                $hotline_vi = explode("|", $thongtin['hotline_vi']);
                $i = 0;
                foreach ($hotline_vi as $val) {
                    $i++;
                    if ($i > 1) echo ' - ';
                    echo '<a href="tel:' . $val . '">' . $val . '</a>';
                }
                ?></li>
            <li><i class="fa fa-envelope"></i> <?php
                $email_vi = explode("|", $thongtin['email_vi']);
                $i = 0;
                foreach ($email_vi as $val) {
                    $i++;
                    if ($i > 1) echo ' - ';
                    echo '<a href="mailto:' . $val . '">' . $val . '</a>';
                }
                ?></li>
            <div class="clr"></div>
        </ul>
        <div class="clr"></div>
    </div>
</div>
<div class="box_menu">
    <div class="logo_top"><a href="<?= $full_url ?>"><img src="<?= full_src($thongtin, '') ?>"
                                                          alt="<?= $thongtin['tenbaiviet_' . $lang] ?>"></a></div>
    <?php include _source . "menu_top.php"; ?>
    <div class="clr"></div>
    <div class="right_header">
        <ul>
            <li class="cart"><a href="<?=$full_url.'/gio-hang'?>">
                    <i class="fa fa-shopping-cart"
                       aria-hidden="true"></i><span><?= $numberCart ?></span></a></li>
            <li>
                <a class="cur"
                   onclick="if(!$('.timkiem_top').hasClass('acti')) $('.timkiem_top').addClass('acti'); else $('.timkiem_top').removeClass('acti')"><i
                            class="fa fa-search"></i><span><?= $glo_lang['tim_kiem'] ?></span></a>
                <div class="timkiem_top no_box">
                    <div class="search">
                        <a onClick="SEARCH_timkiem('<?= $full_url ?>/search/?key=','.input_search_enter'); if($('.input_search_enter').val() == '') $('.timkiem_top').removeClass('acti') "
                           style="cursor:pointer"> <i class="fa fa-search"></i></a>
                        <input class="input_search input_search_enter" type="text" value="" data=".input_search_enter"
                               data-href="<?= $full_url ?>/search/?key="
                               placeholder="<?= $glo_lang['nhap_tu_khoa_tim_kiem'] ?>"/>
                    </div>
                </div>
            </li>
            <?php include _source . "lang.php"; ?>
            <div class="clr"></div>
        </ul>
    </div>
</div>
