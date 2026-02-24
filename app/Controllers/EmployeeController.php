<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\PositionModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class EmployeeController extends BaseController
{
    protected $empModel;
    protected $userModel;
    protected $deptModel;
    protected $posModel;

    public function __construct()
    {
        $this->empModel  = new EmployeeModel();
        $this->userModel = new UserModel();
        $this->deptModel = new DepartmentModel();
        $this->posModel  = new PositionModel();

        if (session()->get('role') !== 'admin') {
            header('Location: /login');
            exit;
        }
    }

    public function index()
    {
        $data['employees'] = $this->empModel->getAllEmployees();
        return view('employees/index', $data);
    }

    public function create()
    {
        $data['departments'] = $this->deptModel->findAll();
        $data['positions']   = $this->posModel->findAll();
        return view('employees/create', $data);
    }

    public function store()
    {
        $rules = [
            'email' => 'required|valid_email|is_unique[users.email]', 
            'nip'   => 'required|is_unique[employees.nip]',
            'photo' => 'permit_empty|max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]' 
        ];

        $messages = [
            'email' => [
                'is_unique' => 'Maaf, Email tersebut sudah terdaftar!',
                'valid_email' => 'Format email tidak valid.'
            ],
            'nip' => [
                'is_unique' => 'Maaf, NIP tersebut sudah digunakan oleh pegawai lain!'
            ],
            'photo' => [
                'is_image' => 'File yang diupload harus berupa gambar.',
                'mime_in' => 'Format gambar hanya boleh JPG, JPEG, atau PNG.',
                'max_size' => 'Ukuran gambar maksimal 2MB.'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $foto = $this->request->getFile('photo');
        $namaFoto = 'default.png'; 
        
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName(); 
            $foto->move(ROOTPATH . 'public/uploads/employees', $namaFoto); 
        }

        $this->userModel->save([
            'name'     => $this->request->getPost('name'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash('123456', PASSWORD_DEFAULT), 
            'role'     => 'pegawai'
        ]);
        
        $userId = $this->userModel->getInsertID(); 

        $this->empModel->save([
            'user_id'       => $userId,
            'nip'           => $this->request->getPost('nip'),
            'department_id' => $this->request->getPost('department_id'),
            'position_id'   => $this->request->getPost('position_id'),
            'gender'        => $this->request->getPost('gender'),     
            'phone'         => $this->request->getPost('phone'),       
            'address'       => $this->request->getPost('address'),     
            'salary'        => $this->request->getPost('salary'),
            'photo'         => $namaFoto,
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/employees');
    }

    public function edit($id)
    {
        $data['employee']    = $this->empModel->select('employees.*, users.name, users.email')
                                              ->join('users', 'users.id = employees.user_id')
                                              ->find($id);
        
        $data['departments'] = $this->deptModel->findAll();
        $data['positions']   = $this->posModel->findAll();

        return view('employees/edit', $data);
    }

    public function update($id)
    {
        $employee = $this->empModel->find($id);
        $userId   = $employee['user_id'];

        $rules = [
            'email' => "required|valid_email|is_unique[users.email,id,$userId]",
            'nip'   => "required|is_unique[employees.nip,id,$id]",
            'photo' => 'permit_empty|max_size[photo,2048]|is_image[photo]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $foto = $this->request->getFile('photo');
        $namaFoto = $employee['photo'];

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFoto = $foto->getRandomName();
            $foto->move(ROOTPATH . 'public/uploads/employees', $namaFoto);

            if ($employee['photo'] != 'default.png' && file_exists(ROOTPATH . 'public/uploads/employees/' . $employee['photo'])) {
                unlink(ROOTPATH . 'public/uploads/employees/' . $employee['photo']);
            }
        }

        $this->userModel->update($userId, [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email')
        ]);

        $this->empModel->update($id, [
            'nip'           => $this->request->getPost('nip'),
            'department_id' => $this->request->getPost('department_id'),
            'position_id'   => $this->request->getPost('position_id'),
            'gender'        => $this->request->getPost('gender'),
            'phone'         => $this->request->getPost('phone'),
            'address'       => $this->request->getPost('address'),
            'salary'        => $this->request->getPost('salary'),
            'photo'         => $namaFoto
        ]);

        return redirect()->to('/employees')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function delete($id)
    {
     
        $employee = $this->empModel->find($id);
        
        if ($employee['photo'] != 'default.png') {
            $path = ROOTPATH . 'public/uploads/employees/' . $employee['photo'];
            if (file_exists($path)) {
                unlink($path); 
            }
        }

        $this->userModel->delete($employee['user_id']);
        
        return redirect()->to('/employees');
    }
}
