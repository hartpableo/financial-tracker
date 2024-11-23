<?php
$helper = new core\Helpers();
$router = new core\Router();
$helper->templatePart('header', ['title' => $args['title']]);
?>

<section>
    <div class="container">
        <h1>Home</h1>
        <p>Welcome to the home page.</p>

        <form action="<?php echo $router->route('/add-item'); ?>" method="post">
            <h2>Add assets</h2>
            <div class="mb-3">
                <input type="text" aria-label="Asset Item 1" class="form-control" id="asset-item-1" name="assets[]">
                <button type="button" class="js-add-item fw-bold" aria-label="Add asset item" data-current-item="1">
                    <span class="screen-reader-text">+</span>
                </button>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</section>

<?php
$helper->templatePart('footer');