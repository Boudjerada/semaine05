//Selectionne les sous-catégories selon le choix de la catégorie

$(document).ready(function() {

    let catValue = document.querySelector('.catValue');

    console.log(catValue.value);


    /*Pour chargement via vue, non json*/
    /*$("#select1").load("http://localhost/ci/index.php/Jarditou/option1");*/

   /* format Json sans passer par la vue option1v */	
    $.post({
        url: "http://localhost/ci/index.php/Jarditou/option1", 
        dataType: "json",
        success: function(data) 
        {			
            var contenu = '<option value="">Choisir une catégorie</option>';
            
            $.each(data, function(key, val) {
                if(val.cat_id === catValue.value){
                    contenu += `<option value="${val.cat_id}" selected="selected">${val.cat_nom}</option>`;
                }
                else {
                    contenu += `<option value="${val.cat_id}">${val.cat_nom}</option>`;
                }
            });
                                            
            $("#select1").html(contenu);
        }
    });
    
    

   $("#select1").change(function() {

        let v =$('#select1').val();
        
        /*Pour chargement via vue, non json*/
        /*$("#select2").load(`http://localhost/ci/index.php/Jarditou/option2/${v}`);*/

    /* format Json sans passer par la vue option2v*/	
        $.post({
            url: `http://localhost/ci/index.php/Jarditou/option2/${v}`, 
            dataType: "json",
            success: function(data) 
            {			
                var contenu = '<option value=""></option>';
                
                $.each(data, function(key, val) {
                    contenu += `<option value="${val.cat_id}">${val.cat_nom}</option>`;
                });
                                                
                $("#select2").html(contenu);
            }
        });



    });


});























