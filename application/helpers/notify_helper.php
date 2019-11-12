<?php

if(!function_exists('notify')) {

   function notify($status,$message) {

      switch ($status) {
        case 'success':

          $notif = '<div class="alert-success" role="alert">'.$message.'</div>';
          break;

        case 'primary':

          $notif = '<div class=" alert-primary" role="alert">'.$message.'</div>';
          break;

        case 'warning':
          $notif = '<div class=" alert-warning" role="alert">'.$message.'</div>';
          break;

        case 'danger':
          $notif = '<div class="alert-danger" role="alert">'.$message.'</div>';
          break;

        default:
          $notif = '<div class=" alert-info" role="alert">'.$message.'</div>';
          break;
      }

      return $notif;

   }
}
