<?php

namespace App\Controllers;

use App\Models\PetTypesModel;

class PetTypesController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $petTypesModel;
    public function __construct()
    {
        $this->petTypesModel = new PetTypesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Pet Types',
            'pet_types' => $this->petTypesModel->getPetTypes(10, 'pet_types'),
            'pager' => $this->petTypesModel->pager,
        ];

        return view('manage/pet_types', $data);
    }

    public function createPetType()
    {
        if (!$this->validate([
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pet types description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'description'  => $this->request->getVar('description'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->petTypesModel->addPetType($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Pet type failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Pet type added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updatePetType()
    {
        if (!$this->validate([
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pet types description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_pet_type');
            $data = array(
                'description'  => $this->request->getVar('description'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->petTypesModel->updatePetType($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Pet type failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Pet type successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deletePetType()
    {
        $id = $this->request->getVar('id_pet_type');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        // $result = $this->petTypesModel->deletePetType($id, $data);
        $result = $this->petTypesModel->updatePetType($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Pet type failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Pet type successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
