<?php
/**
 * @var string @url
 */
$dirInclude = config('view.path') . 'include' . DIRECTORY_SEPARATOR;
include $dirInclude . 'head.php';
?>
<body>
<?php
include $dirInclude . 'mobile' . DIRECTORY_SEPARATOR . 'fixed-menu.php';
include $dirInclude . 'header.php';
include $dirInclude . 'mobile' . DIRECTORY_SEPARATOR . 'header.php';
include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'cities.php';
?>
<div class="wrap">
    <?php
    /**
     * @var string $content
     */
    include $content;
    ?>
</div>
<?php
include $dirInclude . 'footer.php';
if ($url !== '/404') {
    include $dirInclude . 'mobile' . DIRECTORY_SEPARATOR . 'menu_m1.php';
    include $dirInclude . 'mobile' . DIRECTORY_SEPARATOR . 'menu_m2.php';
}
include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'feedback.php';
if (user() === false) {
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'pass.php';
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'login.php';
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'reg.php';
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'reg2.php';
}
if ($url === '/') {
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'metro.php';
}
include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'menu.php';
if (str_starts_with($url, '/' . lng('specialist', false))) {
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'review.php';
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'reviews.php';
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'ways.php';
    include $dirInclude . 'popup' . DIRECTORY_SEPARATOR . 'price.php';
}
include $dirInclude . 'script.php';
?>
</body>
</html>