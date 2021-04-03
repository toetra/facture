<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Articles extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article_model');
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
            
            $count = $this->article_model->articleListingCount($searchText);

            $returns = $this->paginationCompress ( "articles", $count, 10 );
            
            $data['articleRecords'] = $this->article_model->articleListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Liste des articles';
            
//pre($data);

            $this->loadViews("pages/article/article", $this->global, $data, NULL);
        }
    }
    function getArticle()
    {
        if($this->isAdmin() == TRUE)
        {
            echo json_encode(array("status"=>0));
        }
        else
        {        
            $data['status'] = 1;
            $data['data'] = $this->article_model->allArticle();

            echo json_encode($data);
        }
    }
}

?>