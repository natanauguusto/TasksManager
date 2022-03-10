<!--- VALIDATIONS -->
<table>
<?php  if(!isset($listTable)):?>
    <div class="container">
        <span class="msg warn"> Table is Empty! </span>
    </div>
<?php endif?>
<?php if(!isset($campus)):?>
    <div class="container">
        <span class="msg warn"> Not has Campus! </span>
    </div>    
<?php endif?>
<!--- TABLE --->
<?php if(isset($campus) && isset($listTable)):?>
    <tr>
        <?php foreach($campus as $campu):?>
            <th><?php echo $campu;?></th>
        <?php endforeach?>
    </tr>
    <!-- <?php foreach($listTable as $itemTable=>$value):?>
        <tr>
            <td>$value</td>
            <td>$value</td>
            <td>$value</td>
            <td>$value</td>
            <td>$value</td>
        </tr>
    <?php endforeach?> -->
<?php endif?>
</table>