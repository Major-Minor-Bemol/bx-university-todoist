<?php

function mapTodos(array $todos, array $positions, closure $callback) : array
{
	foreach ($positions as $position)
	{
		$index = (int)$position - 1;
		if (!isset($todos[$index]))
		{
			continue;
		}

		$result = $callback($todos[$index]);
		if (is_array($result))
		{
			$todos[$index] = $result;
		}
		else
		{
			unset($todos[$index]);
		}
	}

	return array_values($todos);
}