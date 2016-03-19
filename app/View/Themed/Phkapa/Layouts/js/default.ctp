<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>
<script type="text/javascript">
<?php echo $content_for_layout; ?>
</script>