<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Items List</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/inventory/create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Item
        </a>
    </div>
</div>

<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Inventory List</h4>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table id="inventoryTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach($inventory as $item): ?>
                        <tr>
                           
                            <td><?= $item['product_name']; ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td><?= $item['price']; ?></td>

                            <td>
                                <a href="<?= base_url('inventory/edit/'.$item['id']); ?>" 
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="<?= base_url('inventory/delete/'.$item['id']); ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure you want to delete this item?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<?= $this->endSection() ?>





