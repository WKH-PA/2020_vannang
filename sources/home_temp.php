<ul>
	<a <?=full_href($rows) ?>>
	<li><?=!empty($view) && $view  == "slider" ? '<img src="'.full_src($rows).'" alt="'.SHOW_text($rows['tenbaiviet_'.$lang]).' title="'.SHOW_text($rows['tenbaiviet_'.$lang]).'">' : full_img($rows) ?></li>
	<h3><?=SHOW_text($rows['tenbaiviet_'.$lang]) ?></h3>
</a>
</ul>
