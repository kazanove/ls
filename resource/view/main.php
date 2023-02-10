<?php
/**
 * @var array $specialistTop
 * @var array $currentSections
 * @var array $services
 * @var array $lawyersAdvocates
 * @var array $experts
 * @var array $notaries
 * @var array $usefulSections
 */
?>
<div class="index-catalog-block">
    <div class="block-name">
        <?= lng('top_specialists') ?>
    </div>
    <div class="flex">
        <?php
        specialistCards($specialistTop);
        ?>
    </div>
</div>
<div class="index-sections-block">
    <div class="block-name">
        <?= lng('current_sections') ?>
    </div>
    <div class="flex">
        <?php
        foreach ($currentSections as $currentSection) {
            echo '   <div class="item">
            <img src="' . asset('img/section/' . $currentSection['img']) . '">
            <p><span>' . $currentSection['title'] . '</span></p>
            <a href="' . route('section', ['section' => $currentSection['title']]) . '"></a>
        </div>';
        }
        ?>
    </div>
    <a href="<?= route('all_sections') ?>" class="bottom-link"><?= lng('show_all_sections') ?></a>
</div>
<div class="index-catalog-block">
    <div class="top-block-link">
        <a href="<?= route('lawyers_advocates') ?>"><?= lng('lawyers_advocates') ?></a>
    </div>
    <div class="filter">
        <form method="get" action="<?= route('filter') ?>">
            <a class="city-link">
                <?php
                $citySelect = $citySelect ?? $_COOKIE['city']??null;
                echo '<span  class="c' . $citySelect . ' active">' . lng('cities.' . $citySelect) . '</span>' . "\n" . '
                <input class="input_city_id" name="city" value="' . $citySelect . '" hidden>';
                ?>
            </a>
            <select name="service" class="sel" id="category">
                <option value=".s0" class="hidden"><?= lng('law_section') ?></option>
                <option value=".s0"><?= lng('all_sections') ?></option>
                <?php
                foreach ($services as $service) {
                    if ($service['c_id'] === 1 || $service['c_id'] === 2 || $service['c_id'] === 5 || $service['c_id'] === 6) {
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
                if ($service['c_id'] === 1 || $service['c_id'] === 2 || $service['c_id'] === 5 || $service['c_id'] === 6) {
                    if (count($service['sub']) !== 0) {
                        echo '<select name="sub_service[' . $service['id'] . ']" class="sel subcat s' . $service['id'] . '">' . "\n" . '
                    <option value="0">' . lng('all_subsections') . '</option>' . "\n";
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
            <input type="checkbox" name="private" class="checkbox" id="ch1"><label
                for="ch1"><?= lng('private') ?></label>
            <input type="checkbox" name="company" class="checkbox" id="ch2"><label
                for="ch2"><?= lng('company') ?></label>
            <button><?= lng('show_specialists') ?></button>
        </form>
    </div>
    <div class="flex">
        <?php
        specialistCards($lawyersAdvocates);
        ?>
    </div>
    <div class="bottom-link">
        <a href="<?= route('lawyers_advocates') ?>"><?= lng('lawyers_advocates') ?></a>
    </div>
</div>
<div class="index-catalog-block">
    <div class="top-block-link">
        <a href="<?= route('expertise') ?>"><?= lng('message.expert_institutions_and_private_experts') ?></a>
    </div>
    <div class="filter">
        <form method="get" action="<?= route('filter') ?>">
            <a class="city-link">
                <?php
                $citySelect = $citySelect ?? $_COOKIE['city']??null;
                echo '<span  class="c' . $citySelect . ' active">' . lng('cities.' . $citySelect) . '</span>' . "\n" . '
                <input class="input_city_id" name="city" value="' . $citySelect . '" hidden>';
                ?>
            </a>
            <div class="jq-selectbox jqselect sel hidden" style="z-index: 10;">
                <select name="service" class="sel">
                    <option class="hidden"><?= lng('type_expertise') ?></option>
                    <option><?= lng('all_types') ?></option>
                    <?php
                    foreach ($services as $service) {
                        if ($service['c_id'] === 3 or $service['c_id'] === 7) {
                            if ($service !== 0) {
                                echo '<option value=".s' . $service['id'] . '">' . lng('services.' . $service['id'] . '.title') . '</option>' . "\n";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <input type="checkbox" name="private" class="checkbox" id="ch3"><label
                for="ch3"><?= lng('private') ?></label>
            <input type="checkbox" name="company" class="checkbox" id="ch4"><label
                for="ch4"><?= lng('company') ?></label>
            <button><?= lng('show_specialists') ?></button>
        </form>
    </div>
    <div class="flex">
        <?php
        specialistCards($experts);
        ?>
    </div>
    <div class="bottom-link">
        <a href="<?= lng('expertise') ?>"><?= lng('show_all_experts') ?></a>
    </div>
</div>
<div class="index-catalog-block">
    <div class="top-block-link">
        <a href="<?= route('notaries') ?>"><?= lng('notaries') ?></a>
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
            <a class="metro-link"><?= lng('metro') ?></a>
            <button><?= lng('show_specialists') ?></button>
        </form>
    </div>
    <div class="flex">
        <?php
        specialistCards($notaries);
        ?>
    </div>
    <div class="bottom-link">
        <a href="<?= route('notaries') ?>"><?= lng('show_all_notaries') ?></a>
    </div>
</div>
<div class="index-sections-block last">
    <div class="block-name">
        <?= lng('useful_sections') ?>
    </div>
    <div class="flex">
        <?php
        foreach ($usefulSections as $usefulSection) {
            echo '   <div class="item">
            <img src="' . asset('img/section/' . $usefulSection['img']) . '">
            <p><span>' . $usefulSection['title'] . '</span></p>
            <a href="' . route('section', ['section' => $usefulSection['title']]) . '"></a>
        </div>';
        }
        ?>
    </div>
    <a href="#" class="bottom-link"><?= lng('show_all_sections') ?></a>
</div>

