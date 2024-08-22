<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>NoUserFound</title>

    <!-- BOOTSTRAP LINK -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
    />
  </head>
  <body class="d-flex  justify-content-center align-items-center vh-100">

<div class="container-fluid ">
  <div class="card container py-5 shadow-lg bg-light text-center mx-auto" >
    <div class="card-body">
      <h5 class="card-title text-danger display-3">No User Found</h5>
      <p class="card-text">We couldn't find any user with the provided information.</p>
      <a href="<?php echo base_url('welcome'); ?>" class="btn btn-danger">Try to Login Again</a>
    </div>
  </div>
</div>

   

    <style>
      .bg-violet {
        background: rgb(98, 58, 116);
        background: linear-gradient(
          0deg,
          rgba(98, 58, 116, 1) 0%,
          rgba(116, 49, 147, 1) 100%
        );
      }
      .glass {
        /* From https://css.glass */
        background: rgba(0, 0, 0, 0.28);
        border-radius: 20px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(5.1px);
        -webkit-backdrop-filter: blur(5.1px);
        /* border: 1px solid rgba(0, 0, 0, 0.3); */
      }
    </style>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
