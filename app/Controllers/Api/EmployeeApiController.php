<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;

class EmployeeApiController extends BaseController
{
    use ResponseTrait;
    protected $model;

    protected $modelName = 'App\Models\EmployeeModel';
    protected $format    = 'json';

    public function __construct()
    {
        $this->model = new EmployeeModel();
    }

    public function index()
    {
        $data = $this->model->getAllEmployees();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->select('employees.*, users.name, users.email')
                            ->join('users', 'users.id = employees.user_id')
                            ->find($id);

        if (!$data) {
            return $this->failNotFound('Pegawai tidak ditemukan.');
        }

        return $this->respond($data, 200);
    }

    public function create()
    {
        $json = $this->request->getJSON();

        $userModel = new \App\Models\UserModel();
        
        $userData = [
            'name'     => $this->request->getVar('name'),
            'email'    => $this->request->getVar('email'),
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'role'     => 'pegawai'
        ];
        
        $userModel->save($userData);
        $userId = $userModel->getInsertID();

        $empData = [
            'user_id'       => $userId,
            'nip'           => $this->request->getVar('nip'),
            'department_id' => $this->request->getVar('department_id'),
            'position_id'   => $this->request->getVar('position_id'),
            'salary'        => $this->request->getVar('salary'),
            'gender'        => $this->request->getVar('gender'),
            'photo'         => 'default.png'
        ];

        if ($this->model->save($empData)) {
            return $this->respondCreated([
                'status'  => 'success',
                'message' => 'Pegawai berhasil ditambah via Raw JSON'
            ]);
        }

        return $this->fail($this->model->errors());
    }

    public function update($id = null)
    {
        $input = $this->request->getRawInput();
        
        if ($this->model->update($id, $input)) {
            return $this->respond(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        }

        return $this->fail('Gagal update data.');
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $userModel = new \App\Models\UserModel();
            $userModel->delete($data['user_id']);
            return $this->respondDeleted(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }
        
        return $this->failNotFound('Data tidak ditemukan.');
    }
}
