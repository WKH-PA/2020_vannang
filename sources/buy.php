<?php
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    // ALERT_js($glo_lang['hien_chua_co_san_pham_nao_trong_gio_hang']);
    LOCATION_js($full_url);
}

$thongtin_step = DB_que("SELECT * FROM `#_step` WHERE `showhi` = 1 AND `id` = 3 LIMIT 1");
$thongtin_step = mysqli_fetch_assoc($thongtin_step);

$link_cart = GET_link($full_url, SHOW_text(laySeoName('seo_name', '#_step', '`showhi` = 1 AND `step` = 2')));
if (isset($_SESSION['id'])) {
    $info_acc = DB_fet("*", "#_members", "`id` = '" . $_SESSION['id'] . "' AND `phanquyen` = 0", "`id` DESC");
    $info_acc = mysqli_fetch_assoc($info_acc);
    $hoten = $info_acc['hoten'];
    $sodienthoai = $info_acc['sodienthoai'];
    $email = $info_acc['email'];
    $diachi = $info_acc['diachi'];
} else {
    $hoten = '';
    $sodienthoai = '';
    $email = '';
    $diachi = '';
}
$thongtin_step = LAY_anhstep_now(LAY_id_step(1));
?>
<div class="bg_link_page">
    <div class="pagewrap">
        <ul>
            <h3><?= $glo_lang['dat_hang'] ?></h3>
            <li>
                <a href="<?= $full_url ?>"><i class="fa fa-home"></i><?= $glo_lang['trang_chu'] ?></a>
                <span>/</span>
                <a href="<?= $full_url . '/dat-hang' ?>"><?= $glo_lang['dat_hang'] ?></a>
            </li>
        </ul>
    </div>
