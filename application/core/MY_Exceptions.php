<?php
// application/core/MY_Exceptions.php

class MY_Exceptions extends CI_Exceptions {
    public function show_404($page = '', $log_error = true) {
        // Log the 404 error if needed
        if ($log_error) {
            log_message('error', '404 Page Not Found --> '.$page);
        }

        // Set the status header
        set_status_header(404);

        // Manually load the 404 view
        $filepath = APPPATH . 'views/errors/html/error_404.php';
        if (file_exists($filepath)) {
            include($filepath);
        } else {
            echo "404 Page Not Found";
        }

        exit; // Stop further execution
    }
}
