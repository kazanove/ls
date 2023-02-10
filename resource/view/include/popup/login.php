<div class="popup login">
    <div class="bg"></div>
    <div class="window middle">
        <div class="reg">
            <form id="formLogin">
                <div class="name">
                    <?= lng('login') ?>
                </div>
                <div class="form3">
                    <?= csrf() ?>
                    <div class="field">
                        <input type="text" name="login" placeholder=" <?= lng('email') ?>*" class="inp">
                    </div>
                    <div class="field">
                        <input type="password" name="password" placeholder="<?= lng('password') ?>*" id="pass3"
                               class="inp">
                        <a class="show-pass" id="show3"><?= lng('show') ?></a>
                    </div>
                    <div class="button other">
                        <button id="btn3"> <?= lng('login') ?></button>
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
    $('#btn3').on('click', function () {
        let auth = 0;
        $('.form3 .inp').each(function () {
            if ($(this).val() != '') {
                auth++;
                $(this).removeClass('error');
            } else {
                $.notify('<?=lng('message.you_did_fill_field')?> ' + $(this).attr('placeholder'), {title: '<?=lng('error')?>'});
                $(this).addClass('error');
            }
        });
        if (auth === 2) {
            let loginForm = $("#formLogin");
            $.ajax({
                type: 'POST',
                url: '<?= route('login')?>',
                data: loginForm.serialize(),
            }).done(function (response, textStatus, jqXHR) {
                if (response.code) {
                    if (response.code === '0') {
                        window.location.href='<?=route('personal_area')?>';
                    } else if (response.code === '1') {
                        $.notify(response.message, {
                            position: 'center',
                            afterClose : function() {
                                $('#notify').removeClass('center');
                            },
                            timeout: 10000
                        });
                    } else if(response.code === '2'){
                        $.notify(response.message,{title:'<?=lng('error')?>'});
                    }
                    else {
                        console.log('3.3');
                    }
                } else {
                    $.notify(response.message, {title: '<?=lng('error')?>'});
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                console.log('2.3');
            });
        }
        return false;
    });

</script>