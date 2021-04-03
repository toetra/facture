<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Gestion des factures
        <small>Ajouter / Modifier</small>
      </h1>
    </section>
    
    <section class="content">
    
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
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                
                <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addFacture" action="<?php echo base_url() ?>facture/addFacture" method="post" role="form">

                <div class="row">
            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Facture</h3>
                    </div><!-- /.box-header -->
                    
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">Date</label>
                                        <input type="text" class="form-control required" id="date" value="<?php echo set_value('mobile'); ?>" name="date" >
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="role">Client</label>
                                        <select class="form-control required" id="client" name="client">
                                            <option value="">Choisir un client</option>
                                            <?php
                                            if(!empty($client))
                                            {
                                                foreach ($client as $rl)
                                                {
                                                    ?>
                                                    <option value="<?php echo $rl->id_client ?>" > <?php echo $rl->nom_client ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                        </div><!-- /.box-body -->
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Détail facture</h3>
                    </div><!-- /.box-header -->
                    
                        <div class="box-body">
                            <div class="row" id="detail_fac">
                                
                            </div>
                            <div class="row" >
                                <div class="col-md-12 text-right">
                                    <span class="btn btn-success fa fa-plus" onclick="addArticle()"></span>
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                            <input type="hidden" id="nbr_art" value="0" />
                        </div>
                    
                </div>
            </div>
        </div>
                </form>
            </div>
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/addFacture.js" type="text/javascript"></script>