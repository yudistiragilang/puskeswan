<?php

namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
	}

	public function cekEmailAvailable($email)
	{
		$db		= \Config\Database::connect();
		$builder = $db->table('accounts');
		$select	= $builder->select('email');
		$where = $select->where('email', $email);
		$hasil	= $where->countAllResults();

		if ($hasil > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function cekNikAvailable($nik, $type_user)
	{

		if ($type_user == ST_OWNERS) {
			$table = 'owners';
		} elseif ($type_user == ST_DOCTORS) {
			$table = 'doctors';
		} elseif ($type_user == ST_NURSES) {
			$table = 'nurses';
		} elseif ($type_user == ST_STAFFS) {
			$table = 'staffs';
		}

		$db		= \Config\Database::connect();
		$builder = $db->table($table);
		$select	= $builder->select('nik');
		$where = $select->where('nik', $nik);
		$hasil	= $where->countAllResults();

		if ($hasil > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getRoles()
	{
		$db		= \Config\Database::connect();
		$builder = $db->table('roles');
		$builder->select('id, role');
		$query   = $builder->get();
		return $query;
	}
}
