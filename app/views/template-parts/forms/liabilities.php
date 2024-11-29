<?php
$helper = new \core\Helpers();
$router = new core\Router();
$finalcial_tracker = new app\controllers\FinancialTrackerController();
$liabilities = $finalcial_tracker->getAllLiabilities();
?>

<form action="<?php echo $router->route('add-item'); ?>" method="post" data-slot="main-form">
  <h2>Liabilities</h2>
  <input type="hidden" name="type" value="liability">
  <div data-slot="repeater-fields">
    <?php if (!empty($liabilities)) : ?>
      <?php foreach ($liabilities as $key => $item) : ?>
        <div class="mb-3 d-flex justify-content-start align-items-stretch" data-slot="field-wrapper">
          <input
            type="text"
            aria-label="Liability Item <?php echo $item['id']; ?>"
            class="form-control"
            id="liability-<?php echo $item['id']; ?>"
            name="liabilities[<?php echo $key; ?>][title]"
            placeholder="Liability <?php echo $item['id']; ?>"
            value="<?php echo $item['title']; ?>"
            data-item="<?php echo $key; ?>"
          >
          <input aria-label="Amount" type="text" placeholder="Amount" name="liabilities[<?php echo $key; ?>][amount]" value="<?php echo $item['amount']; ?>">
          <button type="button" aria-label="Remove item <?php echo $key; ?>" class="js-remove-item fw-bold text-danger">X</button>
        </div>
      <?php endforeach; ?>
<!--    --><?php //else : ?>
<!--      <div class="mb-3 d-flex justify-content-start align-items-stretch" data-slot="field-wrapper">-->
<!--        <input-->
<!--          type="text"-->
<!--          aria-label="Liability Item 1"-->
<!--          class="form-control"-->
<!--          id="liability-1"-->
<!--          name="liabilities[1][title]"-->
<!--          data-item="1"-->
<!--        >-->
<!--        <input aria-label="Amount" type="text" placeholder="Amount" name="liabilities[1][amount]">-->
<!--        <button type="button" aria-label="Remove item 1" class="fw-bold text-danger">X</button>-->
<!--      </div>-->
    <?php endif; ?>
  </div>
  <div class="mb-3">
    <button type="button" class="js-add-item fw-bold" aria-label="Add liability item" data-item-type="liability">
      +
    </button>
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
</form>
