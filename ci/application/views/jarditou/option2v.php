<option value=""></option>
<?php  foreach ($option2 as $row): ?>
           <option value="<?= $row->cat_id?>"><?=$row->cat_nom?></option>
<?php endforeach; ?>