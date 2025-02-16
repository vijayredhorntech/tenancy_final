<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js') }}"></script>
    <style>

        :root {
            --primary: rgb(0, 156, 255);
            --light: #F3F6F9;
            --dark: #191C24;
            --success: #28a745;
        }


        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .col-lg-6.d-flex.align-items-center.gradient-custom-2 {
            background-color: blue;
        }

        .loginFormLeftDiv
        {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }
        .loginFormDiv
        {
            width: 30%;
            border-radius: 10px;
            background-color: white;
            padding: 60px 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 50px 2px black;
        }
        label{
            color: black;
            font-size: 15px;
            font-weight: 500;
        }

        input
        {
            border: 1px solid var(--primary) !important;
            border-radius: 3px !important;
            padding: 10px !important;
            width: 100% !important;
            margin-bottom: 10px !important;
            color: black !important;
            font-weight: 500 !important;
        }
        .loginFormDiv img{
            height: 80px;
            width: auto;
        }

        .submitButtonDiv input
        {
            background-color: var(--primary) !important;
            color: white !important;
            font-weight: 500 !important;
            font-size: 20px !important;
            margin-top: 10px !important;
            transition:  0.5s !important;
        }
        .submitButtonDiv a
        {
            color: var(--primary) !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            transition:  0.5s !important;

        }
        .submitButtonDiv a:hover
        {
            color: var(--dark) !important;
        }
        .submitButtonDiv input:hover
        {
            background-color: var(--dark) !important;
        }

        @media (max-width: 1400px) {
            .loginFormDiv
            {
                width: 50%;
            }
        }
        @media (max-width: 992px) {
            .loginFormDiv {
                width: 60%;
            }
        }

        @media (max-width: 768px) {
            .loginFormDiv
            {
                width: 100%;
            }
            .loginFormDiv img{
                height: 60px;
                width: auto;
            }
        }

    </style>
</head>
<body style="overflow: hidden">
<div style="width: 100%; padding: 20px; height: 100vh; width: 100vw; overflow:hidden;  background: linear-gradient(rgba(0,0,0,0.68), rgba(0,0,0,0.5)), url({{asset('assets/images/backgroundImage2.jpg')}}); background-size: cover; background-position: center;">
<div class="row" style="min-height: 100vh">
      <div class="col-12 h-100 loginFormLeftDiv p-12">
          <div class="loginFormDiv" >
              <img src="{{asset('assets/images/logo.png')}}"  alt="Cloud Travels">
              <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 20px">
                  <h2 style="color: #000; font-size: 25px; font-weight: 600">Welcome to Him Soft</h2>
                  <p style="color: #000; font-size: 15px; font-weight: 500">Sign in to continue</p>
              </div>
              <form style="width: 100%" action="{{ route('agency_login') }}" method="POST">
                  @csrf
                  <div data-mdb-input-init class="form-outline mb-4">
                      <label class="form-label" for="form2Example11">Email Address</label>

                      <input type="email" id="form2Example11" class="form-control"
                             placeholder="Enter email address....." name="email" required />
                      @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                      <label class="form-label" for="form2Example22">Enter Password</label>

                      <input type="password" id="form2Example22" class="form-control"
                             placeholder="Enter password....." name="password" required />
                      @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  <input type="hidden" id="form2Example22" class="form-control" 
                              name="domain" value="{{ $agency->domains->domain_name }}" />
                              
                              <input type="hidden" id="form2Example22" class="form-control" 
                              name="database" value="{{ $agency->database_name }}" />


                  <div class="text-center pt-1 submitButtonDiv">
                      <input type="submit" value="Login" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                      <a class="text-muted" href="#!">Forgot password?</a>
                  </div>
              </form>

          </div>
      </div>

</div>
</div>
<div style="width: 100%; padding: 20px; height: 100vh; width: 100vw; overflow:hidden;  background: linear-gradient(rgba(0,0,0,0.68), rgba(0,0,0,0.5)), url({{asset('assets/images/backgroundImage2.jpg')}}); background-size: cover; background-position: center;">
<div class="row" style="min-height: 100vh">
      <div class="col-12 h-100 loginFormLeftDiv p-12">
          <div class="loginFormDiv" >
              <img src="{{asset('assets/images/logo.png')}}"  alt="Cloud Travels">
              <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; margin-top: 20px">
                  <h2 style="color: #000; font-size: 25px; font-weight: 600">Welcome to Him Soft</h2>
                  <p style="color: #000; font-size: 15px; font-weight: 500">Sign in to continue</p>
              </div>
              <form style="width: 100%" action="{{ route('agency_login') }}" method="POST">
                  @csrf
                  <div data-mdb-input-init class="form-outline mb-4">
                      <label class="form-label" for="form2Example11">Email Address</label>

                      <input type="email" id="form2Example11" class="form-control"
                             placeholder="Enter email address....." name="email" required />
                      @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                      <label class="form-label" for="form2Example22">Enter Password</label>

                      <input type="password" id="form2Example22" class="form-control"
                             placeholder="Enter password....." name="password" required />
                      @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                  <input type="hidden" id="form2Example22" class="form-control" 
                              name="domain" value="{{ $agency->domains->domain_name }}" />
                              
                              <input type="hidden" id="form2Example22" class="form-control" 
                              name="database" value="{{ $agency->database_name }}" />


                  <div class="text-center pt-1 submitButtonDiv">
                      <input type="submit" value="Login" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                      <a class="text-muted" href="#!">Forgot password?</a>
                  </div>
              </form>

          </div>
      </div>

</div>
</div>

</body>
</html>
