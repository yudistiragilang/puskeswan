<?php

namespace App\Controllers;

use App\Models\StaffsModel;

class StaffsController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    protected $staffsModel;
    public function __construct()
    {
        $this->staffsModel = new StaffsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Staffs',
            'staffs' => $this->staffsModel->getStaffs(10, 'staffs'),
            'pager' => $this->staffsModel->pager,
        ];

        return view('manage/staffs', $data);
    }

    public function createStaff()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|min_length[16]',
                'errors' => [
                    'required' => 'NIK cannot be empty !',
                    'min_length' => 'NIK must consist of 16 numbers !'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Staff name cannot be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Staff address cannot be empty !'
                ]
            ],
            'gander' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gander cannot be empty !'
                ]
            ],
            'telepon' => [
                'rules' => 'required|min_length[11]|numeric',
                'errors' => [
                    'required' => 'Telepone cannot be empty !',
                    'min_length' => 'Telepone must be more than 11 numbers !',
                    'numeric' => 'Telepone flow in the form of numbers !'
                ]
            ],
            'bird_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bird date cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $cek_nik = $this->cekNikAvailable($this->request->getVar('nik'), ST_STAFFS);
            if ($cek_nik) {
                session()->setFlashdata('nik_ada', "NIK already registered !");
                return redirect()->back()->withInput();
            }

            $data = array(
                'nik'  => $this->request->getVar('nik'),
                'staff_name'  => $this->request->getVar('nama'),
                'staff_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->staffsModel->addStaff($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Staff failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Staff added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateStaff()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Staff name cannot be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Staff address cannot be empty !'
                ]
            ],
            'gander' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gander cannot be empty !'
                ]
            ],
            'telepon' => [
                'rules' => 'required|min_length[11]|numeric',
                'errors' => [
                    'required' => 'Telepone cannot be empty !',
                    'min_length' => 'Telepone must be more than 11 numbers !',
                    'numeric' => 'Telepone flow in the form of numbers !'
                ]
            ],
            'bird_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bird date cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $id_staff = $this->request->getVar('id_staff');
            $data = array(
                'staff_name'  => $this->request->getVar('nama'),
                'staff_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->staffsModel->updateStaff($id_staff, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Staff failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Staff updated successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteStaff()
    {
        $id_staff = $this->request->getVar('id_staff');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->staffsModel->updateStaff($id_staff, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Staff failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Staff deleted successfully !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
