<?php

namespace App\Controllers;

use App\Models\PetsModel;

class PetsController extends BaseController
{

	/**
	 * Instance of the main Request object.
	 *
	 * @var HTTP\IncomingRequest
	 */
	protected $request;
	protected $petsModel;

	public function __construct()
	{
		$this->petsModel = new PetsModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Master Pets',
			'pets' => $this->petsModel->getPets(10, 'pets'),
			'owners' => $this->getOwners(),
			'pet_types' => $this->getPetTypes(),
			'breeds' => $this->getBreeds(),
			'pager' => $this->petsModel->pager,
		];

		return view('manage/pets', $data);
	}

	public function createPet()
	{

		if (!$this->validate([
			'pets_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Pet name cannot be empty !'
				]
			],
			'own_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Own name cannot be empty !'
				]
			],
			'pet_type' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Pet type cannot be empty !'
				]
			],
			'breed' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Breed cannot be empty !'
				]
			],
			'gander' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Gander cannot be empty !'
				]
			]
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		} else {

			$data = array(
				'pets_name' => $this->request->getVar('pets_name'),
				'pets_owner' => $this->request->getVar('own_name'),
				'pet_type' => $this->request->getVar('pet_type'),
				'breed' => $this->request->getVar('breed'),
				'gander' => $this->request->getVar('gander'),
				'created_at' => date('Y-m-d H:i:s'),
			);

			$result = $this->petsModel->addPet($data);
			if (!$result) {
				session()->setFlashdata('error_insert', 'Pet failed to add !');
				unset($_POST);
				return redirect()->back()->withInput();
			} else {
				session()->setFlashdata('done_insert', 'Pet added successfully !');
				unset($_POST);
				return redirect()->back()->withInput();
			}
		}
	}

	public function updatePet()
	{
		if (!$this->validate([
			'pets_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Pet name cannot be empty !'
				]
			],
			'own_name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Own name cannot be empty !'
				]
			],
			'pet_type' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Pet type cannot be empty !'
				]
			],
			'breed' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Breed cannot be empty !'
				]
			],
			'gander' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Gander cannot be empty !'
				]
			]
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		} else {
			$id = $this->request->getVar('id_pet');
			$data = array(
				'pets_name' => $this->request->getVar('pets_name'),
				'pets_owner' => $this->request->getVar('own_name'),
				'pet_type' => $this->request->getVar('pet_type'),
				'breed' => $this->request->getVar('breed'),
				'gander' => $this->request->getVar('gander'),
				'updated_at' => date('Y-m-d H:i:s'),
			);

			$result = $this->petsModel->updatePet($id, $data);
			if (!$result) {
				session()->setFlashdata('error_insert', 'Pet failed to update !');
				unset($_POST);
				return redirect()->back()->withInput();
			} else {
				session()->setFlashdata('done_insert', 'Pet updated successfully !');
				unset($_POST);
				return redirect()->back()->withInput();
			}
		}
	}

	public function deletePet()
	{
		$id = $this->request->getVar('id_pet');
		$data = array(
			'deleted_at' => date('Y-m-d H:i:s'),
		);

		$result = $this->petsModel->updatePet($id, $data);
		if (!$result) {
			session()->setFlashdata('error_insert', 'Pet failed to delete !');
			unset($_POST);
			return redirect()->back()->withInput();
		} else {
			session()->setFlashdata('done_insert', 'Pet deleted successfully !');
			unset($_POST);
			return redirect()->back()->withInput();
		}
	}
}
