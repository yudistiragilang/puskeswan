<?php

namespace App\Controllers;

use App\Models\OwnersModel;

class OwnersController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    protected $ownersModel;
    public function __construct()
    {
        $this->ownersModel = new OwnersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Owners',
            'owners' => $this->ownersModel->getOwners(10, 'owners'),
            'pager' => $this->ownersModel->pager,
        ];

        return view('manage/owners', $data);
    }

    public function createOwner()
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
                    'required' => 'Owner name can not be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Owner address can not be empty !'
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

            $cek_nik = $this->cekNikAvailable($this->request->getVar('nik'), ST_OWNERS);
            if ($cek_nik) {
                session()->setFlashdata('nik_ada', "NIK already registered !");
                return redirect()->back()->withInput();
            }

            $data = array(
                'nik'  => $this->request->getVar('nik'),
                'owner_name'  => $this->request->getVar('nama'),
                'owner_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->ownersModel->addOwner($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Owner failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Owner added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateOwner()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Owner name can not be empty !'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Owner address can not be empty !'
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

            $id_owners = $this->request->getVar('id_owner');
            $data = array(
                'owner_name'  => $this->request->getVar('nama'),
                'owner_address'  => $this->request->getVar('alamat'),
                'phone'  => $this->request->getVar('telepon'),
                'gander'  => $this->request->getVar('gander'),
                'bird_date'  => $this->request->getVar('bird_date'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->ownersModel->updateOwner($id_owners, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Owner failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Owner updated successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteOwner()
    {
        $id_owners = $this->request->getVar('id_owner');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->ownersModel->updateOwner($id_owners, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Owner failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Owner deleted successfully !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
