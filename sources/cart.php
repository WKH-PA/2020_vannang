<?php

if (!isset($_SESSION['cart']) && empty($_POST['result'])) {
    LOCATION_js($full_url . "/");
}
if (isset($_POST['xoa_sp'])) {
    if (isset($_SESSION['cart'][$_POST['id_die']])) unset($_SESSION['cart'][$_POST['id_die']]);
    if (count($_SESSION['cart']) == 0) unset($_SESSION['cart']);
    if (empty($_SESSION['cart'])) {
        LOCATION_js($full_url . "/");
    }
}

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $_SESSION['cart'][$_GET['id']] = 1;
    LOCATION_js($full_url . "/gio-hang/");
}

if (isset($_POST['id'])) {
    $id = isset($_POST['id']) && $_POST['id'] > 0 ? $_POST['id'] : 0;
    if ($id == 0) {
        LOCATION_js($full_url . "/gio-hang/");
        exit();
    }
    $tinhnang = "";
    for ($i = 1; $i <= 100; $i++) {
        if (isset($_POST['tinhnang_' . $i])) {
            $tinhnang .= $tinhnang == "" ? trim($_POST['tinhnang_' . $i]) : ',' . trim($_POST['tinhnang_' . $i]);
        }

    }
    $_SESSION['tinhnang'][$id . "_" . md5($tinhnang)] = $tinhnang;

    if (isset($_POST['qty_cart']) && is_numeric($_POST['qty_cart']) && $_POST['qty_cart'] > 0) {
        if (!empty($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] += $_POST['qty_cart'];
        } else {
            $_SESSION['cart'][$id] = $_POST['qty_cart'];
        }

    } else {
        $_SESSION['cart'][$id . "_" . md5($tinhnang)] = 1;
    }
    if (!empty($_POST['result'])) {
        $dataResult = ['total' => getTotalItem()];
        echo json_encode($dataResult, 256);
        exit;
    }

    LOCATION_js($full_url . "/gio-hang/");
}

// print_r($_SESSION['cart']);
// unset($_SESSION['cart']);

$thongtin_step = LAY_anhstep_now(LAY_id_step(1));
?>
<div class="bg_link_page">
    <div class="pagewrap">
        <ul>
            <h3><?= $glo_lang['gio_hang'] ?></h3>
            <li>
                <a href="<?= $full_url ?>"><i class="fa fa-home"></i><?= $glo_lang['trang_chu'] ?></a>
                <span>/</span>
                <a href="<?= $full_url . '/gio-hang' ?>"><?= $glo_lang['gio_hang'] ?></a>
            </li>
        </ul>
    </div>
