<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Creation Form</title>
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
        .container input[type="text"],
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
    </style>
</head>
<body>
    <div class="container">
        
        <h2>Create an account</h2>
        <form  method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Name</label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter First Name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <label for="mobile_number">Mobile Number</label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number', auth()->user()->mobile_number ?? '') }}" required autocomplete="mobile_number" autofocus>
                @error('mobile_number')
                    <span class="invalid-feedback" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                @enderror
            </div>

            <label for="address">Address</label>
            <div>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="address" name="address" placeholder="Enter First Name" value="{{ old('address', auth()->user()->address ?? '') }}" required autocomplete="address" autofocus>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <label for="email">Email</label>
            <div>
                <input type="email" id="email"  placeholder="Enter Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                @enderror
            </div>
            <label for="password">Create new password</label>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Create new password" class="form-control @error('password') is-invalid @enderror" style="width: 300px;" required autocomplete="new-password">
                <button type="button" class="toggle-password" onclick="togglePassword('password')">Show</button>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <p>{{ $message }}</p>
                    </span>
                @enderror
            </div>

            <label for="confirm-password">Conform password</label>
            <div class="password-wrapper">
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Conform password" style="width: 300px;" required autocomplete='new-password'>
                <button type="button" class="toggle-password" onclick="togglePassword('password-confirm')">Show</button>
            </div>

            <button type="submit" class="btn">Sign Up</button><br><br>
            <div class="header">
                <div class="signin">Already have an account? <a href="{{route('login')}}">Sign in</a></div>
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
</html>
