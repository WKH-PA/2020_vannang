<?php
  $kietxuat_name = DB_fet_rd("*", "#_danhmuc", "`step` = '".$slug_step."' AND `id` = '".$arr_running['id_parent']."'", "`id` DESC", 1, "id");
  if(empty($kietxuat_name)) {
    $kietxuat_name = $thongtin_step['tenbaiviet_'.$lang];
  }
  else {
    $kietxuat_name = $kietxuat_name[$arr_running['id_parent']]['tenbaiviet_'.$lang];
  }

  $lay_all_kx   = LAYDANHSACH_idkietxuat($arr_running['id_parent'], $slug_step);

  $wh           = "  AND `id_parent` = (".$lay_all_kx.") AND `id` <>  '".$arr_running['id']."'";
  $numview      = 18;

  $nd_kietxuat  = DB_fet_rd(" * "," `#_baiviet` "," `step` IN (".$slug_step.") $wh "," `catasort` DESC ", $numview);

  // $nd_total = DB_que("SELECT `id` FROM `#_baiviet` WHERE `showhi` =  1 AND `step` IN (".$slug_step.") $wh");
  // $nd_total = mysqli_num_rows($nd_total);
  // $retuen_arr = array();
  // while ($r   = mysqli_fetch_assoc($nd_kietxuat)) {
  //   $retuen_arr[] = $r; 
  // }
  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);
  // $img_bg = checkImage($fullpath, $thongtin_step['icon'], $thongtin_step['duongdantin']);
 
  // if($arr_running['icon_hover'] != "") {
  //   $img_bg = checkImage($fullpath, $arr_running['icon_hover'], $arr_running['duongdantin']);
  // }
  // full_src($thongtin_step, '')

?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="bg_link_page">
  <div class="pagewrap">
    <ul>
      <h3><?=$kietxuat_name ?></h3>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id_parent'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?></li>
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="title_news">
    <h2><?=SHOW_text($arr_running['tenbaiviet_'.$lang]) ?></h2>
        <li><?=CONVER_thu(date("l", $arr_running['ngaydang']), $glo_lang) ?>, <?=$glo_lang['date'] ?> <?=date("d/m/Y", $arr_running['ngaydang']) ?></li>
  </div>
  <div class="showText">
    <?=SHOW_text($arr_running['noidung_'.$lang]); ?><div class="clr"></div>
  </div>
  <div id="sharelink">
          <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
        </div>
        <div class="dv-fb_coment">
          <?php include _source."fb_coment.php"; ?>
        </div>
</div>
<div class="box_home_tt_2">
  <div class="pagewrap">
    <div class="titile_page">
      <h3><?=$glo_lang['bai_viet_lien_quan'] ?></h3>
      <div class="clr"></div>
    </div>

    <div class="tintuc_home_id pro_id_home_slider no_box pro_id_home_slider_ct">
      <!--  -->
      <?php $data = array("1","1","2","2","3","3") ?>
        <div class="owl-auto-sp owl-carousel owl-theme flex" data0="<?=$data[0] ?>" data1="<?=$data[1] ?>" data2="<?=$data[2] ?>" data3="<?=$data[3] ?>" data4="<?=$data[4] ?>" data5="<?=$data[5] ?>" is_slidespeed="1000" is_navigation="1" is_dots="1" is_autoplay="0">
      <?php 
        foreach ($nd_kietxuat as $rows) {
      ?>
        <div class="item">
          <ul>
            <li><a <?=full_href($rows) ?>><?=full_img($rows) ?></a></li>
            <h4><i class="fa fa-calendar"></i><?=CONVER_thu(date("l", $rows['ngaydang']), $glo_lang) ?>, <?=$glo_lang['date'] ?> <?=date("d/m/Y", $rows['ngaydang']) ?></h4>
            <h3><a <?=full_href($rows) ?>><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></a></h3>
            <p><span class="lm_3"><?=SHOW_text(strip_tags($rows['mota_'.$lang])) ?></span></p>
          </ul>
        </div>
       <?php } ?>
      </div>
      <div class="clr"></div>
      <!--  -->
    </div>
  </div>
</div>
