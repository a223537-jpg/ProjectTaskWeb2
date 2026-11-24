<?php
$registerDate = $acustomer['fld_customer_register_date'] ?? date('Y-m-d');
ob_start();
?>

<div class="card shadow border-0 border-start border-5 border-primary mb-4">
    <div class="card-body">
        <h2 class="mb-1">Customers</h2>
        <p class="text-muted mb-0">Manage and track all your customers</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <div class="row g-0 align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0">
                    <i class="bi bi-pencil-square text-primary me-2"></i>
                    <?= isset($acustomer) ? 'Edit Customer' : 'Customer Form' ?>
                </h5>
                <small class="text-muted">Fill in the details of a customer</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-primary">Required fields</span>
            </div>
        </div>
        
        <hr>

        <form action="<?= BASE_URL ?>customercontroller/<?= isset($acustomer) ? 'update' : 'save' ?>" method="post" class="needs-validation" novalidate>
            <div class="row g-3">
                <div class="col-md-3">
                    <label for="customer_num" class="form-label">Customer ID <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_num" id="customer_num" type="text" class="form-control" placeholder="Enter Customer ID" value="<?= htmlspecialchars($acustomer['fld_customer_num'] ?? '') ?>" required>
                </div>

                <div class="col-md-3">
                    <label for="customer_name" class="form-label">Name <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_name" id="customer_name" type="text" class="form-control" placeholder="Enter Customer Name" value="<?= htmlspecialchars($acustomer['fld_customer_name'] ?? '') ?>" required>
                </div>

                <div class="col-md-3">
                    <label for="customer_gender" class="form-label">Gender <span class="text-danger" aria-hidden="true">*</span></label>
                    <select name="customer_gender" id="customer_gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="Male" <?= (($acustomer['fld_customer_gender'] ?? '') == 'Male') ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= (($acustomer['fld_customer_gender'] ?? '') == 'Female') ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="customer_phone" class="form-label">Phone Number <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_phone" id="customer_phone" type="text" class="form-control" placeholder="Enter Phone Number" value="<?= htmlspecialchars($acustomer['fld_customer_phone'] ?? '') ?>" required>
                </div>

                <div class="col-md-3">
                    <label for="customer_register_date" class="form-label">Register Date <span class="text-danger" aria-hidden="true">*</span></label>
                    <input name="customer_register_date" id="customer_register_date" type="date" class="form-control" value="<?= htmlspecialchars($registerDate) ?>" required>
                </div>
            </div>
            
            <hr class="mt-4 mb-3">
            
            <div>
                <button type="submit" name="<?= isset($acustomer) ? 'update' : 'create' ?>" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i><?= isset($acustomer) ? 'Update' : 'Create' ?>
                </button>
                <button type="reset" class="btn btn-secondary">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>Clear
                </button>
                <?php if (isset($acustomer)): ?>
                    <input type="hidden" name="original_customer_num" value="<?= htmlspecialchars($acustomer['fld_customer_num'] ?? '') ?>">
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
  
        <div class="row align-items-center mb-3">
            <div class="col">
                <h5 class="mb-0"><i class="bi bi-table text-primary me-2"></i>Customer List</h5>
                <small class="text-muted">View and manage all registered customers</small>
            </div>
            <div class="col-auto">
                <span class="badge bg-success">Total: <?= count($customers ?? []) ?> items</span>
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Customer ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Register Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($customers)): ?>
                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= htmlspecialchars($customer['fld_customer_num']) ?></td>
                                <td><?= htmlspecialchars($customer['fld_customer_name']) ?></td>
                                <td><?= htmlspecialchars($customer['fld_customer_gender']) ?></td>
                                <td><?= htmlspecialchars($customer['fld_customer_phone']) ?></td>
                                <td><?= htmlspecialchars($customer['fld_customer_register_date']) ?></td>
                                <td>
                                    <a href="<?= BASE_URL ?>customercontroller/edit/<?= htmlspecialchars($customer['fld_customer_num']) ?>" class="btn btn-sm btn-warning" title="Edit customer"><i class="bi bi-pencil"></i></a>
                                    <a href="<?= BASE_URL ?>customercontroller/delete/<?= htmlspecialchars($customer['fld_customer_num']) ?>" class="btn btn-sm btn-danger" title="Delete customer" onclick="return confirm('Are you sure to delete this customer?');"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">No customers found</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once 'layout.php';
?>