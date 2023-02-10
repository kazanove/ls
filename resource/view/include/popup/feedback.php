<div class="popup feedback">
    <div class="bg"></div>
    <div class="window middle2">
        <div class="reg">
            <div class="name tal">
                <?=lng('feedback')?>
            </div>
            <div class="form1">
                <form id="formFeedBack">
                    <?= csrf()?>
                    <div class="field">
                        <input name="email" type="text" placeholder="<?=lng('tel_or_email')?>" class="inp">
                    </div>
                    <div class="field">
                        <textarea name="message" placeholder="<?= lng('message') ?>" class="inp"></textarea>
                    </div>
                    <div class="button other">
                        <p><?=lng('message.i_accept_send')?></p>
                        <button class="other" id="btn1"><?= lng('send')?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#btn1').on('click', function() {
        let feedback=0;
        $('.form1 .inp').each(function() {
            if ($(this).val() !== '') {
                feedback++;
                $(this).removeClass('error');
            }
            else {
                $.notify('<?=lng('message.you_did_fill_field')?> ' + $(this).attr('placeholder'), {title: '<?=lng('error')?>'});
                $(this).addClass('error');
            }
        })

        if(feedback===2){
            let formFeedBack= $('#formFeedBack');
            $.ajax({
                type: 'POST',
                url: '<?= route('feedback')?>',
                data: formFeedBack.serialize(),
            }).done(function (response, textStatus, jqXHR) {
                $('.popup').fadeOut();
                $('body').addClass('hid');
                formFeedBack[0].reset();
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                console.log('4.4');
            });
        }
        return false;
    });
</script>