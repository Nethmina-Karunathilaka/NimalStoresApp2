<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 350px;
            background-color: #e6e6e6;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #666;
        }
        .container input[type="email"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        .container .password-wrapper {
            position: relative;
        }
        .container .password-wrapper input[type="password"] {
            padding-right: 60px; /* Add space for the toggle button */
        }
        .container .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            font-size: 14px;
            color: #0066cc;
            cursor: pointer;
        }
        .container .toggle-password:hover {
            text-decoration: underline;
        }
        .container .btn {
            width: 100%;
            background-color: #000;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            margin-top:10px;
        }
        .container .btn:hover {
            background-color: #333;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .header .logo {
            font-weight: bold;
            color: #0066cc;
            font-size: 14px;
        }
        .header .signin {
            font-size: 14px;
            color: #333;
        }
        .header .signin a {
            color: #0066cc;
            text-decoration: none;
        }
        .header .signin a:hover {
            text-decoration: underline;
        }

        .fpass{
            margin-bottom:10px;
            color: #333;
            font-size: 14px;
        }

        .fpass a{
            margin-bottom:10px;
            color: #0066cc;
            font-size: 14px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h2>Sign In</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <label for="fname">User Name/Email</label>
            <div>
                <input type="email" id="email" name="email" placeholder=" Enter Username Name / Email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="password">Enter password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Enter password" style="width: 300px;"class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="button" class="toggle-password" onclick="togglePassword('password')">Show</button>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn">Login</button><br><br>
            @if (Route::has('password.request'))
                <div class="fpass">Forget your<a href="{{ route('password.request') }}"> password</a></div>
            @endif
            <div class="header">
                <div class="signin">Already have an account? <a href="{{ route('register') }}">Sign Up</a></div>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            var field = document.getElementById(fieldId);
            var toggleBtn = field.nextElementSibling;

            if (field.type === "password") {
                field.type = "text";
                toggleBtn.textContent = "Hide";
            } else {
                field.type = "password";
                toggleBtn.textContent = "Show";
            }
        }
    </script>

</body>