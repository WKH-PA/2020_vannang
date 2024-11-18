<?php
  if((!empty($thongtin_step) && $thongtin_step['num_view'] == 0) || empty($thongtin_step))
      $numview          = 12;
  else $numview         = $thongtin_step['num_view'];

  $key       = isset($_GET['key']) ? $_GET['key'] : '';
  $tn        = isset($_GET['tn']) ? $_GET['tn'] : '';


  $lay_all_kx = "";
  $name_titile      = !empty($arr_running['tenbaiviet_'.$lang]) ? SHOW_text($arr_running['tenbaiviet_'.$lang]) : "";
  if($slug_table != 'step'){
      $lay_all_kx = LAYDANHSACH_idkietxuat($arr_running['id'], $slug_step);
  }
  $wh = "";
  if($lay_all_kx != "") {
    $wh = "  AND `id_parent` in (".$lay_all_kx.") ";
  }


  // //check tieu thuyet
  if($slug_step == 1) {
    $wh .= " AND `id_baiviet` = 0";
  }
  //
  if($key != ""){
    $key_er = explode("/",$key);
    $time_bg = mktime(0,0,0, $key_er[1],$key_er[0],$key_er[2]);
    $time_en = mktime(23,59,59, $key_er[1],$key_er[0],$key_er[2]);
    $wh .= " AND `capnhat` > $time_bg AND `capnhat` < $time_en ";
  }
  if($tn != "") {
    $tn_z = str_replace("-", ",", $tn);
    $tn_c = explode(",", $tn_z);
    $tn_c = count($tn_c);
    $wh .= " AND `id` IN (SELECT `id_baiviet`  
          FROM `#_baiviet_select_tinhnang` 
          WHERE `id_val` IN ($tn_z) 
          GROUP BY `id_baiviet`
          HAVING COUNT(*) = $tn_c) ";
    // $wh .= " AND `id` IN (SELECT `id_baiviet`  
    //       FROM `#_baiviet_select_tinhnang` 
    //       WHERE `id_val` = '$tn_z' ) ";
  }
  $catasort = "`opt` DESC";
  include _source."phantrang_kietxuat.php";
  // include _source."phantrang_danhmuc.php";

  // $anhcon   = LAY_anhstep($thongtin_step['id'], 1);


  $link_p =  GET_bre($arr_running['id'], $slug_step, $full_url, $lang, $thongtin_step, $slug_table, '/');


  // full_src($thongtin_step, '')
  $tinhnang_arr      = LAY_bv_tinhnang($slug_step);

?>
<div class="box_page_id">
  <div class="title_page">
    <h3><?=$name_titile ?></h3>
    <div class="clr"></div>
  </div>
  <div class="click_loc click_loc_mnl">
    <ul>
      <li>
        <div class="col-md-2 row-frm">
          <input type="text" name="cont_cmnd" class="form-control datepicker js_key" placeholder="<?=$glo_lang['chon_ngay_can_tim'] ?>">
        </div>
      </li>
      <?php
        $tn_arr = explode("-", $tn);
         foreach ($tinhnang_arr as $rows) {
          if($rows['id_parent'] != 0) continue;
      ?>
      <li>
        <div class="col-md-2 row-frm">
          <select name="city" id="city" class="js_tinhnang form-control">
            <option value="0"><?=$rows['tenbaiviet_'.$lang] ?></option>
            <?php
              foreach ($tinhnang_arr as $rows_2) {
                if($rows_2['id_parent'] != $rows['id']) continue;
            ?>
            <option value="<?=$rows_2['id'] ?>" <?=in_array($rows_2['id'] , $tn_arr) ? 'selected="selected"' : "" ?>><?=$rows_2['tenbaiviet_'.$lang] ?></option>
            <?php } ?>
          </select>
        </div>
      </li>
      <?php } ?>

      <h3><a class="cur" onclick="js_timkiem('<?=$full_url."/".$thongtin_step['seo_name']."/" ?>')"><?=$glo_lang['tim_kiem'] ?></a></h3>
      <h3><a class="cur" onclick="printDiv()"><?=$glo_lang['in_trang_nay'] ?></a></h3>
      <div class="clr"></div>
    </ul>
  </div>
  <?php $i = 0; foreach ($nd_kietxuat as $rows) { $i++; if($i > 1) continue; ?>
  <div id="dv-js-print">
  <div class="title_tl">
    <ul>
      <h2><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h2>
      <h3>
        <?=SHOW_text($rows['mota_'.$lang]) ?>
      </h3>
      <p><?=$glo_lang['ms'] ?>:<?=SHOW_text($rows['p1']) ?></p>
    </ul>
  </div>
  <div class="showText">
    <?=SHOW_text($rows['noidung_'.$lang]) ?>
  </div>
  </div>
  <?php } ?>
  <div class="clr"></div>
</div>
<script src="myadmin/js/jquery-ui.js?v=2"></script>
<link rel="stylesheet" href="myadmin/css/jquery-ui.css?v=2">
<script type="text/javascript">
  $('.datepicker').attr('autocomplete','off');
  $(".datepicker").each(function(){
      $(this).datepicker({
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        format: 'dd/mm/yyyy'
      });
    });
  function js_timkiem(url) {
    var key = $(".js_key").val();
    var tn =  "";
    $( ".js_tinhnang" ).each(function( index ) {
      if($( this ).val() != 0) {
        if(tn == "") tn += $( this ).val();
        else tn += "-"+$( this ).val();
      }
    });
    window.location.href = url + "?key="+key+"&tn=" + tn;
  }
  function printDiv() {

  var divToPrint=document.getElementById('dv-js-print');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>