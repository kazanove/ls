<?php
/**
 * @var array $services
 */
?>
<nav class="mobile-menu m1">
    <a class="close"></a>
    <p><?= lng('lawyers_area')?></p>
    <ul>
        <?php
        foreach ($services as $service) {
            if ($service['c_id'] === 1) {
                $name = lng('services.' . $service['id'].'.title');
                echo '<li><a href="' . route('service', ['service' => $name]) . '">' . $name . '</a></li>' . "\n";
            }
        }
        ?>
    </ul>
    <p><?=lng('expertise_areas')?></p>
    <ul>
        <?php
        foreach ($services as $service) {
            if ($service['c_id'] === 3) {
                $name = lng('services.' . $service['id'].'.title');
                echo '<li><a href="' . route('service', ['service' => $name]) . '">' . $name . '</a></li>' . "\n";
            }
        }
        ?>
    </ul>
    <p><?=lng('notaries')?></p>
</nav>