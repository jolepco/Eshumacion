<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Salvoconducto extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    /**
     * [__construct description]
     *
     * @method __construct
     */
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * [index description]
     *
     * @method index
     *
     * @return [type] [description]
     */
	 
	public function index()
	{
        redirect('https://covid19.saludcapital.gov.co/index.php/salvoconducto', 'refresh');
		exit;
	}
	
}
