<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Add New Item</h4>
        </div>

        <div class="card-body">
            <form action="<?= base_url('inventory/store'); ?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Save Item</button>
                <a href="<?= base_url('inventory'); ?>" class="btn btn-secondary">Back</a>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
