<?php
/*
  @Description: router list
  @Author: Ruchi Shahu 
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<?php
$viewname = $this->router->uri->segments[1];
$path_comman = $this->config->item('base_url') . $viewname . '/';
?>

<table class="table table-striped table-bordered table-hover table-highlight table-checkable dataTable-helper dataTable datatable-columnfilter" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
    <thead>
        <tr role="row">
   			<th><?php echo $this->lang->line('SapId') ?></th>
			<th><?php echo $this->lang->line('HostName') ?></th>
			<th><?php echo $this->lang->line('Loopback') ?></th>
			<th><?php echo $this->lang->line('MacAddress') ?></th> 
			<th ><?php echo $this->lang->line('common_label_action') ?></th>
		</tr>
	</thead>

<tbody role="alert" aria-live="polite" aria-relevant="all">
    <?php
    if (!empty($datalist) && count($datalist) > 0) {

        $i = !empty($this->router->uri->segments[3]) ? $this->router->uri->segments[3] + 1 : 1;
?>
        <tr>
            <td><input type="text" onchange="search_text('sapid_name')" id="sapid_name" name="search_text['sapid_name']"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='sapid_name') ? $search_keyword:'';?>"/></td>
            
            <td><input type="text" onchange="search_text('HostName')" id="HostName" name="search_text['HostName']"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='HostName') ? $search_keyword:'';?>"/></td>
            <td><input type="text" onchange="search_text('Loopback')" id="Loopback" name="search_text['Loopback']"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='Loopback') ? $search_keyword:'';?>"/></td>
            <td><input type="text" onchange="search_text('MacAddress')" id="MacAddress" name="search_text['MacAddress']"
                 value="<?=!empty($search_field) && (!empty($search_keyword)) && ($search_field =='MacAddress') ? $search_keyword:'';?>"/></td>
        </tr>
        <?php 
        foreach ($datalist as $row) {
            ?>
            <tr <? if ($i % 2 == 1) { ?>class="bgtitle" <? } ?> >
                 
                <td class="hidden-xs hidden-sm "><?php echo $row['sapid_name'] ?></td>
                <td class="hidden-xs hidden-sm "><?php echo ($row['HostName']) ?></td>
                <td class="hidden-xs hidden-sm "><?php echo $row['Loopback'] ?></td>
                <td class="hidden-xs hidden-sm "><?php echo $row['MacAddress'] ?></td>
                <td class="hidden-xs hidden-sm text-left">
                    <a class="btn btn-xs btn-success" href="<?= $this->config->item('base_url') . $viewname; ?>/edit_data/<?= $row['Id'] ?>" title="<?php echo $this->lang->line('edit_record'); ?>">Edit</a>
                    <button class="btn btn-xs btn-primary" title="<?php echo $this->lang->line('delete_record'); ?>"  onclick="deletepopup('<?php echo $row['Id'] ?>', '<?php echo rawurlencode(ucfirst(strtolower($row['HostName']))) ?>', '<?= $path_comman ?>');"> Delete </button>
                </td>
            </tr>
        <?php
        }
    } else {
        ?>
        <tr>
            <td class="text-center" colspan="100%">
                No data Found
            </td>
        </tr> 
<?php } ?>
</tbody>
</table>
<div class="row dt-rb">
    <div class="col-sm-6"> </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate  paging_bootstrap float-right" id="common_tb">
            <?php
            if (isset($pagination)) {
                echo $pagination;
            }
            ?>
        </div>
    </div>
</div>
