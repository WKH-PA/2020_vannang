<?php 
  if(isset($_SESSION['id'])) {
    $info_acc     = DB_fet("*", "#_members", "`id` = '".$_SESSION['id']."' AND `phanquyen` = 0", "`id` DESC", 1);
    if(mysqli_num_rows($info_acc)) {
      $info_acc     = mysqli_fetch_assoc($info_acc);
      foreach ($info_acc as $key => $value) {
        ${$key} = $value;
      }
    }
  }
  // full_src($thongtin_step, '')
?>
<!-- <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '<i class="fa fa-angle-right"></i>') ?></li> -->
<div class="bg_link_page">
  <div class="pagewrap">
    <ul>
      <h3><?= SHOW_text($thongtin_step['tenbaiviet_'.$lang]) ?></h3>
      <li><i class="fa fa-home"></i><a href="<?=$full_url ?>"><?=$glo_lang['trang_chu'] ?></a><?=GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/') ?></li> 
    </ul>
  </div>
</div>
<div class="pagewrap page_conten_page">
  <div class="company_contact">
    <div class="flex">
    <?php
          $i = 0;
          $baiviet = LAY_baiviet($thongtin_step['id'], 3);
          foreach ($baiviet as $rows) {
            $i++;
            // if($i > 1) continue;
            // full_img($rows, '')
        ?>
        <ul>
          <h3><?=full_img($rows, '') ?><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
          <div class="showText showText_lienhe"><?=$rows['noidung_'.$lang] ?></div>
          </ul>
        <?php } ?>
        </div>
    <div class="clr"></div>
  </div>
  <!-- <h3><?=$glo_lang['form_lien_he'] ?></h3> -->
      <div class="contact">
        <?php include _source."lien_he_form.php"; ?>
      </div>
</div>
<div class="map_contact">
  <?php if($thongtin_step['map_google'] != "" ){ ?>
        <iframe class="iframe_load" iframe-src="<?=$thongtin_step['map_google'] ?>" width="600" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
        <?php } ?>
</div>
