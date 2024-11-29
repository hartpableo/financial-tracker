<?php
$helper = new core\Helpers();
$router = new core\Router();
$financialTracker = new app\controllers\FinancialTrackerController();
$helper->templatePart('header', ['title' => $args['title']]);
?>

    <div class="container pt-5">
        <h1 class="sr-only"><?php echo $args['title']; ?></h1>

        <div class="mb-5">
            <div class="table-responsive" style="max-width: 500px;">
                <table class="table align-middle">
                    <tr>
                        <th>Total Monthly Liabilities</th>
                        <td><?php echo $financialTracker->getTotalMonthlyLiabilities(); ?></td>
                    </tr>
                    <tr>
                        <th>Total Remaining Cash</th>
                        <td><?php echo $financialTracker->getTotalRemainingCash(); ?></td>
                    </tr>
                    <tr>
                        <th>Available weekly Budget</th>
                        <td><?php echo $financialTracker->getAvailableWeeklyBudget(); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <form action="<?php echo $router->route('add-item'); ?>" class="row w-100" method="post">
            <div class="col-12 col-md-6">
              <?php $helper->templatePart('assets'); ?>
            </div>
            <div class="col-12 col-md-6">
              <?php $helper->templatePart('liabilities'); ?>
            </div>
        </form>
    </div>

<?php
$helper->templatePart('footer');