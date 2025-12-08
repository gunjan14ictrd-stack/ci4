<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Item</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/items" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Items
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="/items/store" method="post">
            <?= csrf_field() ?>
            
            <!-- Title -->
            <div class="mb-3">
                <label for="title" class="form-label">Item Title</label>
                <input type="text" class="form-control" name="title" required 
                       placeholder="Enter item title" value="<?= old('title') ?>">
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Item Description</label>
                <textarea class="form-control" name="description" rows="4" required 
                          placeholder="Enter item description"><?= old('description') ?></textarea>
            </div>

            <!-- Buttons -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="/items" class="btn btn-secondary me-md-2">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Item
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>