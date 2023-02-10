<div class="popup pass">
    <div class="bg"></div>
    <div class="window middle">
        <div class="reg">
            <div class="name">
                <?= lng('password_recovery') ?>
            </div>
            <form id="formPass">
                <div class="form2">
                    <?= csrf() ?>
                    <div class="field">
                        <input type="text" name="email" placeholder="<?= lng('email_during_registration') ?>" class="inp">
                    </div>
                    <div class="button other">
                        <button id="btn2"><?= lng('send') ?></button>
                    </div>
                </div>
            </form>
            <div class="bottom-links flex">
                <div>
                    <a class="pass"><?= lng('forgot_password') ?></a>
                    <a class="reg"><?= lng('register') ?></a>
                </div>
                <a class="feedback"><?= lng('feedback') ?></a>
            </div>
        </div>
    </div>
</div>
<script>
    //отображает востановление пароля
    $('#btn2').on('click', function () {
        let formPass=$('#formPass');
        $('.form2 .inp').each(function () {
            if ($(this).val() !== '') {
                $.ajax({
                    type: 'POST',
                    url: '<?= route('password_recovery')?>',
                    data: formPass.serialize(),
                }).done(function (response, textStatus, jqXHR) {
                    if (response.code) {
                        if (response.code === '0') {
                            $.notify(response.message, {title: '<?=lng('error')?>'});
                            $('.popup').fadeOut();
                            $('body').removeClass('hid');
                        } else if (response.code === '1') {
                            $.notify(response.message, {title: '<?=lng('error')?>'});
                        }else {
                            console.log('0.3');
                        }
                    } else {
                        console.log(response);
                        $.notify(response.message, {title: '<?=lng('error')?>'});
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                    console.log('2.3');
                });
                $(this).removeClass('error');
            } else {
                $.notify('<?=lng('message.you_did_fill_field')?> ' + $(this).attr('placeholder'), {title: '<?=lng('error')?>'});
                $(this).addClass('error');
            }
        });
        return false;
    });
</script>