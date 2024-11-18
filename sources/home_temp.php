<?php
$price = !empty($rows['giatien']) ? $rows['giatien'] : 0;
$pricePromo = !empty($rows['giakm']) ? $rows['giakm'] : 0;
?>

<ul class="product-item">
    <a <?= full_href($rows) ?>>
        <li>
            <?= !empty($view) && $view == "slider" ? '<img src="' . full_src($rows) . '" alt="' . SHOW_text($rows['tenbaiviet_' . $lang]) . ' title="' . SHOW_text($rows['tenbaiviet_' . $lang]) . '">' : full_img($rows) ?>
        </li>
        <h3><?= SHOW_text($rows['tenbaiviet_' . $lang]) ?></h3>
        <div class="price">
            <div
            <?php if (empty($price)) {
                echo "<div>" . $glo_lang['lien_he'] . "</div>";
            } else { ?>
                <div><?= NUMBER_fomat_d($price) ?></div>
                <?php if (!empty($pricePromo)) { ?>
                    <div class="promo"><?= NUMBER_fomat_d($pricePromo) ?></div>
                <?php }
            } ?>
        </div>
    </a>
</ul>
