<footer class="footer">
    <div class="wrap">
        <div class="flex">
            <nav>
                <ul>
                    <li><a href="<?= route('lawyers_advocates') ?>"><?= lng('lawyers_advocates') ?></a></li>
                    <li><a href="<?= route('expertise') ?>"><?= lng('expertise') ?></a></li>
                    <li><a href="<?= route('notaries') ?>"><?= lng('notaries') ?></a></li>
                </ul>
                <ul>
                    <li>
                        <a href="<?= route('service', ['service' => lng('services.23.title', false)]) ?>"><?=  lng('services.23.title') ?></a>
                    </li>
                    <li>
                        <a href="<?= route('service', ['service' => lng('services.81.title', false)]) ?>"><?=  lng('services.81.title') ?></a>
                    </li>
                    <li>
                        <a href="<?= route('service', ['sub_service' => lng('services.62.title', false)]) ?>"><?=lng('services.62.title') ?></a>
                    </li>
                    <li>
                        <a href="<?= route('services', ['service'=>str_replace(' ','_',lng('expertise',false)),'sub_service' => lng('services.91.title', false)]) ?>"><?= lng('services.91.title') ?></a>
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="<?= route('services', ['service'=>str_replace(' ','_',lng('expertise',false)),'sub_service' => lng('services.90.title', false)]) ?>"><?= lng('services.90.title', false) ?></a>
                    </li>
                    <li>
                        <a href="<?= route('services', ['service'=>str_replace(' ','_',lng('expertise',false)),'sub_service' => lng('services.92.title', false)]) ?>"><?= lng('services.92.title', false) ?></a>
                    </li>
                    <li>
                        <a href="<?= route('services', ['service'=>str_replace(' ','_',lng('expertise',false)),'sub_service' => lng('services.89.title', false)]) ?>"><?= lng('services.89.title', false) ?></a>
                    </li>
                    <li>
                        <a href="<?= route('services', ['service'=>str_replace(' ','_',lng('expertise',false)),'sub_service' => lng('services.91.title', false)]) ?>"><?= lng('services.91.title', false) ?></a>
                    </li>
                </ul>
            </nav>
            <ul>
                <?php
                if (user() === false) {
                    echo '<li><a class="reg">' . lng('registration') . '</a></li>
                          <li><a class="login">' . lng('enter') . '</a></li>';
                }else{
                    echo '<li><a class="logout">'.lng('logout').'</a></li>';
                }
                ?>
                <li><a href="<?= route('about') ?>"><?= lng('about_project') ?></a></li>
                <li><a class="feedback"><?= lng('feedback') ?></a></li>
            </ul>
        </div>
        <div class="copy">
            <a href="<?= route('main') ?>">ЮРФАК.РУ 2022 (С)</a>
        </div>
    </div>
</footer>