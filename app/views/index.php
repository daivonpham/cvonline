<!DOCTYPE html>
<html lang="en">

<head>
    <?php render('components/header') ?>
</head>

<body>
    <?php
    if (!isset($template) || $template !== '/auth/login' && $template !== '/auth/register') {
        render('components/menu');
    }
    ?>
    <div class="layout-page <?php echo (!isset($template) || ($template !== '/auth/login' && $template !== '/auth/register')) ? 'main-padding' : ''; ?>">
        <?php
        if (!isset($template) || $template !== '/auth/login' && $template !== '/auth/register') {
            render('components/search');
        }
        ?>
        <div class="content-wrapper">
            <?php render($template, $data) ?>
            <?php
            if (!isset($template) || $template !== '/auth/login' && $template !== '/auth/register') {
               render('components/footer');
            }
            ?>
        </div>
    </div>

    <?php render('components/script') ?>
</body>

</html>