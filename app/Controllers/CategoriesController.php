<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

// class CategoriesController extends BaseController
// {
//     public function index()
//     {
//         return view('dashboard/categories');
//     }
// }

class CategoriesController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }

    // show the page
    public function index()
    {
        return view('dashboard/categories');
    }

    // return json list
    public function list()
    {
        $data = $this->model->orderBy('id', 'DESC')->findAll();
        $base = base_url('/uploads/categories/');
        $payload = array_map(function ($row) use ($base) {
            $row['image_url'] = $row['image'] ? $base . $row['image'] : null;
            return $row;
        }, $data);

        return $this->response->setJSON(['status' => true, 'data' => $payload]);
    }

    // get single
    public function get($id = null)
    {
        $row = $this->model->find($id);
        if (!$row) return $this->response->setJSON(['status' => false, 'message' => 'Not found']);
        $row['image_url'] = $row['image'] ? base_url('/uploads/categories/' . $row['image']) : null;
        return $this->response->setJSON(['status' => true, 'data' => $row]);
    }

    // store new
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]'
        ];

        if (! $this->validate($rules)) {
            return $this->response->setJSON(['status' => false, 'message' => $this->validator->getErrors()]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        // handle image
        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $uploadPath = FCPATH . 'uploads/categories/';
            if (! is_dir($uploadPath)) mkdir($uploadPath, 0755, true);
            $img->move($uploadPath, $newName);
            $data['image'] = $newName;
        }

        $id = $this->model->insert($data, true);
        if ($id) return $this->response->setJSON(['status' => true, 'message' => 'Created', 'id' => $id]);
        return $this->response->setJSON(['status' => false, 'message' => 'Insert failed']);
    }

    // update
    public function update()
    {
        $id = $this->request->getPost('id');
        $row = $this->model->find($id);
        if (! $row) return $this->response->setJSON(['status' => false, 'message' => 'Not found']);

        $rules = ['name' => 'required|min_length[2]'];
        if (! $this->validate($rules)) return $this->response->setJSON(['status' => false, 'message' => $this->validator->getErrors()]);

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description')
        ];

        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $uploadPath = FCPATH . 'uploads/categories/';
            if (! is_dir($uploadPath)) mkdir($uploadPath, 0755, true);
            $img->move($uploadPath, $newName);
            // delete old image if exists
            if (! empty($row['image']) && file_exists($uploadPath . $row['image'])) {
                @unlink($uploadPath . $row['image']);
            }
            $data['image'] = $newName;
        }

        if ($this->model->update($id, $data)) return $this->response->setJSON(['status' => true, 'message' => 'Updated']);
        return $this->response->setJSON(['status' => false, 'message' => 'Update failed']);
    }

    // delete
    public function delete($id = null)
    {
        $row = $this->model->find($id);
        if (! $row) return $this->response->setJSON(['status' => false, 'message' => 'Not found']);

        $uploadPath = FCPATH . 'uploads/categories/';
        if (! empty($row['image']) && file_exists($uploadPath . $row['image'])) {
            @unlink($uploadPath . $row['image']);
        }

        if ($this->model->delete($id)) return $this->response->setJSON(['status' => true, 'message' => 'Deleted']);
        return $this->response->setJSON(['status' => false, 'message' => 'Delete failed']);
    }
}