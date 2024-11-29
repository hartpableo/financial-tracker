<?php
$helper = new \core\Helpers();
$router = new core\Router();
$finalcial_tracker = new app\controllers\FinancialTrackerController();
$assets = $finalcial_tracker->getAllAssets();
?>

<div data-slot="main-form">
  <h2>Assets</h2>
  <div data-slot="repeater-fields">
    <?php foreach ($assets as $key => $item) : ?>
        <div class="mb-3 d-flex justify-content-start align-items-stretch" data-slot="field-wrapper">
            <input
                    type="text"
                    aria-label="Asset Item <?php echo $item['id']; ?>"
                    class="form-control"
                    id="asset-item-<?php echo $item['id']; ?>"
                    name="assets[<?php echo $key; ?>][title]"
                    placeholder="Asset <?php echo $item['id']; ?>"
                    value="<?php echo $item['title']; ?>"
                    data-item="<?php echo $key; ?>"
            >
            <input aria-label="Amount" type="text" placeholder="Amount" name="assets[<?php echo $key; ?>][amount]" value="<?php echo $item['amount']; ?>">
            <button type="button" aria-label="Remove item <?php echo $key; ?>" class="js-remove-item fw-bold text-danger">X</button>
        </div>
    <?php endforeach; ?>
  </div>
  <div class="mb-3">
    <button type="button" class="js-add-item fw-bold" aria-label="Add asset item" data-item-type="asset">
        +
    </button>
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
</div>
