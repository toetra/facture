<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Facture extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('client_model');
        $this->load->model('facture_model');
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
            
            $count = $this->facture_model->factureListingCount($searchText);

            $returns = $this->paginationCompress ( "facture", $count, 10 );
            
            $data['factureRecords'] = $this->facture_model->factureListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : Liste des facture';
            
            $this->loadViews("pages/facture/facture", $this->global, $data, NULL);
        }
    }

    function detail($id)
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
            
            $data['facture'] = $this->facture_model->factureOne($id);

            $data['detailRecords'] = $this->facture_model->detailFacture($id);
            
            $this->global['pageTitle'] = 'Détail facture';
            
            $this->loadViews("pages/facture/detail_facture", $this->global, $data, NULL);
        }
    }
    public function pdf($id) {   
        $nom_client = "";
        $adresse_client = "";
        $date_facture = "";
        $numero_facture = "";
        $stat_client = "";
        $nif_client = "";
        $mhtva = 0; // Montant hors tva
        $tot_gen = 0; // total general
        $tva = 0; // tva

        $detailRecords = $this->facture_model->detailFacture($id);
        $facture = $this->facture_model->factureOne($id);
        foreach ($facture as $key) {
            $nom_client = utf8_decode($key->nom_client);
            $adresse_client = utf8_decode($key->adresse_client);
            $date_facture = utf8_decode($key->date_facture);
            $numero_facture = utf8_decode($key->numero_facture);
            $stat_client = utf8_decode($key->stat_client);
            $nif_client = utf8_decode($key->nif_client);
        }
        $this->load->library('Fpdf_master');
        
        $this->fpdf->SetFont('Arial','B',12);
        
        $this->fpdf->Cell(95,5,utf8_decode('QUINCAILLERIE DU MARCHE'),0, 0,'C');// gauche
        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Cell(95,5,utf8_decode('Tuléar, le '.date("d-m-Y", strtotime($date_facture))),0, 0,'C'); // droite
        $this->fpdf->ln();
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Cell(95,5,'Mr MOHAMED RAZA Aliraza',0, 0,'C');// gauche
        $this->fpdf->ln();
        $this->fpdf->SetFont('Arial','',10);
        $this->fpdf->Cell(95,5,'STAT: 47521 51 2007 0 00053 du 2003/13',0, 0,'C');// gauche

        $this->fpdf->SetFont('Arial','B',12);
        
        $this->fpdf->Cell(95,5,utf8_decode('BL ET FACTURE N° '.$numero_facture),0, 0,'C'); // droite

        $this->fpdf->ln();
        $this->fpdf->SetFont('Arial','',10);

        $this->fpdf->Cell(95,5,'NIF: 1000 210 223 du 05/04/11',0, 0,'C');// gauche

        $this->fpdf->ln();
        $this->fpdf->Cell(95,5,'RCS: N 207 A 00012 du 06/03/2007',0, 0,'C');// gauche
        if(strlen($nom_client) > 35){
            $this->fpdf->Cell(95,5,'Nom: '.substr($nom_client, 0, 35),0, 0,'L'); // droite
        }else{
            $this->fpdf->Cell(95,5,'Nom: '.$nom_client,0, 0); // droite
        }
        $this->fpdf->ln();
        $this->fpdf->Cell(95,5,utf8_decode('CIF N° 0091717/DGI-H du 10/06/2020'),0, 0,'C');// gauche

        if(strlen($nom_client) > 35){
            $this->fpdf->Cell(95,5, substr($nom_client, 35, strlen($nom_client)),0, 0,'L'); // droite
        }else{
            $this->fpdf->Cell(95,5, 'Adresse: '.$adresse_client,0, 0); // droite
        }
        $this->fpdf->ln();
        $this->fpdf->Cell(95,5,'TEL: 032 02 63929 - 020 94 41017',0, 0,'C'); // gauche
        if(strlen($nom_client) > 35){
            $this->fpdf->Cell(95,5, 'Adresse: '.$adresse_client,0, 0); // droite
        }else{
            $this->fpdf->Cell(95,5, 'Statistique: '.$stat_client,0, 0); // droite
        }
        $this->fpdf->ln();
        $this->fpdf->Cell(95,5,'E-mail: mahomedraza.aliraza@gmail.com',0, 0,'C');// gauche
        if(strlen($nom_client) > 35){
            $this->fpdf->Cell(95,5, 'Statistique: '.$stat_client,0, 0); // droite
        }else{
            $this->fpdf->Cell(95,5, 'Nif: '.$nif_client,0, 'C'); // droite
        }
        $this->fpdf->ln();
        $this->fpdf->Cell(95,5,utf8_decode('BP: 26 Rue du marché - lot n° 06AB002'),0, 0,'C'); // gauche
        if(strlen($nom_client) > 35){
            $this->fpdf->Cell(95,5, 'Nif: '.$nif_client,0, 0); // droite
        }

        $this->fpdf->ln();
        
        $this->fpdf->SetFont('Arial','B',12);
        $this->fpdf->Cell(95,5,utf8_decode('601 Tuléar (Madagascar)'),0, 0,'C');// gauche
        $this->fpdf->ln();
        $this->fpdf->SetFont('Arial','B',10);
        $this->fpdf->Cell(190,10,utf8_decode('Les Marchandises désignées ci-dessous livrées en bonne état et Conforme'),0, 0,'C');// gauche
        $this->fpdf->ln();

        $this->fpdf->SetFont('Arial','',12);
        
        $this->fpdf->Cell(15,6,utf8_decode('Qté'),1, 0,'C');// gauche
        $this->fpdf->Cell(95,6,utf8_decode('DESIGNATION'),1, 0,'C');// gauche
        $this->fpdf->Cell(40,6,utf8_decode('Prix Unitaire'),1, 0,'C');// gauche
        $this->fpdf->Cell(40,6,utf8_decode('TOTAL'),1, 0,'C');// gauche
        $this->fpdf->ln();

        $this->fpdf->SetFont('Arial','',10);

        foreach ($detailRecords as $value) {
            $this->fpdf->Cell(15,5,number_format($value->qte, 0, ',', ' '),1, 0,'C');// gauche
            $this->fpdf->Cell(95,5,utf8_decode($value->design),1, 0,'L');// gauche
            $this->fpdf->Cell(40,5,number_format($value->prix, 2, ',', ' '),1, 0,'R');// gauche
            $this->fpdf->Cell(40,5,number_format($value->montant, 2, ',', ' '),1, 0,'R');// gauche
            $this->fpdf->ln();
            $mhtva += $value->montant;
        }
        for($i=0; $i < (26 - sizeof($detailRecords)); $i++){
            $this->fpdf->Cell(15,5,'',1, 0,'C');// gauche
            $this->fpdf->Cell(95,5,'',1, 0,'L');// gauche
            $this->fpdf->Cell(40,5,'',1, 0,'R');// gauche
            $this->fpdf->Cell(40,5,'',1, 0,'R');// gauche
            $this->fpdf->ln();
        }
        $this->fpdf->Cell(110,6,utf8_decode(''),0, 0,'L');
        $this->fpdf->Cell(40,6,utf8_decode('TOTAL HTVA'),1, 0,'C');// gauche
        $this->fpdf->Cell(40,6, number_format($mhtva, 2, ',', ' '),1, 0,'R');// gauche
        $this->fpdf->ln();
        
        
        $this->fpdf->Cell(110,6,utf8_decode(''),0, 0,'L');
        $this->fpdf->Cell(40,6,utf8_decode('TVA'),1, 0,'C');// gauche
        $this->fpdf->Cell(40,6, number_format($tva, 2, ',', ' '),1, 0,'R');// gauche
        $this->fpdf->ln();
        
        $this->fpdf->Cell(110,6,utf8_decode(''),0, 0,'L');
        $this->fpdf->Cell(40,6,utf8_decode('TOTAL GENERAL'),1, 0,'C');// gauche
        $this->fpdf->Cell(40,6, number_format(($mhtva + $tva), 2, ',', ' '),1, 0,'R');// gauche
        $this->fpdf->ln();
    
        $this->fpdf->Cell(190,6,utf8_decode('Arrêtée la présente facture à la somme de:'),0, 0,'L');
        $this->fpdf->ln();
        $this->fpdf->Cell(190,6,utf8_decode('DEUX MILLIONS NEUF CENT CINQUANTE MILLES'),0, 0,'L');
        $this->fpdf->ln();
        $this->fpdf->ln();

        $this->fpdf->Cell(95,5,utf8_decode('Le Fournisseur'),0, 0,'C');
        $this->fpdf->Cell(95,5,utf8_decode('Le Client'),0, 0,'C');
        $this->fpdf->ln();

        $this->fpdf->Cell(95,5,utf8_decode(''),0, 0,'C');
        $this->fpdf->Cell(95,5,utf8_decode('Reçu Conforme'),0, 0,'C');

        echo $this->fpdf->Output('hello_world.pdf', "I");// Name of PDF file

        //Can change the type from D=Download the file      
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $data['client'] = $this->client_model->allClient();
            
            $this->global['pageTitle'] = 'CodeInsect : Add New User';

            $this->loadViews("pages/facture/add", $this->global, $data, NULL);
        }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addFacture()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('date','Date','trim|required');
            $this->form_validation->set_rules('client','Client','trim|required');
            //$this->form_validation->set_rules('article','Article','required');
            //$this->form_validation->set_rules('qte','Quantité','trim|required|numeric');
            
            if($this->form_validation->run() == FALSE)
            {
                redirect('facture/add');
            }
            else
            {
                //$name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                //$mobile = $this->security->xss_clean($this->input->post('mobile'));

                $client = $this->security->xss_clean($this->input->post('client'));
                $date = $this->input->post('date');

                $factureInfo = array("date_facture"=>$date, "id_client"=>$client);
                
                $result = $this->facture_model->addNewFacture($factureInfo);
                $this->facture_model->updateFacture($result, array("numero_facture" => create_numero_facture($result)));
                if($result > 0)
                {
                    $this->load->model('detailfacture_model');
                    $article = $this->input->post('article');
                    $qte = $this->input->post('qte');
                    //pre($article);
                    for ($i=0; $i < sizeof($qte); $i++) { 
                        if($article[$i] != "" && $qte[$i] != ""){
                            $detail = array(
                                "id_facture" => $result,
                                "id_article" => $article[$i],
                                "qte_article" => $qte[$i]
                            );
                            $this->detailfacture_model->addNewDetailFacture($detail);
                        }
                    }
                    $this->session->set_flashdata('success', 'New Facture created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Facture creation failed');
                }
                redirect('facture/add');
            }
        }
    }
}

?>