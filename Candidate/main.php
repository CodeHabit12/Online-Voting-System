<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto;
        }

        .nav {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #444;
        }

        .nav li {
            float: left;
        }

        .nav li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .nav li a:hover {
            background-color: #555;
        }

        .content {
            background-color: white;
            padding: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 18px;
            font-style: italic;
        }

        .button {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #555;
        }

        .polls {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .poll {
            border: 1px solid #ccc;
            padding: 10px;
        }

        .poll-title {
            font-size: 16px;
            font-weight: bold;
        }

        .poll-status {
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo">
            <h1>Online Voting System</h1>
        </div>
        <ul class="nav">
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="logout.html">Log Out</a></li>
        </ul>
        <div class="content">
            <p class="title">Welcome, {{username}}</p>
            <p class="subtitle">Here are the polls you can vote in</p>
            
                <div class="polls">
                    {% for poll in polls %}
                    <div class="poll">
                        <p class="poll-title">{{poll.title}}</p>
                        <p class="poll-status">{{poll.status}}</p>
                        {% if poll.status == "Open" %}
                        <p><a href="{{poll.url}}" class="button">Vote Now</a></p>
                        {% else %}
                        <p><a href="{{poll.url}}" class="button">View Results</a></p>
                        {% endif %}
                    </div>
                    {% endfor %}
                </div>

