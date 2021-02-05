<label for="cat_nom"><b>Catégorie :</b></label>
                        <select class="form-control" name="pro_cat_id" id="pro_cat_id" >
             <?php
            
            foreach ($liste_categorie as $row){
                          
                    
                echo"<option value=".$row->cat_id."";
                
              
                        if ($row->cat_id == $produit->pro_cat_id) {echo" selected";}
                
                        echo">".$row->cat_nom."</option>\n"; //separation ligne SUR CODE SOURCE
                        
                    }
            ?>
                        </select>



<option value="<?= $row->cat_id?>" <?php if (isset ($produit->pro_cat_id) and ($row->cat_id == $produit->pro_cat_id)) {echo "selected";}?>><?=$row->cat_nom?></option>