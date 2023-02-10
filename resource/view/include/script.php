<?php
/**
 * @var string $url
 */
?>
<script>
    if (!$.cookie('city')) {
        $('.popup.cities').fadeIn();
        $('body').addClass('hid');
    }
    <?php
    if (str_starts_with($url, '/' . lng('specialist', false))) {
    ?>
    document.getElementById("copy").onclick = function () {
        var copyTextarea = document.createElement("textarea");
        copyTextarea.style.position = "fixed";
        copyTextarea.style.opacity = "0";
        copyTextarea.textContent = document.getElementById("content").value;

        document.body.appendChild(copyTextarea);
        copyTextarea.select();
        document.execCommand("copy");
        document.body.removeChild(copyTextarea);
    }
    <?php
    }
    ?>
</script>