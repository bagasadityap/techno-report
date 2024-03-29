<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/loginStyle.css">
</head>
<body>
  <div class="wrapper">
    <form action="{{route('login')}}" method="POST">
      @csrf
      <h2>Login</h2>
        <div class="input-field">
        <input type="text" name="email" id="email" required>
        <label>Enter your username</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" id="password" required>
        <label>Enter your password</label>
      </div>
      <div class="forget">
        <label for="remember">
          <input type="checkbox" id="remember">
          <p>Remember me</p>
      </div>
      <button type="submit">Log In</button>
    </form>
  </div>
</body>
</html>