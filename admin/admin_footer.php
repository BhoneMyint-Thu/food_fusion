<?php
// call at the end of the main content to close wrapper and include scripts if needed
?>
<footer class="admin-footer">
  <small>FoodFusion Admin • <?= date('Y') ?></small>
</footer>

<script>
  // lightweight sidebar toggle (works on all admin pages)
  document.getElementById('toggleBtn')?.addEventListener('click', function(){
    document.getElementById('sidebar')?.classList.toggle('collapsed');
    document.querySelector('.main')?.classList.toggle('expanded');
  });
</script>
