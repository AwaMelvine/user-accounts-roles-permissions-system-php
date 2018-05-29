<?php if (isset($_SESSION['success_msg'])): ?>
  <div class="success_msg" style="color: green;">
    <?php
      echo $_SESSION['success_msg'];
      unset($_SESSION['success_msg']);
    ?>
  </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_msg'])): ?>
  <div class="error_msg" style="color: red;">
    <?php
      echo $_SESSION['error_msg'];
      unset($_SESSION['error_msg']);
    ?>
  </div>
<?php endif; ?>
