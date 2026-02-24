<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PositionModel;

class PositionController extends BaseController
{
    protected $posModel;

    public function __construct()
    {
        $this->posModel = new PositionModel();
    
        if (session()->get('role') !== 'admin') {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $data['positions'] = $this->posModel->findAll();
        return view('positions/index', $data);
    }

    public function create()
    {
        return view('positions/create');
    }

    public function store()
    {
        $this->posModel->save([
            'position_name' => $this->request->getPost('position_name')
        ]);
        return redirect()->to('/positions');
    }

    public function edit($id)
    {
        $data['position'] = $this->posModel->find($id);
        return view('positions/edit', $data);
    }

    public function update($id)
    {
        $this->posModel->update($id, [
            'position_name' => $this->request->getPost('position_name')
        ]);
        return redirect()->to('/positions');
    }

    public function delete($id)
    {
        $this->posModel->delete($id);
        return redirect()->to('/positions');
    }
}