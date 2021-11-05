<?php

namespace App\Controllers;

use App\Models\DoctorsModel;

class DoctorsController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    protected $doctorsModel;
    public function __construct()
    {
        $this->doctorsModel = new DoctorsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Doctors',
            'doctors' => $this->doctorsModel->getDoctors(10, 'doctors'),
            'pager' => $this->doctorsModel->pager,
        ];

        return view('manage/doctors', $data);
    }

    public function createDoctor()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|min_length[16]',
                'errors' => [
                    'required' => 'NIK can not be empty !',
                    'min_length' => 'NIK must consist of 16 numbers !'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Doctor name can not be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Doctor address can not be empty !'
                ]
            ],
            'gander' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gander can not be empty !'
                ]
            ],
            'telepon' => [
                'rules' => 'required|min_length[11]|numeric',
                'errors' => [
                    'required' => 'Telepone can not be empty !',
                    'min_length' => 'Telepone must be more than 11 numbers !',
                    'numeric' => 'Telepone flow in the form of numbers !'
                ]
            ],
            'bird_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bird date can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $cek_nik = $this->cekNikAvailable($this->request->getVar('nik'), ST_DOCTORS);
            if ($cek_nik) {
                session()->setFlashdata('nik_ada', "NIK already registered !");
                return redirect()->back()->withInput();
            }

            $data = array(
                'nik'  => $this->request->getVar('nik'),
                'dokter_name'  => $this->request->getVar('nama'),
                'dokter_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->doctorsModel->addDoctor($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Doctor failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Doctor added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateDoctor()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Doctor name can not be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Doctor address can not be empty !'
                ]
            ],
            'gander' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Gander can not be empty !'
                ]
            ],
            'telepon' => [
                'rules' => 'required|min_length[11]|numeric',
                'errors' => [
                    'required' => 'Telepone can not be empty !',
                    'min_length' => 'Telepone must be more than 11 numbers !',
                    'numeric' => 'Telepone flow in the form of numbers !'
                ]
            ],
            'bird_date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Bird date can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $id_doctor = $this->request->getVar('id_doctor');
            $data = array(
                'dokter_name'  => $this->request->getVar('nama'),
                'dokter_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->doctorsModel->updateDoctor($id_doctor, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Doctor failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Doctor updated successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteDoctor()
    {
        $id_doctor = $this->request->getVar('id_doctor');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->doctorsModel->updateDoctor($id_doctor, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Doctor failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Doctor deleted successfully !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
