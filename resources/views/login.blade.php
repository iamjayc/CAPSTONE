<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trucking Services Login</title>
  <!-- Include CSS -->
  <link rel="stylesheet" href="{{ asset('css/capstone.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <div class="container">
    <!-- Left Section with Image -->
    <div class="left-section">
        <img src="{{ asset('images/truck.jpg') }}" alt="Truck Image" class="truck-image">
    </div>

    <!-- Right Section with Login Form -->
    <div class="right-section">
      <div class="header">
        <h1>The<br><span><i>SYA</i> Trucking Services</span></h1>
        <p>Since 2020</p>
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login.submit') }}" class="login-form">
        @csrf
        <input type="text" name="username" placeholder="username" class="input-field" required>
        <input type="password" name="password" placeholder="password" class="input-field" required>
        <button type="submit" class="login-button">LOGIN</button>
      </form>

      <!-- Error Display -->
      @if($errors->has('login_error'))
        <p style="color: red; text-align: center;">{{ $errors->first('login_error') }}</p>
      @endif

      <!-- User Icon -->
      <div class="user-icon">
        <a href="{{ route('dashboard') }}">
            <i class="fa-solid fa-user"></i>
        </a>        
      </div>
    </div>
  </div>
</body>
</html>
