<?php

namespace App\Controllers;

use App\Models\ItemModel;

class ItemsController extends BaseController
{
    public function index()
    {
        $itemModel = new ItemModel();

        $data['items'] = $itemModel
            ->select('items.*, users.name as username')
            ->join('users', 'users.id = items.user_id', 'left')   // 👈 left join
            ->findAll();

        return view('items/index', $data);
    }



    public function create()
    {
        return view('items/create');
    }

    public function store()
    {
        $itemModel = new ItemModel();

        $itemModel->save([
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'user_id' => session()->get('user_id'),
        ]);

        return redirect()->to('/items')->with('success', 'Item added successfully');
    }


    public function edit($id)
    {
        $itemModel = new ItemModel();
        $data['item'] = $itemModel->find($id);

        return view('items/edit', $data);
    }

    public function update($id)
    {
        $itemModel = new ItemModel();

        $itemModel->update($id, [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'user_id' => session()->get('user_id'),

        ]);

        return redirect()->to('/items')->with('success', 'Item updated successfully');
    }


    public function delete($id)
    {
        $itemModel = new ItemModel();
        $itemModel->delete($id);

        return redirect()->to('/items')->with('success', 'Item deleted successfully');
    }
}
