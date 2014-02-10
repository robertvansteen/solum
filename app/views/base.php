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
		</ul>
		{% block content %}{% endblock %} 	
	</div>
</body>
</html>
