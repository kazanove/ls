<?php
/**
 * @var $cities array
 */
?>
<div class="popup cities">
    <div class="bg"></div>
    <div class="window">
        <a class="close"></a>
        <div class="select-block">
            <div class="name">
                <?= lng('select_city') ?>
            </div>
            <div class="ui-widget">
                <input id="city" type="text" placeholder="<?= lng('your_city') ?>">
            </div>
            <div class="list cities-list">
                <input type="radio" class="radio" id="city0" name="city">
                <?php
                $check = $_COOKIE['city']??true;
                foreach ($cities as $city) {
                    if($check===true || (int)$check===$city['id']) {
                        echo '<input type="radio" class="radio" id="city' . $city['id'] . '" name="city" checked value="' . $city['id'] . '"><label for="city' . $city['id'] . '" class="l' . $city['id'] . '">' . lng('cities.' . $city['id']) . '</label>' . "\n";
                        $check = false;
                        $citySelect=$city['id'];
                    }else{
                        echo '<input type="radio" class="radio" id="city' . $city['id'] . '" name="city" value="' . $city['id'] . '"><label for="city' . $city['id'] . '" class="l' . $city['id'] . '">' . lng('cities.' . $city['id']) . '</label>' . "\n";
                    }
                }
                ?>
            </div>
            <span id="itemLabel"></span>
        </div>
    </div>
    <script>
        $(function () {
            $('#city').autocomplete({
                source: '<?= route('city')?>',
                select: function (event, ui) {
                    let id = ui.item.id;
                    let radios = $('input:radio[name=city]');
                    radios.prop('checked', false);
                    radios.filter('#city0')[0].value = id;
                    $('.mobile-filter-block .city span').text(ui.item.value);
                    $('.index-catalog-block .filter .city-link span').text(ui.item.value);
                    $('.header .city span').text(ui.item.value);
                    $('.input_city_id').attr('value', ui.item.id);
                    $('.popup .window .select-block .m-list span').text(ui.item.value);
                    $.cookie('city', id);
                },
                minLength: 3,
                delay: 1000
            });
        });
    </script>
</div>