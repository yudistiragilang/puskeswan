<?php

namespace App\Controllers;

use App\Models\NursesModel;

class NursesController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    protected $nursesModel;
    public function __construct()
    {
        $this->nursesModel = new NursesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Nurses',
            'nurses' => $this->nursesModel->getNurses(10, 'nurses'),
            'pager' => $this->nursesModel->pager,
        ];

        return view('manage/nurses', $data);
    }

    public function createNurse()
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
                    'required' => 'Nurse name cannot be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nurse address cannot be empty !'
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

            $cek_nik = $this->cekNikAvailable($this->request->getVar('nik'), ST_NURSES);
            if ($cek_nik) {
                session()->setFlashdata('nik_ada', "NIK already registered !");
                return redirect()->back()->withInput();
            }

            $data = array(
                'nik'  => $this->request->getVar('nik'),
                'nurse_name'  => $this->request->getVar('nama'),
                'nurse_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->nursesModel->addNurse($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Nurse failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Nurse added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateNurse()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nurse name cannot be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nurse address cannot be empty !'
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

            $id_nurse = $this->request->getVar('id_nurse');
            $data = array(
                'nurse_name'  => $this->request->getVar('nama'),
                'nurse_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->nursesModel->updateNurse($id_nurse, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Nurse failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Nurse updated successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteNurse()
    {
        $id_nurse = $this->request->getVar('id_nurse');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->nursesModel->updateNurse($id_nurse, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Nurse failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Nurse deleted successfully !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
