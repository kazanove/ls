<?php
/**
 * @var array $metro
 */
?>
<div class="popup metro">
    <div class="bg"></div>
    <div class="window">
        <a class="close"></a>
        <div class="select-block">
            <div class="name">
                <?= lng('metro') ?>
            </div>
            <input type="text" placeholder="<?= lng('metro_station') ?>">
            <?php
            foreach ($metro as $id => $m) {
                if ($id !== 0) {
                    echo '<div class="list m-list l' . $id . ' ' . (($id === $citySelect) ? 'active' : '') . '">' . "\n";
                    echo lng('metro_station') . ' ' . lng('in') . ' ' . lng('cities.' . $id);
                    foreach ($m as $key => $title) {
                        echo '<input type="checkbox" class="checkbox" id="metro' . $key . '" name="metro" value="' . $key . '"><label for="metro' . $key . '">' . $title . '</label>' . "\n";
                    }
                    echo '</div>' . "\n";
                }
            }
            if ($id === 0) {
                echo '<div class="list m-list l0 active">' . "\n";
                echo lng('metro_station') . ' ' . lng('in') . ' <span>' . lng('cities.' . $citySelect).'</span>'."\n";
                echo '</div>' . "\n";
            }
            ?>
        </div>
    </div>
</div>