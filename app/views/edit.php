{% extends 'base.php' %}

{% block title %}Edit task{% endblock %}

{% block content %}
	<h1>Edit task</h1>
	<form action="{{ url.generate('task.update', {'id':task.id}) }}" method="POST" role="form">
		<input type="hidden" name="_method" value="PUT">
		<div class="form-group">
			<label for="task">Task name</label>
			<input type="text" name="task" value="{{task.name}}" class="form-control">
		</div>
		<div class="form-group">
			<label for="finished">Finished</label>
			<input type="checkbox" name="finished" value=1 {% if task.finished == 1 %}checked{% endif %} class="form-control">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Update task</button>	
		</div>
	</form>
{% endblock %}
