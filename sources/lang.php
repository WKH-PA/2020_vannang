<?php
	if($thongtin['is_lang'] == 1){
	$las_url    = "";
	if($motty  != "") $las_url    .= "/".$motty;
	if($haity  != "") $las_url    .= "/".$haity;
	if($baty   != "") $las_url    .= "/".$baty;
	if($bonty  != "") $las_url    .= "/".$bonty;
	if($namty  != "") $las_url    .= "/".$namty;
	// if($lang == "vi"){
?>
<li style="border-right:none;" class="li_lang"><i class="fa fa-globe" ></i><a href="<?=$fullpath.'/en'.$las_url."/?actilang=true" ?>">ENG</a> | <a href="<?=$fullpath.$las_url."/?actilang=true" ?>">VN</a></li>
<?php } ?>