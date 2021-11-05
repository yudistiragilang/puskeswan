<?php

namespace App\Controllers;

use App\Models\ToolsModel;

class ToolsController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $toolsModel;
    public function __construct()
    {
        $this->toolsModel = new ToolsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Medical Devices',
            'tools' => $this->toolsModel->getTools(10, 'tools'),
            'pager' => $this->toolsModel->pager,
        ];

        return view('manage/tools', $data);
    }

    public function createTool()
    {
        if (!$this->validate([
            'tool' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tool description cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'tool'  => $this->request->getVar('tool'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->toolsModel->addTool($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Tool failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Tool added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateTool()
    {
        if (!$this->validate([
            'tool' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tool description cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_tool');
            $data = array(
                'tool'  => $this->request->getVar('tool'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->toolsModel->updateTool($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Tool failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Tool successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteTool()
    {
        $id = $this->request->getVar('id_tool');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->toolsModel->updateTool($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Tool failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Tool successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
