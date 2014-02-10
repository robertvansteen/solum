<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{% block title %}{%endblock%}</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<style>
		.list-group-item-success { text-decoration: line-through; }
	</style>
</head>
<body>
	<div class="container">
		<ul class="nav nav-pills">
			<li><a href="{{ url.generate('task.index') }}">Home</a></li>	
			{% if username is null %}
				<li><a href="{{ url.generate('login.get') }}">Login</a></li>
			{% else %}
				<li><a href="{{ url.generate('task.create') }}">New task</a></li>
				<li><a href="{{ url.generate('logout') }}">Logout</a></li>
			{% endif %}
		</ul>
		{% for message in messages %}
			<div class="alert alert-info">{{ message }}</div>
		{% endfor %}
		{% for warning in warnings %}
			<div class="alert alert-danger">{{ warning }}</div>
		{% endfor %}
		{% block content %}{% endblock %} 	
	</div>
</body>
</html>
