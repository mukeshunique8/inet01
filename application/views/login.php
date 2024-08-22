<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin-Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
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
  <body>
    <!-- LOGIN FORM -->
    <div class="bg-blu position-relative container-fluid">
      <div
        class="container d-flex justify-content-center align-items-center vh-100"
      >
        <div
          class="row  text-white p-4 rounded shadow-lg w-100"
          style="max-width: 400px"
        >
          <h2 class="text-center fw-medium mb-4">Admin</h2>
          <form
            method="post"
            id="loginForm"
            action="<?= base_url() ?>Crud/adminLogin"
          >
            <div class="mb-3">
              <label for="username" class="form-label fw-lighter"
                >UserName</label
              >
              <input
                type="text"
                class="form-control"
                name="username"
                id="username"
                required
              />
              <div class="invalid-feedback">
                Please provide a valid UserName.
              </div>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label fw-lighter"
                >Password</label
              >
              <input
                type="password"
                class="form-control"
                name="password"
                id="loginPassword"
                required
              />
              <div class="invalid-feedback">Please provide your password.</div>
            </div>
            <div class="mb-3 text-center">
              <button
                type="submit"
                name="save"
                class="btn fw-lighter text-white btn-primary w-100"
              >
                Login
              </button>
            </div>
            <p class="text-center mt-3">
              <a class="text-white fw-lighter" href="dashboard"
                >Forgot your password?</a
              >
            </p>
            <!-- <p class="text-center text-danger mt-3">
          <a class="text-white" href="signup.html">New User</a>
        </p> -->
          </form>
        </div>
      </div>
    </div>

    

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

  </body>
</html>
