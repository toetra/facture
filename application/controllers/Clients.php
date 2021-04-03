<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Clients extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function is used to load the user list
     */
    function index()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->client_model->clientListingCount($searchText);

			$returns = $this->paginationCompress ( "clients", $count, 10 );
            
            $data['clientsRecords'] = $this->client_model->clientListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Liste des clients';
            
//pre($data);

            $this->loadViews("pages/clients/clients", $this->global, $data, NULL);
        }
    }
}

?>