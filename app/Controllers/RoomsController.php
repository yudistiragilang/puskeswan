<?php

namespace App\Controllers;

use App\Models\RoomsModel;

class RoomsController extends BaseController
{
    /**
     * Instance of the main Request object.
     *
     * @var HTTP\IncomingRequest
     */
    protected $request;
    protected $roomsModel;
    public function __construct()
    {
        $this->roomsModel = new RoomsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Rooms',
            'rooms' => $this->roomsModel->getRooms(10, 'rooms'),
            'pager' => $this->roomsModel->pager,
        ];

        return view('manage/rooms', $data);
    }

    public function createRoom()
    {
        if (!$this->validate([
            'room' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {

            $data = array(
                'room'  => $this->request->getVar('room'),
                'created_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->roomsModel->addRoom($data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Room failed to add !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Room added successfully !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function updateRoom()
    {
        if (!$this->validate([
            'room' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Room description can not be empty !'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getVar('id_room');
            $data = array(
                'room'  => $this->request->getVar('room'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $result = $this->roomsModel->updateRoom($id, $data);
            if (!$result) {
                session()->setFlashdata('error_insert', 'Room failed to update !');
                unset($_POST);
                return redirect()->back()->withInput();
            } else {
                session()->setFlashdata('done_insert', 'Room successfully updated !');
                unset($_POST);
                return redirect()->back()->withInput();
            }
        }
    }

    public function deleteRoom()
    {
        $id = $this->request->getVar('id_room');
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s'),
        );

        $result = $this->roomsModel->updateRoom($id, $data);
        if (!$result) {
            session()->setFlashdata('error_insert', 'Room failed to delete !');
            unset($_POST);
            return redirect()->back()->withInput();
        } else {
            session()->setFlashdata('done_insert', 'Room successfully deleted !');
            unset($_POST);
            return redirect()->back()->withInput();
        }
    }
}
