<?php
/**
 * @var array $services
 */
?>
<div class="popup menu">
    <div class="bg"></div>
    <div class="window big">
        <a class="close"></a>
        <div class="site-menu">
            <div class="name">
                <?= lng('lawyers_advocates') ?>
            </div>
            <div class="flex2">
                <?php
                $countServices = ceil(count($services) / 4);
                $i = 0;
                foreach ($services as $service) {
                    if ($service['c_id'] === 1) {
                        if ($i === 0) {
                            echo "\n" . '<div class="nav">' . "\n";
                        }
                        if (isset($service['sub'])) {
                            echo "\t" . '<p><a title="' . lng('services.' . $service['id'] . '.description') . '" href="' . route('service', ['service' => str_replace(' ', '_', lng('services.' . $service['id'] . '.title', false))]) . '">' . lng('services.' . $service['id'] . '.title') . '</a></p>' . "\n";
                            $i++;
                            echo "\t" . '<ul>' . "\n";
                            foreach ($service['sub'] as $serviceSub) {
                                if ($i === 0) {
                                    echo "\n" . '<div class="nav">' . "\n";
                                    echo "\t" . '<ul>' . "\n";
                                }
                                echo "\t\t" . '<li><a title=\'' . lng('services.' . $serviceSub['id'] . '.description') . '\' href="' . route('services', ['service' => str_replace(' ', '_', lng('services.' . $service['id'] . '.title', false)), 'sub_service' => str_replace(' ', '_', lng('services.' . $serviceSub['id'] . '.title', false))]) . '">' . lng('services.' . $serviceSub['id'] . '.title') . '</a></li>' . "\n";
                                $i++;
                                if ($countServices <= $i) {
                                    $i = 0;
                                    echo "\t" . '</ul>' . "\n";
                                    echo '</div>' . "\n";
                                }
                            }
                            echo "\t" . '</ul>' . "\n";
                        } else {
                            trigger_error('');
                        }
                        if ($countServices <= $i) {
                            $i = 0;
                            echo '</div>' . "\n";
                        }
                    }
                }
                ?>
            </div>

        </div>
        <div class="flex2">
            <div class="nav">
                <div class="name">
                    <a href="<?= route('service', ['service' => lng('expertise', false)]) ?>"><?= lng('expertise') ?></a>
                </div>
                <ul>
                    <?php
                    foreach ($services as $service) {
                        if ($service['c_id'] === 3) {
                            echo '<li><a title="' . lng('services.' . $service['id'] . '.title') . '" href="' . route('services', ['service' => lng('expertise', false), 'sub_service' => str_replace(' ', '_', lng('services.' . $service['id'] . '.title', false))]) . '">' . lng('services.' . $service['id'] . '.title') . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="nav">
                <div class="name">
                    <a href="<?= route('service', ['service' => lng('notary_offices', false)]) ?>"><?= lng('notary_offices') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
