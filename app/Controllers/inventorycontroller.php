<?php
namespace App\Controllers;

use App\Models\InventoryModel;

class inventorycontroller extends BaseController
{
    // ============================
    // 1. SHOW INVENTORY LIST
    // ============================
    public function index()
    {
        $model = new InventoryModel();
        $data['inventory'] = $model->findAll();
        return view('inventory/index1', $data);
    }

    // ============================
    // 2. ADD PAGE
    // ============================
    public function create()
    {
        return view('inventory/create');
    }

    // ============================
    // 3. INSERT NEW PRODUCT
    // ============================
    public function store()
    {
        $model = new InventoryModel();

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'quantity'     => $this->request->getPost('quantity'),
            'price'        => $this->request->getPost('price')
        ];

        $model->insert($data);

        return redirect()->to('/inventory')->with('success', 'Product Added Successfully');
    }

    // ============================
    // 4. EDIT PAGE
    // ============================
    public function edit($id)
    {
        $model = new InventoryModel();
        $data['item'] = $model->find($id);

        return view('inventory/edit', $data);
    }

    // ============================
    // 5. UPDATE PRODUCT
    // ============================
    public function update($id)
    {
        $model = new InventoryModel();

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'quantity'     => $this->request->getPost('quantity'),
            'price'        => $this->request->getPost('price')
        ];

        $model->update($id, $data);

        return redirect()->to('/inventory')->with('success', 'Product Updated Successfully');
    }

    // ============================
    // 6. DELETE PRODUCT
    // ============================
    public function delete($id)
    {
        $model = new InventoryModel();
        $model->delete($id);

        return redirect()->to('/inventory')->with('success', 'Product Deleted Successfully');
    }
}
