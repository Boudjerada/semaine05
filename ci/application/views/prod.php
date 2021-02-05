 <ul>
    <?php
       for ($i=1;$i<=$taille;$i++){
            $prod="produit".$i;
            echo "<li>".$$prod."</li>";
        }
    ?>
</ul>
