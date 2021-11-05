<?php

namespace App\Controllers;

use App\Models\DiseasesModel;

class DiseasesController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $diseasesModel;
    public function __construct()
    {
        $this->diseasesModel = new DiseasesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Disease',
            'diseases' => $this->diseasesModel->getDiseases(10, 'diseases'),
            'pager' => $this->diseasesModel->pager,
        ];

        return view('manage/diseases', $data);
    }

    public function createDisease()
    {
        if (!$this->validate([
            'disease' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Disease description cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'disease'  => $this->request->getVar('disease'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->diseasesModel->addDisease($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Disease failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Disease added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateDisease()
    {
        if (!$this->validate([
            'disease' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Disease description cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_disease');
            $data = array(
                'disease'  => $this->request->getVar('disease'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->diseasesModel->updateDisease($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Disease failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Disease successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteDisease()
    {
        $id = $this->request->getVar('id_disease');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->diseasesModel->updateDisease($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Disease failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Disease successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
