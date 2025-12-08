<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Items List</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/items/create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Item
        </a>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="60">#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Added By</th>
                        <th width="150" class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($items)) : ?>
                        <?php $sr = 1; ?>
                        <?php foreach ($items as $item) : ?>
                            <tr>
                                <td><?= $sr++ ?></td>
                                <td><?= esc($item['title']) ?></td>
                                <td><?= esc($item['description']) ?></td>
                                <td><?= esc($item['username']) ?></td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="/items/edit/<?= $item['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="/items/delete/<?= $item['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete this item?')"
                                           data-bs-toggle="tooltip" 
                                           title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center">No items found. <a href="/items/create">Add your first item</a></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Enable Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
<?= $this->endSection() ?>