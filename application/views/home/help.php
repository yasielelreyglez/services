<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 5/31/2018
 * Time: 5:09 AM
 */
?>

<?php
$config = null;
if (isset($configRegionGlobal)) {
    foreach ($configRegionGlobal as $item) {
        if ($item->region == 'globalHelp')
            $config = $item;
    }
}
?>
<?php if (isset($config)): ?>
    <?php echo $config->page->Content; ?>
<?php endif; ?>
