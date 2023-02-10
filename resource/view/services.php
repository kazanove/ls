<?php
/**
 * @var array $services
 */
?>
<div class="index-catalog-block inner">
    <div class="top-text">
        <h1>Все юристы и адвокаты</h1>
        <div class="links">
            <?php
            foreach ($services as $service) {
                if ($service['c_id'] === 1 || $service['c_id'] === 2 || $service['c_id'] === 5 || $service['c_id'] === 6) {
                    echo '<a href="' . route('service', ['service' => lng('services.' . $service['id'].'.title')]) . '">' . lng('services.' . $service['id'].'.title') . '</a>'."\n";
                }
            }
            ?>
        </div>
        <p>Практически каждый человек хотя бы раз в жизни сталкивается с необходимостью обратиться за профессиональной
            правовой помощью. Причины для этого могут быть совершенно разные: потребовалось продать недвижимость, не
            выходить самостоятельно добиться налогового вычета, вы стали участником ДТП или же пострадали от
            некачественно оказанной услуги.</p>
        <p>В данном разделе содержится информация обо всех практикующих на территории России специалистах, которые
            оказывают профессиональную юридическую помощь в различных отраслях права: частных юристах и адвокатах,
            юридических компаниях, а также коллегиях адвокатов.</p>
    </div>
    <div class="filter">
        <form>
            <a class="city-link">
                <?php
                $citySelect = $citySelect ?? $_COOKIE['city']??null;
                echo '<span  class="c' . $citySelect . ' active">' . lng('cities.' . $citySelect) . '</span>' . "\n" . '
                <input class="input_city_id" name="city" value="' . $citySelect . '" hidden>';
                ?>
            </a>
            <select class="sel" id="category">
                <option value=".s0" class="hidden"><?= lng('law_section') ?></option>
                <option value=".s0"><?= lng('all_sections') ?></option>
                <?php
                foreach ($services as $service) {
                    if ($service['c_id'] === 1 or $service['c_id'] === 2 or $service['c_id'] === 5 or $service['c_id'] === 6) {
                        echo '<option value=".s' . $service['id'] . '">' . lng('services.' . $service['id'] . '.title') . '</option>' . "\n";
                    }
                }
                ?>
            </select>
            <select class="sel subcat active pen">
                <option><?= lng('subsection_law') ?></option>
            </select>
            <select class="sel subcat s0">
                <option class="hidden"><?= lng('all_subsections') ?></option>
                <option><?= lng('all_subsections') ?></option>
            </select>
            <?php
            foreach ($services as $key => $service) {
                if ($service['c_id'] === 1 or $service['c_id'] === 2 or $service['c_id'] === 5 or $service['c_id'] === 6) {
                    if (count($service['sub']) !== 0) {
                        echo '<select class="sel subcat s' . $service['id'] . '">' . "\n" . '
                    <option>' . lng('all_subsections') . '</option>' . "\n";
                        $subs = $service['sub'];
                        foreach ($subs as $k => $sub) {
                            echo '<option value=".s' . $sub['id'] . '">' . lng('services.' . $sub['id'] . '.title') . '</option>' . "\n";
                        }
                        echo '</select>' . "\n";
                    } else {
                        echo '<select class="sel subcat s' . $service['id'] . ' pen">
                            <option value=".s' . $sub['id'] . '">' . lng('subsection_law') . '</option>' . "\n" . '
                        </select>';
                    }
                }
            }
            ?>
            <input type="checkbox" name="private" class="checkbox" id="ch1"><label for="ch1"><?= lng('private') ?></label>
            <input type="checkbox" name="company" class="checkbox" id="ch2"><label for="ch2"><?= lng('company') ?></label>
            <button><?= lng('show_specialists') ?></button>
        </form>
    </div>
    <div class="flex">
        <?php
        if(count($sp)!==0) {
            foreach ($sp as $ls) {
                $tariff = $ls['tarif'];
                if ($tariff === 4) {
                    $class = 'border';
                } elseif ($tariff === 3) {
                    $class = 'fav';
                } elseif ($tariff === 2) {
                    $class = '';
                } elseif ($tariff === 1) {
                    $class = '';
                } else {
                    trigger_error('');
                }
                echo ' 
        <div class="item ' . $class . '" >
                <div class="image">
                    <img src="' . asset('img/avatar/' . $ls['photo']) . '">
                    <div class="rating">';
                for ($i = 0; $i < $ls['rating']; $i++) {
                    echo ' <i class="fa fa-star"></i>';
                }
                $r = 5 - $ls['rating'];
                for ($i = 0; $i < $r; $i++) {
                    echo ' <i class="fa fa-star-o"></i>';
                }
                echo '</div>
                </div>
                <div class="name">
                    ' . $ls['name'] . '
                </div>
                <div class="prof">
                    ' . $ls['classification'] . '
                </div>
                <div class="city">
                    ' . $ls['city'] . '
                </div>
                <div class="cats">';
                if (isset($ls['services_provider'])) {
                    echo $ls['services_provider'];
                    if ($ls['services_provider_count'] !== 0) {
                        echo lng('and_more') . ' <a href="#">' . $ls['services_provider_count'] . ' ' . lng('specializations') . '</a>';
                    }
                }
                echo '</div>
                <a href="' . route('specialist', ['id' => $ls['id']]) . '" class="link"></a>
        </div>';
            }
        }else{
            echo lng('nothing_found');
        }
        ?>
    </div>
    <div class="pages">
        <!--        <a href="#" class="active">1</a>-->
        <!--        <a href="#">2</a>-->
        <!--        <a href="#">3</a>-->
        <!--        <a href="#">...</a>-->
        <!--        <a href="#">135</a>-->
        <!--        <a href="#">136</a>-->
        <!--        <a href="#">137</a>-->
    </div>
    <div class="bottom-button">
        <!--        <button>Показать ещё</button>-->
    </div>
</div>