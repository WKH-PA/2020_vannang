<ul class="menu tree_parent no_box" id="menu">
	<!-- <li class="homepage"><a href="<?=$full_url ?>"><i class="fa fa-home"></i></a></li> -->
  	<?=GET_menu_new($full_url, $lang, '', '', '') ?>
</ul>
<div class="mn-mobile" >
	<a href="<?=$full_url ?>" class="a_trangchu_mb"><i class="fa fa-home"></i></a>
	<!-- <a href="<?=$full_url ?>" class="a_trangchu_mb"><?=$glo_lang['trang_chu'] ?></a> -->
	<div class="menu-bar hidden-md hidden-lg">
		<a href="#nav-mobile">
			<!-- <img src="images/menu-mobile-lh.png" alt=""> -->
			<span>&nbsp;</span>
			<span>&nbsp;</span>
			<span>&nbsp;</span>
		</a>
	</div>

	<div id="nav-mobile" style="display: none">
		<ul>
			<?=GET_menu_new($full_url, $lang, '', '', '') ?>
		</ul>
	</div>
</div>
<script>
	$(function(){
		$(".menu  li").each(function(){
			if($("ul", this).length > 0){
				var a_ok = $("a",this).eq(0).attr('addok');
				if(a_ok != "ok"){
					$("a",this).eq(0).append('<i class="fa fa-angle-down"></i>');
					$("a",this).eq(0).attr("addok","ok");
				}
			}
			// 
			// var ulx 	= $("ul", this).html();
			// var link 	= $("a", this).attr("href");
			// var link_id = $("a", this).attr("dataid");
			// $("ul", this).remove();
			// var ax 	= $(this).html();
			// if(ulx != "" && ulx != undefined && ulx != 'undefined') {
			// 	var menu_addgia 	= add_gia_menu(link);
			// 	$(this).append('<ul class="flex_new"><li class="li_mn1">'+ax+'<ul class="flex">'+ulx+'</ul></li>'+menu_addgia+'<li class="li_menu_timkiem li_menu_timkiem_2 li_onload_sp" data="'+link_id+'"></li>'+'</ul>');
			// }
			// 
		});
		// $(".menu li.is_step_2.hide_4 > ul").html('<div class="projects-menu flex no_box">'+$("li.is_step_2.hide_4 > ul").html()+'</div>');
		// $(".li_onload_sp").each(function(){
		// 	var id = $(this).attr("data");var obj = this;AJAX_post(full_url +"/add_sanpham_menu/",{"id": id}, function(r){$(obj).html(r);});
		// });
	});
	// function add_gia_menu(link){
	// 	var addgia = '<li class="li_menu_timkiem"><ul class="fs-mnsul-gia"><p><?php //$glo_lang['muc_gia']?></p><?php 
 //          $tkgia = LAY_tkgia();
 //            foreach ($tkgia as $rows) {
	// 			echo "<li><a href=\"'+link+'/?pri=".$rows['id']."\">".SHOW_text($rows['tenbaiviet_'.$lang])."</a></li>";
 //            }
 //          ?></ul></li>';
	// 	return addgia;
	// }
</script>