</div>
<div class="pagewrap page_conten_page">
    <div class="block-total-left">
        <p class="heading-counter">
            <?= $glo_lang['gio_hang_cua_ban'] ?> <b
                    class="count_cart">(<?= str_replace("__NUMBER__", getTotalItem(), $glo_lang['ban_dang_co']) ?>)</b>
        </p>
        <div class="table-container">
            <table class="cart_summary" width="100%" border="0" cellspacing="1" cellpadding="5">
                <tbody>
                <tr>
                    <th class="c-th-sp"><?= $glo_lang['cart_ten_sp'] ?></th>
                    <th style="width: 100px;" class="c-th-gia"><?= $glo_lang['cart_dongia'] ?></th>
                    <th style="width: 145px;" class="c-th-sluong"><?= $glo_lang['cart_qty'] ?></th>
                    <th style="width: 100px;" class="c-th-ttien"><?= $glo_lang['cart_thanhtien'] ?></th>
                </tr>
                <?php
                $tongtien = 0;
                $stt = 0;
                $tinhnang_arr = LAY_bv_tinhnang(2);
                foreach ($_SESSION['cart'] as $key => $value) {
                    $id_sp = explode("_", $key);
                    $id_sp = $id_sp[0];
                    $stt++;
                    $sanpham = DB_que("SELECT * FROM `#_baiviet` WHERE `showhi` = 1 AND `id` = '" . $id_sp . "' LIMIT 1");
                    if (mysqli_num_rows($sanpham) > 0) {
                        $sanpham = mysqli_fetch_assoc($sanpham);
                        $dongia = check_gia_sql($id_sp, @$_SESSION['tinhnang'][$key], $sanpham['giatien']);

                        $thanhtien = $dongia * $value;
                        $tongtien += $thanhtien;

                        // lay hinh
                        $anhsp = checkImage($fullpath, $sanpham['icon'], $sanpham['duongdantin'], 'thumb_');
                        $check_sl_tinhnang = DB_fet_rd("* ", " `#_baiviet_select_tinhnang` ", "`id_baiviet` = '" . $id_sp . "'", "", "", "id_val");

                        $isthuoctinh = @explode(",", $_SESSION['tinhnang'][$key]);
                        if (is_array($isthuoctinh)) {
                            foreach ($isthuoctinh as $ittinh) {
                                if (@$check_sl_tinhnang[$ittinh]['icon'] == "") continue;
                                $anhsp = checkImage($fullpath, $check_sl_tinhnang[$ittinh]['icon'], $check_sl_tinhnang[$ittinh]['duongdantin']);
                                break;
                            }
                        }
                        //
                        ?>
                        <tr class="tr_cart_iscart_1202">
                            <td class="c-th-sp" title="Sản phẩm">
                                <a href="<?= GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>" class="sp">
                                    <img src="<?= $anhsp ?>"
                                         alt="<?= SHOW_text($sanpham['tenbaiviet_' . $_SESSION['lang']]) ?>"/>
                                </a>
                                <div class="dv-anh">
                                    <a href="<?= GET_link($full_url, SHOW_text($sanpham['seo_name'])) ?>"><?= SHOW_text($sanpham['tenbaiviet_' . $_SESSION['lang']]) ?></a>
                                    <form action="" method="post">
                                        <input type="hidden" name="id_die" value="<?= $key ?>">
                                        <button class="del cur" type="submit" name="xoa_sp"
                                                onclick="return confirm('<?= $glo_lang['ban_that_su_muon_xoa'] ?>')"
                                                title="Xóa"><i class="fa fa-trash"
                                                               aria-hidden="true"></i> <?= $glo_lang['cart_xoa'] ?>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="c-th-gia" title="Giá"><b><?= NUMBER_fomat_d($dongia) ?></b></td>
                            <td class="qty c-th-sluong" style="width: 145px">
                                <div class="so-luong-mua">
                                    <span class="number-down"
                                          onclick="add_num_sp('#product-quantity-<?= $id_sp ?>',-1); updateQty_notthis('<?= $full_url ?>/update-qty/', '<?= $id_sp ?>');">–</span>
                                    <input onchange="updateQty('<?= $full_url ?>/update-qty/','<?= $id_sp ?>', this)"
                                           type="text" class="product-quantity" value="<?= $value ?>"
                                           id="product-quantity-<?= $id_sp ?>">
                                    <span class="number-up"
                                          onclick="add_num_sp('#product-quantity-<?= $id_sp ?>',+1); updateQty_notthis('<?= $full_url ?>/update-qty/', '<?= $id_sp ?>');">+</span>
                                </div>
                            </td>
                            <td class="c-th-ttien" title="Thành tiền"><b
                                        class="td_thanhtien_<?= $id_sp ?>"><?= NUMBER_fomat_d($thanhtien) ?></b>
                            </td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>
        <div class="clr"></div>
    </div>
    <div class="block-total-cart">
        <div class="total-cart-page">
            <div class="title-cart-page-left"><?= $glo_lang['cart_thanhtien'] ?></div>
            <div class="number-cart-page-right"><span class="price"><?= NUMBER_fomat_d($tongtien) ?></span></div>
        </div>
        <div class="total-cart-page title-final-total">
            <div class="title-cart-page-left">
                <?= $glo_lang['cart_thanhtien_vat'] ?>
            </div>
            <div class="number-cart-page-right"><span class="price"><?= NUMBER_fomat_d($tongtien) ?></span></div>
        </div>
        <div class="checkout-type-button-cart" style="text-align: center;">
            <div class="method-button-cart">
                <div class="sc_item_button sc_button_wrap sc_align_left">
                    <a href="<?= $full_url . '/dat-hang' ?>" id="sc_button"
                       class="sc_button"><?= $glo_lang['thanh_toan'] ?>
                    </a><!-- /.sc_button -->
                </div>
            </div>
        </div>
    </div>
    <div class="clr"></div>
</div>
