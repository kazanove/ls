<?php
/**
 * @var $classifications array
 */
?>
<div class="popup reg">
    <div class="bg"></div>
    <div class="window middle">
        <div class="reg">
            <div class="name">
                <?= lng('registration') ?>
            </div>
            <script>
                let step = 1;
            </script>
            <div class="step s1 active">
                <div class="select">
                    <input type="radio" class="radio" id="step1" name="step1" value="1">
                    <label for="step1" class="l1"><?= lng('private_specialist') ?></label>
                    <input type="radio" class="radio" id="step2" name="step1" value="2">
                    <label for="step2" class="l2"><?= lng('organization') ?></label>
                </div>
                <div class="number">
                    <?= lng('step') ?> 1 <?= lng('of', false) ?> 3
                </div>
            </div>
            <form id="registration">
                <?= csrf() ?>
                <div class="step s2">
                    <div class="select">
                        <?php
                        foreach ($classifications as $classification) {
                            if ((int)$classification['company'] === 0) {
                                echo '<input type="radio" class="radio" id="step' . ($classification['id'] + 2) . '" name="classification" value="' . $classification['id'] . '"><label for="step' . ($classification['id'] + 2) . '">' . lng('classification.' . $classification['id']) . '</label>';
                            }
                        }
                        ?>
                    </div>
                    <div class="number">
                        <?= lng('step') ?> 1 <?= lng('of', false) ?> 3
                    </div>
                </div>
                <div class="step s3">
                    <div class="select">
                        <?php
                        foreach ($classifications as $classification) {
                            if ((int)$classification['company'] === 1) {
                                echo '<input type="radio" class="radio" id="step' . ($classification['id'] + 2) . '" name="step3" value="' . $classification['id'] . '"><label for="step' . ($classification['id'] + 2) . '">' . lng('classification.' . $classification['id']) . '</label>';
                            }
                        }
                        ?>
                    </div>
                    <div class="number">
                        <?= lng('step') ?> 2 <?= lng('of', false) ?> 3
                    </div>
                </div>
                <div class="step s4">
                    <div class="form4">
                        <div class="field">
                            <input type="text" name="name" placeholder="<?= lng('name') ?>*" class="inp">
                        </div>
                        <div class="field">
                            <input type="text" name="surname" placeholder="<?= lng('surname') ?>*" class="inp">
                        </div>
                        <div class="field">
                            <input type="text" name="telephone" placeholder="<?= lng('number_phone') ?>*" class="inp">
                        </div>
                        <div class="field-name">
                            <?= lng('authorization_data') ?>
                        </div>
                        <div class="field">
                            <input type="text" name="email" placeholder="<?= lng('email') ?>*" class="inp">
                        </div>
                        <div class="field">
                            <input type="password" name="password" placeholder="<?= lng('password') ?>*" id="pass1"
                                   class="inp">
                            <a class="show-pass" id="show"><?= lng('show') ?></a>
                        </div>
                        <div class="button">
                            <p><?= lng('message.i_accept_register') ?></p>
                            <button id="btn4"><?= lng('register') ?></button>
                        </div>
                    </div>
                    <div class="number">
                        <?= lng('step') ?> 3 <?= lng('of', false) ?> 3
                    </div>
                </div>
                <div class="step s5">
                    <div class="form5">
                        <div class="field">
                            <input type="text" placeholder="<?= lng('company_name') ?>*" class="inp" name="c_title">
                        </div>
                        <div class="field-name">
                            <?=lng('contact_person')?>
                        </div>
                        <div class="field">
                            <input type="text" placeholder="<?= lng('name') ?>*" class="inp" name="c_name">
                        </div>
                        <div class="field">
                            <input type="text" placeholder="<?= lng('surname') ?>*" class="inp" name="c_surname">
                        </div>
                        <div class="field">
                            <input type="text" placeholder="<?= lng('number_phone') ?>*" class="inp" name="c_telephone">
                        </div>
                        <div class="field-name">
                            <?= lng('authorization_data') ?>
                        </div>
                        <div class="field">
                            <input type="text" placeholder="<?= lng('email') ?>*" class="inp" name="c_email">
                        </div>
                        <div class="field">
                            <input type="password" placeholder="<?= lng('password') ?>*" id="pass2" class="inp" name="c_password">
                            <a class="show-pass" id="show2"><?= lng('show') ?></a>
                        </div>
                        <div class="button">
                            <p><?= lng('message.i_accept_register') ?></p>
                            <button id="btn5"><?= lng('register') ?></button>
                        </div>
                    </div>
                    <div class="number">
                        <?= lng('step') ?> 3 <?= lng('of', false) ?> 3
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#btn4').on('click', function (e) {
        let auth = 0;
        $('.form4 .inp').each(function () {
            if ($(this).val() !== '') {
                auth++
                $(this).removeClass('error');
            } else {
                $.notify('<?=lng('message.you_did_fill_field')?> ' + $(this).attr('placeholder'), {title: '<?=lng('error')?>'});
                $(this).addClass('error');
            }
        });
        if (auth === 5) {
            let regForm= $("#registration");
            $.ajax({
                type: 'POST',
                url: '<?= route('registration')?>',
                data: regForm.serialize(),
            }).done(function (response, textStatus, jqXHR) {
                if (response.code) {
                    if (response.code === '0') {
                        $('.popup.reg').fadeOut();
                        // $.notify(response.message, {title: '<?= lng('registration')?>', timeout: 3000});
                        $('.popup.reg2').fadeIn();
                        regForm[0].reset();
                    } else if (response.code === '1') {
                        $.notify(response.message, {title: '<?=lng('error')?>'});
                    } else {
                        console.log('2.1');
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
    })
    $('#btn5').on('click', function() {
        let auth = 0;
        $('.form5 .inp').each(function() {
            if ($(this).val() != '') {
                auth++
                $(this).removeClass('error');
            }
            else {
                $.notify('<?=lng('message.you_did_fill_field')?> ' + $(this).attr('placeholder'), {title: '<?=lng('error')?>'});
                $(this).addClass('error');
            }
        });
        if (auth === 6) {
            let regForm= $("#registration");
            $.ajax({
                type: 'POST',
                url: '<?= route('registration')?>',
                data: regForm.serialize(),
            }).done(function (response, textStatus, jqXHR) {
                if (response.code) {
                    if (response.code === '0') {
                        $('.popup.reg').fadeOut();
                        $.notify(response.message, {title: '<?= lng('registration')?>', timeout: 3000});
                        $('.popup.reg2').fadeIn();
                        regForm[0].reset();
                    } else if (response.code === '1') {
                        $.notify(response.message, {title: '<?=lng('error')?>'});
                    } else {
                        console.log('3.1');
                    }
                } else {
                    $.notify(response.message, {title: '<?=lng('error')?>'});
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                console.log('3.3');
            });
        }
        return false;
    });
</script>
