<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>


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
                            <th>ID</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach($inventory as $item): ?>
                        <tr>
                            <td><?= $item['id']; ?></td>
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





