<?php
/**
 * @var $services array
 */
?>
<header class="mobile-header">
    <div class="wrap">
        <div class="flex">
            <a class="menu-button"></a>
            <div class="name">
                <a href="<?= route('main') ?>">
                    <span>ЮРФАК</span><?= lng('all_lawyers_advocates') ?></a>
            </div>
            <a class="menu-button2"></a>
        </div>
        <div class="links">
            <?php
            foreach ($services as $service) {
                if ((int)$service['c_id'] === 1) {
                    $name = lng('services.' . $service['id'].'.'.'title');
                    echo '<a title="'.lng('services.' . $service['id'].'.'.'description').'" href="' . route('service', ['service' => $name]) . '">' . $name . '</a>' . "\n";
                }
            }
            ?>
        </div>
    </div>
</header>