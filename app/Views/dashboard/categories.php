<?php
// File: app/Views/dashboard/categories.php
// CodeIgniter 4 view for managing categories (list, add, edit, delete)
?>
<?= $this->extend('layouts/app') ?>


<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Categories</h1>
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">Add Category</button>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="categoriesTable">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- populated by JS -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal: Add / Edit -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="categoryForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="categoryId" value="">


                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>


                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>


                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        <div id="currentImagePreview" class="mt-2"></div>
                    </div>


                    <div id="formErrors" class="text-danger"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .confirm-box {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.5);
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}
.confirm-box.active {
  display: flex;
}
.confirm-content {
  background: #fff;
  padding: 20px;
  border-radius: 6px;
  width: 300px;
  text-align: center;
}
</style>

<div id="deleteConfirm" class="confirm-box">
  <div class="confirm-content">
    <p>Are you sure you want to delete?</p>
    <button id="confirmYes" class="btn btn-danger">Yes</button>
    <button id="confirmNo" class="btn btn-secondary">No</button>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// endpoints used by this page
const endpoints = {
  list: '<?= site_url('/dashboard/categories/list') ?>',
  store: '<?= site_url('/dashboard/categories/store') ?>',
  get: '<?= site_url('/dashboard/categories/get') ?>',
  update: '<?= site_url('/dashboard/categories/update') ?>',
  remove: '<?= site_url('/dashboard/categories/delete') ?>'
};

async function fetchCategories() {
  const res = await fetch(endpoints.list, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
  const data = await res.json();
  const tbody = document.querySelector('#categoriesTable tbody');
  tbody.innerHTML = '';
  if (data && data.data) {
    data.data.forEach(cat => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${cat.id}</td>
        <td>${escapeHtml(cat.name)}</td>
        <td>${escapeHtml(cat.description || '')}</td>
        <td>${cat.image ? `<img src="${cat.image_url}" alt="" style="height:48px;border-radius:4px;">` : ''}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary me-1" onclick="openEdit(${cat.id})">Edit</button>
          <button class="btn btn-sm btn-outline-danger" onclick="confirmDelete(${cat.id})">Delete</button>
        </td>
      `;
      tbody.appendChild(tr);
    });
  }
}

fetchCategories();

function escapeHtml(str) {
  if (!str) return '';
  return str.replace(/[&<>"']/g, function (tag) {
    const charsToReplace = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    };
    return charsToReplace[tag] || tag;
  });
}

// Add / Update submit
document.getElementById('categoryForm').addEventListener('submit', async function (e) {
  e.preventDefault();
  const form = e.target;
  const fd = new FormData(form);
  const id = fd.get('id');
  const url = id ? endpoints.update : endpoints.store;
  document.getElementById('saveBtn').disabled = true;
  document.getElementById('formErrors').textContent = '';

  try {
    const res = await fetch(url, {
      method: 'POST',
      body: fd,
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });
    const data = await res.json();
    if (data.status) {
      var modal = bootstrap.Modal.getInstance(document.getElementById('categoryModal'));
      modal.hide();
      form.reset();
      document.getElementById('currentImagePreview').innerHTML = '';
      await fetchCategories();
    } else {
      document.getElementById('formErrors').textContent = data.message || 'Validation failed';
    }
  } catch (err) {
    console.error(err);
    document.getElementById('formErrors').textContent = 'Request failed';
  } finally {
    document.getElementById('saveBtn').disabled = false;
  }
});

// Open edit modal and populate
async function openEdit(id) {
  document.getElementById('categoryModalLabel').textContent = 'Edit Category';
  const res = await fetch(endpoints.get + '/' + id, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
  const data = await res.json();
  if (data && data.status) {
    const cat = data.data;
    document.getElementById('categoryId').value = cat.id;
    document.getElementById('name').value = cat.name;
    document.getElementById('description').value = cat.description || '';
    const preview = document.getElementById('currentImagePreview');
    preview.innerHTML = cat.image_url ? `<img src="${cat.image_url}" style="max-height:80px;">` : '';
    const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
    modal.show();
  } else {
    alert('Failed to load category');
  }
}

// Reset modal when closed
document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function () {
  document.getElementById('categoryModalLabel').textContent = 'Add Category';
  document.getElementById('categoryForm').reset();
  document.getElementById('categoryId').value = '';
  document.getElementById('currentImagePreview').innerHTML = '';
  document.getElementById('formErrors').textContent = '';
});

// let deleteTargetId = null;
// function confirmDelete(id) {
//   deleteTargetId = id;
//   const dmodal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
//   dmodal.show();
// }

// document.getElementById('confirmDeleteBtn').addEventListener('click', async function () {
//     if (!deleteTargetId) return;
//     try {
//         const res = await fetch(endpoints.remove + '/' + deleteTargetId, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
//         const data = await res.json();
//         if (data.status) {
//         const dmodal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteModal'));
//         dmodal.hide();
//         await fetchCategories();
//         } else {
//         alert(data.message || 'Delete failed');
//         }
//     } catch (err) {
//         console.error(err);
//         alert('Request failed');
//     }
// });

let deleteTargetId = null;
const confirmBox = document.getElementById('deleteConfirm');

function confirmDelete(id) {
  deleteTargetId = id;
  confirmBox.classList.add('active');
}

document.getElementById('confirmNo').onclick = () => {
  deleteTargetId = null;
  confirmBox.classList.remove('active');
};

document.getElementById('confirmYes').onclick = async () => {
  if (!deleteTargetId) return;

  try {
    const res = await fetch(endpoints.remove + '/' + deleteTargetId, {
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    });

    const data = await res.json();

    if (data.status) {
      confirmBox.classList.remove('active');
      deleteTargetId = null;
      await fetchCategories();
    } else {
      alert(data.message || 'Delete failed');
    }
  } catch (err) {
    console.error(err);
    alert('Request failed');
  }
};

// initial load
// fetchCategories();
</script>
<?= $this->endSection() ?>