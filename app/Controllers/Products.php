<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class Products extends Controller
{
   public function index()
{
    $productModel = new ProductModel();

   $data['products'] = $productModel
    ->select('products.*, users.name as added_by')
    ->join('users', 'users.id = products.created_by', 'left')
    ->findAll();


    return view('products/index', $data);
}

    public function create()
    {
        return view('products/create');
    }

   public function store()
{
    $model = new ProductModel();

    $model->save([
        'title'       => $this->request->getPost('title'),
        'description' => $this->request->getPost('description'),
         'price'       => $this->request->getPost('price'),
        'created_by'  => session()->get('user_id') // ⚡ correct session key
    ]);

    return redirect()->to('/products')->with('success', 'Product added successfully');
}


    public function edit($id)
    {
        $model = new ProductModel();

        $data['product'] = $model->find($id);

        return view('products/edit', $data);
    }

    public function update($id)
    {
        $model = new ProductModel();

        $model->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
             'price'       => $this->request->getPost('price')
        ]);

        return redirect()->to('/products')->with('success', 'Product updated successfully');
    }

    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);

        return redirect()->to('/products')->with('success', 'Product deleted successfully');
    }   
}
