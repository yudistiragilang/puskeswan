<?php

namespace App\Controllers;

use App\Models\BreedsModel;

class BreedsController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $breedsModel;
    public function __construct()
    {
        $this->breedsModel = new BreedsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Breeds',
            'breeds' => $this->breedsModel->getBreeds(10, 'breeds'),
            'pager' => $this->breedsModel->pager,
        ];

        return view('manage/breeds', $data);
    }

    public function createBreed()
    {
        if (!$this->validate([
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Breed description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'breed'  => $this->request->getVar('description'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->breedsModel->addBreed($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Breed failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Breed added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateBreed()
    {
        if (!$this->validate([
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Breed description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_breed');
            $data = array(
                'breed'  => $this->request->getVar('description'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->breedsModel->updateBreed($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Breed failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Breed successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteBreed()
    {
        $id = $this->request->getVar('id_breed');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->breedsModel->updateBreed($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Breed failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Breed successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
