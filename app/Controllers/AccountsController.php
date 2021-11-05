<?php

namespace App\Controllers;

use App\Models\AccountsModel;

class AccountsController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;

    protected $accountsModel;
    public function __construct()
    {
        $this->accountsModel = new AccountsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Accounts',
            'accounts' => $this->accountsModel->getAccounts(10, 'accounts'),
            'roles' => $this->getRoles(),
            'pager' => $this->accountsModel->pager,
        ];

        return view('manage/accounts', $data);
    }

    public function createAccount()
    {
        if (!$this->validate([
            'first_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'First name cannot be empty !'
                ]
            ],
            'last_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Last name cannot be empty !'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'E-mail cannot be empty !',
                    'valid_email' => 'E-mail invalid !'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password cannot be empty !',
                    'min_length' => 'Password minimum of eight characters !'
                ]
            ],
            're_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Password and repeat password not the same !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $cek = $this->cekEmailAvailable($this->request->getVar('email'));
            if ($cek) {
                session()->setFlashdata('email_ada', "E-mail already registered !");
                return redirect()->back()->withInput();
            }

            $data = array(
                'first_name'  => $this->request->getVar('first_name'),
                'last_name'  => $this->request->getVar('last_name'),
                'email'  => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->accountsModel->addAccount($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Account failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Account added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateAccount()
    {
        if (!$this->validate([
            'first_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'First name cannot be empty !'
                ]
            ],
            'last_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Last name cannot be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $id_account = $this->request->getVar('id_account');
            $data = array(
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'role' => $this->request->getVar('role'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->accountsModel->updateAccount($id_account, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Account failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Account updated successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteAccount()
    {
        $id_account = $this->request->getVar('id_account');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->accountsModel->updateAccount($id_account, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Account failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Account deleted successfully !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
