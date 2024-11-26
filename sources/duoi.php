<div class="clr"></div>
</div>
<?php include _source . "footer.php"; ?>
</div>
</article>
</section>


<script type="text/javascript" src="js/owl.carousel.js"></script>


<script type="text/javascript" src="js/jquery.lazyload.min.js"></script>
<script type="text/javascript" language="javascript" src="js/me.js?v=<?= time() ?>"></script>
<script src='menu_mb/jquery.mmenu.min.js' type='text/javascript'></script>
<script>
    $(function () {
        $("#nav-mobile").mmenu();
        $("#nav-mobile").show();
    });
</script>

<?php if (!empty($slug_step)) { ?>
    <script>$(".active_mn_<?=$slug_step ?>").addClass("acti")</script>
<?php } else { ?>
    <script>$(".active_mn_01").addClass("acti")</script>
<?php } ?>

<script>

    function add_cart_detail(itemid) {
        var total = parseInt($("#number").val());
        add_cart(itemid, total)
    }

    $("#number").change(function(){
        var dataNumber = parseInt($(this).val());
        if(dataNumber===0 || isNaN(dataNumber)){
            $(this).val(1);
        }
    })

    function add_cart(itemid, total = 1) {
        $.ajax({
            url: '<?=$full_url . "/gio-hang/"?>', // URL đích
            type: 'POST', // Phương thức POST
            data: {
                id: itemid,       // Thay 'giá_trị_id' bằng giá trị thực tế
                qty_cart: total, // Thay 'giá_trị_qty' bằng giá trị thực tế
                result: true // Thay 'giá_trị_qty' bằng giá trị thực tế
            },
            success: function (response) {
                response = JSON.parse(response);
                $('.cart span').html(response.total);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi
                console.error('Lỗi:', error);
            }
        });
        alert("<?=$glo_lang['add_cart_success']?>")
    }

    document.querySelectorAll('.input_style_1').forEach(input => {
        input.addEventListener('click', function () {
            // Bỏ thuộc tính checked khỏi tất cả các input khác
            document.querySelectorAll('.input_style_1').forEach(otherInput => {
                otherInput.removeAttribute('checked');
            });

            // Thêm thuộc tính checked cho input hiện tại
            this.setAttribute('checked', 'checked');

            // Lấy giá trị của input hiện tại
            const value = this.value;

            // Hiển thị phần tử cls_ndtt tương ứng và ẩn những phần còn lại
            document.querySelectorAll('.cls_ndtt').forEach(div => {
                if (div.classList.contains(`cls_ndtt_${value}`)) {
                    div.style.display = 'block';
                    $("#type_payment").val(value);
                } else {
                    div.style.display = 'none';
                }
            });
        });
    });
    $(".input_style_1").trigger("click");
</script>
</body>
</html>