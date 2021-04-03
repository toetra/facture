<?php 
    $nom_client = "";
    $numero_facture = "";
    $id_facture = "";
    $date_facture = "";
    //pre($facture);
    foreach ($facture as $key) {
        $id_facture = $key->id_facture;
        $nom_client = $key->nom_client;
        $numero_facture = $key->numero_facture;
        $date_facture = date("d-m-Y", strtotime($key->date_facture));
    }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Détail facture
        <small>Ajouter / Modifier / Supprimer</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-default" target="_blank" href="<?php echo base_url().'facture/pdf/'.$id_facture; ?>" ><i class="fa fa-file-pdf-o"></i> Exporter</a>
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>facture/edit"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Facture N° <?php echo $numero_facture ?></h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <div style="padding-left: 1rem;">
                        <u>Date</u>: <?php echo $date_facture ?><br/>
                        <u>Client</u>: <?php echo $nom_client ?><br/><br/>
                    </div>
                  <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th class="text-center" width="10%">Qté</th>
                        <th class="text-center">DESIGNATION</th>
                        <th class="text-center" width="15%">Prix Unitaire</th>
                        <th class="text-center" width="15%">TOTAL</th>
                        <th class="text-center" width="10%">Actions</th>
                    </tr>
                    <?php
                        if(!empty($detailRecords))
                        {
                            $total = 0;
                            foreach($detailRecords as $record)
                            {
                                $total += $record->montant;
                    ?>
                    <tr>
                        <td class="text-center"><?php echo number_format($record->qte, 0, ',', ' ')  ?></td>
                        <td class="text-left"><?php echo $record->design ?></td>
                        <td class="text-right"><?php echo number_format($record->prix, 2, ',', ' ') ?></td>
                        <td class="text-right"><?php echo number_format($record->montant, 2, ',', ' ') ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->id_detail_facture; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                            }
                    ?>
                    <tr><td colspan="2"></td>
                        <td class="text-center"><b>TOTAL</b></td>
                        <td class="text-right"><b><?php echo number_format($total, 2, ',', ' ') ?></b></td>
                    </tr>
                    <?php
                        }
                    ?>

                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
