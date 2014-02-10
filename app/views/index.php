{% extends 'base.php' %}

{% block title %}Tasks{% endblock %}

{% block content %}
	<h1>Tasks</h1>
	<ul class="list-group">
	{% for task in tasks %}
		<li class="list-group-item{% if task.finished == 1 %} list-group-item-success{% endif %}"><a href="{{ url.generate('task.show', {'id': task.id}) }}">{{ task.name }}</a></li>
	{% endfor %}
	</ul>

	<a href="{{url.generate('task.create')}}"><button class="btn btn-default">Create a new task</button></a>
{% endblock %}

