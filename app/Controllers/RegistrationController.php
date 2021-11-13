<?php

namespace App\Controllers;

use App\Models\RegistrationModel;

class RegistrationController extends BaseController
{

    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $registrationModel;

    public function __construct()
    {
        $this->registrationModel = new RegistrationModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Check Registration',
            'owners' => $this->getOwners(),
        ];

        return view('transaction/registration', $data);
    }
}
