<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 12px 0;
            border: none;
            border-radius: 6px;
            font-size: 16px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #38bdf8;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            transition: 0.3s;
        }

        .form-container button:hover {
            background-color: #0ea5e9;
        }
    </style>
</head>
<body>
    
    <div class="form-container">
        <h2>Create User</h2>
        
        @if(session('success'))
            <div style="background-color: #d1e7dd; color: #0f5132; padding: 10px; margin-bottom: 20px; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users_srtore') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" >
            <input type="text" name="phone" placeholder="Phone Number" ><br><br>

            <input type="password" name="password" placeholder="Password" required>
         

            <button type="submit">Create User</button>
            <div class="dd" style="display:flex; justify-content:center; "><a href="/login">To login</a></div>
        </form>
    </div>

</body>
</html>
