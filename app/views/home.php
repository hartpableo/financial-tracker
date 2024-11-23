<?php
$helper = new core\Helpers();
$router = new core\Router();
$finalcial_tracker = new app\controllers\FinancialTrackerController();
$helper->templatePart('header', ['title' => $args['title']]);
$financial_items = $finalcial_tracker->getItems();
?>

    <section>
        <div class="container">
            <h1>Home</h1>
            <p>Welcome to the home page.</p>

            <form action="<?php echo $router->route('/add-item'); ?>" method="post">
                <h2>Add assets</h2>
                <input type="hidden" name="type" value="asset">
                <div class="js-form-repeater-fields">
                  <?php if (!empty($financial_items)) : ?>
                    <?php foreach ($financial_items as $item) : ?>
                          <div class="mb-3">
                              <input
                              type="text"
                              aria-label="Asset Item <?php echo $item['id']; ?>"
                              class="form-control"
                              id="asset-item-<?php echo $item['id']; ?>" name="assets[]"
                              placeholder="Asset <?php echo $item['id']; ?>"
                              value="<?php echo $item['title']; ?>"
                              >
                          </div>
                    <?php endforeach; ?>
                  <?php else : ?>
                      <div class="mb-3">
                          <input
                          type="text"
                          aria-label="Asset Item 1"
                          class="form-control"
                          id="asset-item-1" name="assets[]"
                          placeholder="Asset 1"
                          >
                      </div>
                  <?php endif; ?>
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