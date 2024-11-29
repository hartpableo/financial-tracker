<?php
$helper = new core\Helpers();
$router = new core\Router();
$financialTracker = new app\controllers\FinancialTrackerController();
$helper->templatePart('header', ['title' => $args['title']]);
?>

    <div class="container pt-5">
        <h1 class="sr-only"><?php echo $args['title']; ?></h1>

        <div class="row">
            <div class="col-12 col-md-6">
              <?php $helper->templatePart('forms/assets'); ?>
            </div>
            <div class="col-12 col-md-6">
              <?php $helper->templatePart('forms/liabilities'); ?>
            </div>
        </div>

        <div class="mt-5">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Total Monthly Liabilities</th>
                        <th>Total Remaining Cash</th>
                        <th>Available weekly Budget</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $financialTracker->getTotalMonthlyLiabilities(); ?></td>
                        <td><?php echo $financialTracker->getTotalRemainingCash(); ?></td>
                        <td><?php echo $financialTracker->getAvailableWeeklyBudget(); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
$helper->templatePart('footer');