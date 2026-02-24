<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DepartmentModel;

class DepartmentController extends BaseController
{
    protected $deptModel;

    
        public function __construct()
        {
            $this->deptModel = new DepartmentModel();
            if (session()->get('role') !== 'admin') {
                header('Location: /login');
                exit;
            }
        }

        public function index()
        {
            $data['departments'] = $this->deptModel->findAll();
            return view('departments/index', $data);
        }

        public function create()
        {
            return view('departments/create');
        }

        public function store()
        {
            $this->deptModel->save([
                'department_name' => $this->request->getPost('department_name')
            ]);
            return redirect()->to('/departments');
        }

        public function edit($id)
        {
            $data['department'] = $this->deptModel->find($id);
            return view('departments/edit', $data);
        }

        public function update($id)
        {
            $this->deptModel->update($id, [
                'department_name' => $this->request->getPost('department_name')
            ]);
            return redirect()->to('/departments');
        }

        public function delete($id)
        {
            $this->deptModel->delete($id);
            return redirect()->to('/departments');
        }
}
