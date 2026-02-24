<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\EmployeeModel;

class ProfileController extends BaseController
{
    public function __construct()
    {
        if (!session()->get('logged_in')) {
            header('Location: /login');
            exit;
        }
    }
    public function index()
    {
        $empModel = new EmployeeModel();
        
        $userId = session()->get('id');

        $data['pegawai'] = $empModel->select('employees.*, users.name, users.email, departments.department_name, positions.position_name')
            ->join('users', 'users.id = employees.user_id')
            ->join('departments', 'departments.id = employees.department_id', 'left')
            ->join('positions', 'positions.id = employees.position_id', 'left')
            ->where('employees.user_id', $userId)
            ->first();

        return view('profile/index', $data);
    }

    public function edit()
    {
        $empModel = new EmployeeModel();
        $userId = session()->get('id');

        $data['pegawai'] = $empModel->select('employees.*, users.name, users.email')
            ->join('users', 'users.id = employees.user_id')
            ->where('employees.user_id', $userId)
            ->first();

        return view('profile/edit', $data);
    }

    public function update()
    {
        $empModel = new EmployeeModel();
        $userModel = new \App\Models\UserModel();
        
        $userId = session()->get('id');
        $pegawai = $empModel->where('user_id', $userId)->first();

        $foto = $this->request->getFile('photo');
        $namaFoto = $pegawai['photo']; 
        
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/employees', $namaFoto);
            

            if ($pegawai['photo'] != 'default.png' && file_exists(ROOTPATH . 'public/uploads/employees/' . $pegawai['photo'])) {
                unlink(ROOTPATH . 'public/uploads/employees/' . $pegawai['photo']);
            }
        }

        $userModel->update($userId, [
            'name' => $this->request->getPost('name')
        ]);

        $empModel->update($pegawai['id'], [
            'gender'  => $this->request->getPost('gender'),
            'phone'   => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'photo'   => $namaFoto
        ]);

        session()->set('name', $this->request->getPost('name'));

        return redirect()->to('/profile');
    }
}
