<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $this->config->item('app_name') ?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">

</head>
<body>

<div id="container" style="width:300px;margin:auto">
	<div id="header">
		<h1>Login</h1>
	</div>

	<div id="body">
    <?php echo form_open('app/login',array('autocomplete' => 'off')) ?>
    <table>
      <tr>
        <td>Username</td>
        <td>:</td>
        <td>    <input type="text" name="username" ></td>
      </tr>
      <tr>
        <td>Password</td>
        <td>:</td>
        <td>    <input type="password" name="password" ></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><input type="submit" value="Masuk" ></td>
      </tr>
    </table>

    <?php echo form_close() ?>
  <center><?php echo $this->session->flashdata('notify') ?></center>
	</div>

	<p class="footer">Copyright YSF &copy; 2019</p>
</div>

</body>
</html>
