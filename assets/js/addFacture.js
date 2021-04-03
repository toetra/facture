/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addFactureForms = $("#addFacture");
	
	var validator = addFactureForms.validate({
		
		rules:{
			date :{ required : true },
			client : { required : true },
			article : { required : true },
			qte : { required : true, digits : true }
		},
		messages:{
			date :{ required : "Ce champ est obligatoire" },
			client : { required : "Ce champ est obligatoire" },
			article : { required : "Ce champ est obligatoire" },
			qte : { required : "Ce champ est obligatoire", digits : "Veuillez ajouter un nombre" }			
		}
	});

	get_article();
});
$("input[name='qte']").on('keyup', function() {
	$(this).val(this.value.match(/[0-9]*/));
});
function get_article(){
	var donnees = getArticle();
	console.log(donnees["data"].length);
	var id = (parseInt($("#nbr_art").val())) + 1;
	$("#nbr_art").val(id);
	var form = '<div class="col-md-12" id="div_article_'+id+'">';                                
		form += '<div class="row">';                                
		    form += '<div class="col-md-1 text-center">';
		        form += '<div class="form-group">';
		            form += '<label for="qte" style="color:#fff">-</label>';
		            form += '<span class="btn btn-danger fa fa-minus btnSuppr" onClick="supprArticle('+id+')"></span>';
		        form += '</div>';
		    form += '</div>';
			form += '<div class="col-md-8">';                                
		        form += '<div class="form-group">';
		            form += '<label for="fname">Article</label>';
		            form += '<select class="form-control required" name="article[]">';
		                form += '<option value="">Choisir une article</option>';
		                if (donnees["status"] == "1") {
		                	for (var i = 0; i < donnees["data"].length; i++) {
		                		form += '<option value="'+donnees["data"][i]["id_article"]+'">'+donnees["data"][i]["design_article"]+'</option>';
		                	}
		                }
		            form += '</select>';
		        form += '</div>';
		    form += '</div>';
		    form += '<div class="col-md-3">';
		        form += '<div class="form-group">';
		            form += '<label for="qte">Quantité</label>';
		            form += '<input type="text" class="form-control required digits" value="" name="qte[]" >';
		        form += '</div>';
		    form += '</div>';
	    form += '</div>';
    form += '</div>';

    $("#detail_fac").append(form);
    hideSuppr();
}

function addArticle(){
	get_article();
}
function getArticle(){
	var retour;
	$.ajax({
		type: 'POST',
		url: baseURL+'articles/getArticle',
		success: function(data){
			retour = $.parseJSON(data);
		},
		error: function(e){
			//ErrorMessage.show('Une erreur s\'est produite');
		},
		async: false
	});
	return retour;
}
function supprArticle(id){
	if($("input[name='qte[]']").length > 1){
		$("#div_article_"+id).remove();
		hideSuppr();
	}
}

function hideSuppr(){
	if($("input[name='qte[]']").length == 1){
		$(".btnSuppr").removeClass('btn-danger');
		$(".btnSuppr").addClass('btn-default');
	}
	else{
		$(".btnSuppr").removeClass('btn-default');
		$(".btnSuppr").addClass('btn-danger');
	}
}