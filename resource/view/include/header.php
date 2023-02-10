<header class="header">
    <div class="wrap">
        <div class="flex">
            <a class="city">
                <?php
                echo '<span class="active">' . $city . '</span>' . "\n";
                ?>
            </a>
            <?php
            if (user() === false) {
                echo ' <div class="user-links">
                                <a class="reg">' . lng('registration') . '</a>
                                <a class="login">' . lng('enter') . '</a>
                                 </div>
                             ';
            } else {
                echo '<header class="flex">
				<div class="user">
					<a href="' . route('blog') . '" class="blog">' . lng('blog') . '</a>
					' . lng('good_afternoon') . ', <span>' . $user['name'] . '</span> <a href="'.route('personal_area').'"><img class="round" src="' . asset('img/' . $user['photo']) . '"></a>
					<a href="' . route('logout') . '" class="logout"></a>
				</div>
			</header>';
            }
            ?>
        </div>
        <div class="name">
            <a href="<?= route('main') ?>"><span>ЮРФАК</span><?= lng('all_lawyers_advocates') ?></a>
        </div>
        <div class="flex">
            <ul class="menu1">
                <li><a class="site-menu"><span></span> <?= lng('all_sections') ?></a></li>
                <li><a href="<?= route('lawyers_advocates') ?>"><?= lng('lawyers_advocates') ?></a></li>
                <li><a href="<?= route('expertise') ?>"><?= lng('expertise') ?></a></li>
                <li><a href="<?= route('notaries') ?>"><?= lng('notaries') ?></a></li>
            </ul>
            <ul class="menu2">
                <li><a href="<?= route('blogs') ?>"><?= lng('blogs') ?></a></li>
                <li><a href="<?= route('about') ?>"><?= lng('about_project') ?></a></li>
            </ul>
        </div>
    </div>
</header>