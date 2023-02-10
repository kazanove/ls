<nav class="mobile-menu m2">
    <a class="close"></a>
    <ul>
        <?php
        if (user() === false) {
            echo '
                    <li><a class="reg">' . lng('registration') . '</a></li>
                    <li><a class="login">' . lng('enter') . '</a></li>
                  ';
        } else {
            trigger_error('');
        }
        echo '<li><a href="' . route('about') . '">' . lng('about_project') . '</a></li>
        <li><a class="feedback">' . lng('feedback') . '</a></li>
        ';
        ?>
    </ul>
</nav>