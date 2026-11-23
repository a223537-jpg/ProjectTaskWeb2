<?php
ob_start();
$order = $order ?? [];
?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">Invoice</h2>
            <p class="text-muted mb-0">Order #<?= htmlspecialchars($order['fld_order_num']) ?></p>
        </div>
        <button type="button" onclick="window.print();" class="btn btn-primary">
            <i class="bi bi-printer me-1"></i>Print
        </button>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col">
                <h4 class="mb-1">Lumière Soap House</h4>
                <p class="text-muted mb-0">Sales Invoice</p>
            </div>
            <div class="col text-end">
                <strong>Invoice No.:</strong> <?= htmlspecialchars($order['fld_order_num']) ?><br>
                <strong>Date:</strong> <?= htmlspecialchars($order['fld_order_date']) ?>
            </div>
        </div>

        <hr>

        <div class="row mb-4">
            <div class="col">
                <strong>Customer</strong><br>
                <?= htmlspecialchars($order['fld_customer_name'] ?? $order['fld_customer_num']) ?><br>
                <?= htmlspecialchars($order['fld_customer_phone'] ?? '') ?>
            </div>
            <div class="col text-end">
                <strong>Staff</strong><br>
                <?= htmlspecialchars($order['fld_staff_name'] ?? $order['fld_staff_num']) ?><br>
                <?= htmlspecialchars($order['fld_staff_email'] ?? '') ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $grandTotal = 0; $count = 1; ?>
                    <?php if (!empty($details)): ?>
                        <?php foreach ($details as $detail): ?>
                            <?php
                            $lineTotal = (float) ($detail['fld_product_price'] ?? 0) * (int) $detail['fld_order_detail_quantity'];
                            $grandTotal += $lineTotal;
                            ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($detail['fld_product_name'] ?? $detail['fld_product_num']) ?></td>
                                <td>$<?= number_format((float) ($detail['fld_product_price'] ?? 0), 2) ?></td>
                                <td><?= htmlspecialchars($detail['fld_order_detail_quantity']) ?></td>
                                <td class="text-end">$<?= number_format($lineTotal, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No products in this order</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Grand Total</th>
                        <th class="text-end">$<?= number_format($grandTotal, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <a href="<?= BASE_URL ?>orderdetailcontroller/index/<?= htmlspecialchars($order['fld_order_num']) ?>" class="btn btn-secondary mt-3">
            <i class="bi bi-arrow-left me-1"></i>Back to Details
        </a>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>