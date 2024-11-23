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
            <div class="js-form-repeater-fields">
                <div class="mb-3">
                    <input type="text" aria-label="Asset Item 1" class="form-control" id="asset-item-1" name="assets[]" placeholder="Asset 1">
                </div>
            </div>
            <div class="mb-3">
                <button type="button" class="js-add-item fw-bold" aria-label="Add asset item">
                    <span class="screen-reader-text">+</span>
                </button>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</section>

<?php
$helper->templatePart('footer');