<?php

function listCommand(array $arguments)
{
	$todos = getTodosOrFail();

	foreach ($todos as $index => $todo)
	{
		echo sprintf(
			"%s. [%s] %s \n",
			($index + 1), //подставится в первый плейсхолдер %s, остальные также
			$todo['completed'] ? 'x' : ' ',
			$todo['title']
		);
	}
}