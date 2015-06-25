//jquery pour gérer l'autocompletion

$( document ).ready(function() {
	$("#recherche_jeux_nom").keyup(function() {
		var motcle = $("#recherche_jeux_nom").val();
		if (motcle.length >= 3) {
			$.get( "autocompletion.php", { motcle: motcle } )
			  .done(function( data ) {
			    //on vide la selection (pour pas avoir celle d'avant)
			    $('#resultats-autocompletion').html('');
			    //on cherche la valeur dans le json
			    var resultats = $.parseJSON(data); 
			    //pour chaque valeur on les mets dans un nouveau DIV en dessous avec la class item pour la mise en forme
			    $(resultats).each(function(key, value){
		        	$('#resultats-autocompletion').append('<div class="item">' + value + '</div>');
				})
                //quand on clique sur le jeu il se met dans le champ de recherche
			    $('.item').click(function() {
			    	var texte = $(this).html();
			    	$('#recherche_jeux_nom').val(texte);
			    })

			});
		} else {
			$('#resultats-autocompletion').html('');
		}
	});

    $("#recherche_jeux_nom").blur(function(){
    		$("#resultats-autocompletion").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#resultats-autocompletion").show();
    	});

});