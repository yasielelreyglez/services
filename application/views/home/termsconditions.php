<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 6/13/2018
 * Time: 12:57 AM
 */
?>

<?php
$config = null;
if (isset($configRegionGlobal)) {
    foreach ($configRegionGlobal as $item) {
        if ($item->region == 'termsConditionsContent')
            $config = $item;
    }
}
?>
<?php if (isset($config)): ?>
    <?php echo $config->page->Content; ?>
<?php endif; ?>