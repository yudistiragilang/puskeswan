<?php

namespace App\Controllers;

use App\Models\MedicinesModel;

class MedicinesController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $medicinesModel;
    public function __construct()
    {
        $this->medicinesModel = new MedicinesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Medicines',
            'medicines' => $this->medicinesModel->getMedicines(10, 'medicines'),
            'pager' => $this->medicinesModel->pager,
        ];

        return view('manage/medicines', $data);
    }

    public function createMedicine()
    {
        if (!$this->validate([
            'medicine' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Medicine description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'medicine'  => $this->request->getVar('medicine'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->medicinesModel->addMedicine($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Medicine failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Medicine added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateMedicine()
    {
        if (!$this->validate([
            'medicine' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Medicine description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_medicine');
            $data = array(
                'medicine'  => $this->request->getVar('medicine'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->medicinesModel->updateMedicine($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Medicine failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Medicine successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteMedicine()
    {
        $id = $this->request->getVar('id_medicine');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->medicinesModel->updateMedicine($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Medicine failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Medicine successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
