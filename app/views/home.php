<?php
$helper = new core\Helpers();
$router = new core\Router();
$helper->templatePart('header', ['title' => $args['title']]);
?>

    <section>
        <div class="container">
            <h1 class="sr-only"><?php echo $args['title']; ?></h1>

            <div class="row">
                <div class="col-12 col-md-6">
                  <?php $helper->templatePart('forms/assets'); ?>
                </div>
                <div class="col-12 col-md-6">
                  <?php $helper->templatePart('forms/liabilities'); ?>
                </div>
            </div>
        </div>
    </section>

<?php
$helper->templatePart('footer');