<?php

namespace App\Controllers;

use App\Models\RolesModel;

class RolesController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $rolesModel;
    public function __construct()
    {
        $this->rolesModel = new RolesModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Roles',
            'roles' => $this->rolesModel->getRoles(10, 'roles'),
            'pager' => $this->rolesModel->pager,
        ];

        return view('manage/roles', $data);
    }

    public function createRole()
    {
        if (!$this->validate([
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role description cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'role'  => $this->request->getVar('role'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->rolesModel->addRole($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Role failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Role added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateRole()
    {
        if (!$this->validate([
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_role');
            $data = array(
                'role'  => $this->request->getVar('role'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->rolesModel->updateRole($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Role failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Role successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteRole()
    {
        $id = $this->request->getVar('id_role');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->rolesModel->updateRole($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Role failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Role successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
