<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Edit Product</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url ('inventory/update/'.$item['id']); ?>" method="post">

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="product_name" 
                           value="<?= $item ['product_name']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-control" name="quantity" 
                           value="<?= $item['quantity']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" 
                           value="<?= $item['price']; ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?= base_url('inventory'); ?>" class="btn btn-secondary">Cancel</a>

            </form>

        </div>

        
    </div>
</div>

<?= $this->endSection() ?>