</div>
<div id="placeSlide_main" class="page_conten_page">
    <div class="pagewrap">
        <form action="" class="formBox" method="post" name="FormNameContact_cart" id="FormNameContact_cart">
            <div id="chitiet_news">
                <h2><?= $glo_lang['chi_tiet_don_hang'] ?></h2>
                <div class="contact contact_lh contact_lh_cart no_box" id="contact">
                    <input type="hidden" name="gui_donhang">
                    <input type="hidden" class="lang_ok"
                           value="<?= $glo_lang['don_hang_cua_ban_da_duoc_gui'] ?>">
                    <input type="hidden" class="lang_false"
                           value="<?= $glo_lang['nhap_ma_bao_ve_chua_dung'] ?>">
                    <input type="hidden" name="id_token" id="id_token" class="id_token"
                           value="<?= $_SESSION['token'] = md5(RANDOM_chuoi(5)) ?>">
                    <li>
                        <input type="hidden" name="s_fullname_s"
                               value="<?= base64_encode($glo_lang['ho_va_ten']) ?>">
                        <input class="cls_data_check_form" data-rong="1" name="s_fullname"
                               id="s_fullname" type="text"
                               placeholder="<?= $glo_lang['ho_va_ten'] ?> (*)"
                               value="<?= !empty($_POST['s_fullname']) ? $_POST['s_fullname'] : @$hoten ?>"
                               onFocus="if (this.value == '<?= $glo_lang['ho_va_ten'] ?> (*)'){this.value='';}"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['ho_va_ten'] ?> (*)';}"
                               data-name="<?= $glo_lang['ho_va_ten'] ?> (*)"
                               data-msso="<?= $glo_lang['nhap_ho_ten'] ?>"/>
                    </li>
                    <li>
                        <input type="hidden" name="s_dienthoai_s"
                               value="<?= base64_encode($glo_lang['so_dien_thoai']) ?>">
                        <input class="cls_data_check_form" data-rong="1" data-phone="1"
                               name="s_dienthoai" id="s_dienthoai" type="text"
                               placeholder="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                               value="<?= !empty($_POST['s_dienthoai']) ? $_POST['s_dienthoai'] : @$sodienthoai ?>"
                               onFocus="if (this.value == '<?= $glo_lang['so_dien_thoai'] ?> (*)'){this.value='';}"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['so_dien_thoai'] ?> (*)';}"
                               data-name="<?= $glo_lang['so_dien_thoai'] ?> (*)"
                               data-msso="<?= $glo_lang['nhap_so_dien_thoai'] ?>"
                               data-msso1="<?= $glo_lang['so_dien_thoai_khong_hop_le'] ?>"/>
                    </li>
                    <li>
                        <input type="hidden" name="s_email_s"
                               value="<?= base64_encode($glo_lang['email']) ?>">
                        <input class="cls_data_check_form" data-rong="1" data-email="1" name="s_email" id="s_email" type="text"
                               placeholder="<?= $glo_lang['email'] ?> (*)"
                               value="<?= !empty($_POST['s_email']) ? $_POST['s_email'] : @$email ?>"
                               onFocus="if (this.value == '<?= $glo_lang['email'] ?> (*)'){this.value='';}"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['email'] ?> (*)';}"
                               data-msso="<?= $glo_lang['chua_nhap_dia_chi_email'] ?>"
                               data-msso1="<?= $glo_lang['dia_chi_email_khong_hop_le'] ?>"/>
                    </li>

                    <li>
                        <input type="hidden" name="s_address_s"
                               value="<?= base64_encode($glo_lang['dia_chi']) ?>">
                        <input name="s_address" id="s_address" type="text"
                               class="cls_data_check_form" data-rong="1"
                               placeholder="<?= $glo_lang['dia_chi'] ?> (*)"
                               value="<?= !empty($_POST['s_address']) ? $_POST['s_address'] : @$diachi ?>"
                               onFocus="if (this.value == '<?= $glo_lang['dia_chi'] ?>'){this.value='';}"
                               data-name="<?= $glo_lang['dia_chi'] ?> (*)"
                               data-msso="<?= $glo_lang['nhap_dia_chi'] ?>"
                               onBlur="if (this.value == '') {this.value='<?= $glo_lang['dia_chi'] ?>';}"/>
                    </li>
                    <li>
                        <select data-rong="1" data-msso="<?= $glo_lang['chon_tinh_tp'] ?>" name="city" id="city" class="cityowner cls_data_check_form" >
                            <option value=""><?= $glo_lang['chon_tinh_thanh'] ?> (*)</option>
                            <?php
                            $dataProvince = getProvince();
                            foreach ($dataProvince as $item) {
                                ?>
                                <option data-id="<?= $item['Id'] ?>" value="<?= $item['Name'] ?>"><?= $item['Name'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </li>
                    <li>
                        <select data-rong="1" data-msso="<?= $glo_lang['chon_quanhuyen'] ?>" name="district" id="district" class="cityowner cls_data_check_form">
                            <option value=""><?= $glo_lang['chon_quan_huyen'] ?> (*)</option>
                        </select>
                    </li>
                    <li>
                        <select data-rong="1" data-msso="<?= $glo_lang['chon_phuongxa'] ?>" name="ward" id="ward" class="cityowner cls_data_check_form">
                            <option value=""><?= $glo_lang['chon_phuong_xa'] ?> (*)</option>
                        </select>
                    </li>
                    <li>
                        <input type="hidden" name="s_message_s"
                               value="<?= base64_encode($glo_lang['noi_dung_lien_he']) ?>">
                        <textarea class="field__input" name="s_message" id="s_message" cols="" rows=""
                                  placeholder="<?= $glo_lang['noi_dung_lien_he'] ?>"><?= !empty($_POST['s_message']) ? $_POST['s_message'] : '' ?></textarea>
                        <div class="clr"></div>
                    </li>
                    <div class="clr"></div>
                    <div>
                        <p class="require_pc"
                           style="color:red;"><?= $glo_lang['thong_tin_bat_buoc'] ?></p>
                        <div class="clr"></div>
                    </div>
                </div>
            </div>
            <aside class="sidebar">
                <div class="sidebar__header">
                    <h2 class="sidebar__title">
                        <?= $glo_lang['don_dat_hang_cua_ban'] ?>
                        (<?= str_replace("__NUMBER__", getTotalItem(), $glo_lang['so_san_pham']) ?>)
                    </h2>
                </div>
                <div class="sidebar__content">
                    <div id="order-summary" class="order-summary order-summary--is-collapsed">
                        <div class="order-summary__sections">
                            <div class="discount-code" id="discountCode">
                                <div class="order-summary__section order-summary__section--total-lines order-summary--collapse-element table-container">
                                    <table class="total-line-table">
                                        <tbody class="total-line-table__tbody">
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
                                                ?>
                                                <tr class="total-line total-line--subtotal">
                                                    <th class="total-line__name">
                                                        <?= SHOW_text($sanpham['tenbaiviet_' . $_SESSION['lang']]) ?> x
                                                        (<?= $value ?>)
                                                    </th>
                                                    <td class="total-line__price"><?= NUMBER_fomat_d($thanhtien) ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                        </tbody>
                                        <tfoot class="total-line-table__footer">
                                        <tr class="total-line payment-due">
                                            <th class="total-line__name">
                                                <span class="payment-due__label-total">
                                                    <?= $glo_lang['cart_tong_tien'] ?>
                                                </span>
                                            </th>
                                            <td class="total-line__price">
                                                <span class="payment-due__price"><?= NUMBER_fomat_d($tongtien) ?></span>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="thanhtoan-2">
                        <h2><?= $glo_lang['phuong_thuc_thanh_toan'] ?></h2>
                        <input type="hidden" name="type_payment" value="4" id="type_payment">
                        <div class="dv-gr-vanchuyen dv-gr-thanhtoan">
                            <?php
                            $i = 0;
                            $pthucthanhtoan = DB_fet("*", "#_phuongthucthanhtoan", "`showhi` = 1", "`catasort` DESC", "", "arr");
                            foreach ($pthucthanhtoan as $item) {
                                $active = $i == 0 ? 'checked="checked"' : "";
                                ?>
                                <label>
                                    <div class="radio__input">
                                        <input class="input_style_1 input_style_radio cls_check_show_checkbox"
                                               data=".cls_ndtt_<?= $item['id'] ?>" datagr=".cls_ndtt" type="radio"
                                               value="<?= $item['id'] ?>"
                                            <?= $active ?>
                                               name="is_thanhtoan"></div>
                                    <span class="radio__label__primary"><?= $item['tenbaiviet_' . $lang] ?></span>
                                    <div class="clr"></div>
                                </label>
                                <?php
                                $i++;
                            } ?>
                            <div class="clr"></div>
                            <div class="blank-slate">
                                <?php
                                $i = 0;
                                $pthucthanhtoan = DB_fet("*", "#_phuongthucthanhtoan", "`showhi` = 1", "`catasort` DESC", "", "arr");
                                foreach ($pthucthanhtoan as $item) {
                                    $active = $i == 0 ? 'block' : "none";
                                    ?>
                                    <div class="cls_ndtt cls_ndtt_<?= $item['id'] ?>" style="display: <?= $active ?>;">
                                        <?= strip_tags($item['noidung_' . $lang]) ?>
                                        <div class="clr"></div>
                                    </div>
                                    <?php
                                    $i++;
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" checked="" id="check_accept_payment">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= $glo_lang['dieu_khoan_website'] ?> <span style="color:red">*</span>
                        </label>
                    </div>
                    <div class="order-summary__nav method-button-cart">
                        <a href="<?= $full_url . '/gio-hang' ?>" class="previous-link">
                            <span class="previous-link__content"><i class="fa fa-chevron-left"
                                                                    aria-hidden="true"></i> <?= $glo_lang['quay_ve_gio_hang'] ?></span>
                        </a>
                        <div class="sc_item_button sc_button_wrap sc_align_left">
                            <a onclick="return CHECK_send_lienhe('<?= $full_url ?>/','#FormNameContact_cart', '.cls_data_check_form')"
                               style="cursor:pointer"
                               class="sc_button sc_button_default sc_button_size_normal sc_button_icon_left"><?= $glo_lang['title_dat_hang'] ?>
                                <img
                                        src="images/loading2.gif" class="ajax_img_loading"></a>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="clr"></div>
        </form>
    </div>
</div>
<script>
    $("#city").change(function () {
        var provinceId = $("#city option:selected").data("id");
        console.log(provinceId);
        $.ajax({
            url: "<?=$full_url . '/get-district'?>", // Địa chỉ endpoint của bạn
            type: "POST",              // Loại request (POST)
            data: {
                province_id: provinceId,        // Dữ liệu gửi đi (key-value)
            },
            success: function (response) {
                response = JSON.parse(response);
                var district = $("#district"); // Lấy phần tử district bằng jQuery
                var firstChild = district[0].firstElementChild; // Lưu phần tử con đầu tiên

                // Xóa tất cả các phần tử con ngoài phần tử con đầu tiên
                while (district[0].childElementCount > 1) {
                    district[0].removeChild(district[0].lastChild); // Xóa phần tử con cuối cùng
                }

                // Thêm các phần tử <option> mới vào district
                $(response).each(function (index, element) {
                    district.append("<option data-id='" + element.Id + "' value='" + element.Name + "'>" + element.Name + "</option>");
                });
            },
            error: function (xhr, status, error) {
                // Hàm callback nếu có lỗi
                console.error("Error:", error);
            }
        });
    });

    $("#district").change(function () {
        var districtId = $("#district option:selected").data("id");
        $.ajax({
            url: "<?=$full_url . '/get-ward'?>", // Địa chỉ endpoint của bạn
            type: "POST",              // Loại request (POST)
            data: {
                district_id: districtId,        // Dữ liệu gửi đi (key-value)
            },
            success: function (response) {
                response = JSON.parse(response);
                var ward = $("#ward"); // Lấy phần tử district bằng jQuery
                // Xóa tất cả các phần tử con ngoài phần tử con đầu tiên
                while (ward[0].childElementCount > 1) {
                    ward[0].removeChild(ward[0].lastChild); // Xóa phần tử con cuối cùng
                }

                // Thêm các phần tử <option> mới vào district
                $(response).each(function (index, element) {
                    ward.append("<option value='" + element.Name + "'>" + element.Name + "</option>");
                });
            },
            error: function (xhr, status, error) {
                // Hàm callback nếu có lỗi
                console.error("Error:", error);
            }
        });

    });
</script>