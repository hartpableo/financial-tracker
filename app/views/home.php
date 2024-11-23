<?php
$helper = new core\Helpers();
$helper->templatePart('header', ['title' => $args['title']]);
?>

<h1>Home</h1>

<?php
$helper->templatePart('footer');