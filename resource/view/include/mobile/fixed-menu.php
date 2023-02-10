<nav class="mobile-fixed-menu">
    <ul class="flex">
        <li>
            <a href="<?= route('lawyers_advocates') ?>">
                <img src="<?= asset('img/mmenu1.svg') ?>" alt="">
                <?= lng('lawyers_advocates') ?>
            </a>
        </li>
        <li>
            <a href="<?= route('expertise') ?>">
                <img src="<?= asset('img/mmenu2.svg') ?>" alt="">
                <?= lng('expertise') ?>
            </a>
        </li>
        <li>
            <a href="<?= route('notaries') ?>">
                <img src="<?= asset('img/mmenu3.svg') ?>" alt="">
                <?= lng('notaries') ?>
            </a>
        </li>
        <li>
            <a href="<?= route('blogs') ?>">
                <img src="<?= asset('img/mmenu4.svg') ?>" alt="">
                <?= lng('blogs') ?>
            </a>
        </li>
    </ul>
    <a class="filter-link"><?= lng('filters') ?><span></span></a>
</nav>