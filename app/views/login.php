{% extends 'base.php' %}

{% block title %}Login{% endblock %}

{% block content %}
	<form action="{{ url.generate('login.post') }}" method="post" role="form">
		<div class="form-group">
			<label name="username" for="username">Username</label>
			<input type="text" class="form-control" name="username" id="username">
		</div>
		<div class="form-group">
			<label name="password" for="password">Password</label>
			<input type="password" class="form-control" name="password" id="password">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-default">Login</button>
		</div>
	</form>

{% endblock %}

