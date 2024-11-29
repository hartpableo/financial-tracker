</main>

<?php
$helper = new core\Helpers();
$helper->renderJs(true);
?>
<script>
  function removeItem(index) {
    document.querySelector(`[data-item="${index}"]`).closest('[data-slot="field-wrapper"]').remove();
  }
</script>
</body>
</html>