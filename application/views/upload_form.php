<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/7/2017
 * Time: 5:00 PM
 */?>
<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('admin/upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>