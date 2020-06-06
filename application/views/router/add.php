<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$viewname = $this->router->uri->segments[1];
$formAction = !empty($editRecord) ? 'update_data' : 'insert_data';
$path = $viewname . '/' . $formAction;

?>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>bootstrap.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>parsley.js"></script>
<script type="text/javascript" src="<?= $this->config->item('js_path') ?>App.js"></script>

<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>css.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?= $this->config->item('css_path') ?>App.css" type="text/css">
        
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Demo</title>
</head>
<body>

<div id="container">
	
	<div id="body" class="row">
		<div class="col-md-12">
            <div class="portlet">
                <div class="portlet-header" id="">
                    <h3> <i class="fa fa-user"></i><?= !empty($editRecord)?'Edit router':' Add router' ?></h3>
                </div>
            </div>
            <div class="col-sm-8">
            	<?php
                    $attributes = array('class' => 'form parsley-form', 'id' => $viewname, 'name' => $viewname);
                    echo form_open_multipart($this->config->item('base_url') . '' . $path, $attributes);
                ?>   
                <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('SapId') ?><span style="color:#F00">*</span></label>
                     <select name="SapId" class="form-control parsley-validated"  data-required="required" >
                         <option value="">Select sapId</option>
                     <?php 
                        if(!empty($sapid_list))
                        {
                            foreach($sapid_list as $row)
                            {   ?>

                                <option value="<?php echo $row['id'] ?>" <?php echo!empty($editRecord[0]['SapId']) ? ($editRecord[0]['SapId'] == $row['id']) ? 'selected=selected' : '' : ''; ?>><?=$row['sapid_name']?></option>
                 <?php      }
                        }
                     ?></select>
                </div>
                <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('HostName') ?><span style="color:#F00">*</span></label>
                    <input id="HostName" name="HostName" placeholder="<?= $this->lang->line('HostName') ?>" maxlength="14" 
                      class="form-control parsley-validated" 
                    type="text" data-required="required" value="<?=!empty($editRecord[0]['HostName']) ? $editRecord[0]['HostName'] : ''; ?>">
                </div>

                 <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('Loopback') ?><span style="color:#F00">*</span></label>
                    <input id="Loopback" name="Loopback" placeholder="<?= $this->lang->line('Loopback') ?>"
                      class="form-control parsley-validated" type="text"
                      data-required="required" value="<?=!empty($editRecord[0]['Loopback']) ? $editRecord[0]['Loopback'] : ''; ?>">
                </div>

                 <div class="form-group">
                    <label for="select-multi-input"><?= $this->lang->line('MacAddress') ?><span style="color:#F00">*</span></label>
                    <input id="MacAddress" name="MacAddress" placeholder="<?= $this->lang->line('MacAddress') ?>"  maxlength="17"
                      class="form-control parsley-validated" type="text" 
                    data-required="required" value="<?=!empty($editRecord[0]['MacAddress']) ? $editRecord[0]['MacAddress'] : ''; ?>">
                </div>
                
                <div class="form-group">
                    <input type="hidden" name="id" id="exiting_id" value="<?= !empty($editRecord[0]['Id']) ? $editRecord[0]['Id'] : ''; ?>" />
                    <button type="submit"  class="btn btn-primary" id="save" title="Save" value="submitForm" name="save">Save</button>
                    <a class="btn btn-primary" id="Back"  href="<?= base_url($viewname . '/'); ?>"title="Back">Back</a>
                </div>
			</div>
	</div>

</body>
</html>
<script type="text/javascript">

//validation for numeric key
 function isNumberKey(evt)
    {
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return false;

            return true;
    }
</script> 