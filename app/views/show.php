{% extends 'base.php' %}

{% block title %}{{ task.name }}{% endblock %}

{% block content %}
	<h1>{{task.name}}</h1>
	<p>
		{% if task.finished == 1 %}
			Finished
		{% else %}
			Not Finished Yet
		{% endif %}
	</p>

	{% if username is null %} {% else %}
		<a href="{{ url.generate('task.edit', {'id':task.id }) }}"><button type="button" class="btn btn-default">Edit this task</button></a>
		<form action="{{ url.generate('task.destroy', {'id':task.id }) }}" method="POST" style="display: inline-block">
			<input type="hidden" name="_method" value="DELETE">
			<button type="submit" class="btn btn-danger">Delete this task</button>
		</form>
	{% endif %}
{% endblock %}
