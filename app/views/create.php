{% extends 'base.php' %}

{% block title %}Add a new task{% endblock %}

{% block content %}
	<h1>Add a new task</h1>
	<form action="{{ url.generate('task.store') }}" method="post" role="form">
		<div class="form-group">
			<label name="task" for="task">Task name</label>
			<input type="text" class="form-control" name="task" id="task">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Add a new task</button>
		</div>
	</form>
{% endblock %}
