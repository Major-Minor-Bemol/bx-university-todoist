<?php

// php todo.php list
// php todo.php list 2022-10-12
// php todo.php list yesterday
// php todo.php add "Wake up"
// php todo.php add "Drink coffee"
// php todo.php complete 1 2
// php todo.php remove 2 (rm)
// php todo.php report

function main(array $arguments): void
{
	array_shift($arguments);

	$command = array_shift($arguments);

	switch ($command)
	{
		case 'list':
			listCommand($arguments);
			break;
		case 'add':
			addCommand($arguments);
			break;
		case 'complete':
			completetCommand($arguments);
			break;
		case 'remove':
			removeCommand($arguments);
			break;
		case 'rn':
			removeCommand($arguments);
			break;

		default:
			echo 'Unknown command';
			exit(1); //вот эта цифра в exit, это некий код ошибки, если 0 то нет ошибки, можем передать любую цифру
	}

	exit(0);

}

function removeCommand(array $arguments)
{

}

function completetCommand(array $arguments)
{

}

function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	$todo = [
		'id' => uniqid(),
		'title' => $title,
		'completed' => true,
	];

	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (file_exists($filePath))
	{
		$content = file_get_contents($filePath);
		$todos = unserialize($content, [
			'allowed_classes' => false,
		]);
		$todos[] = $todo;
		file_put_contents($filePath, serialize($todos));
	}
	else
	{
		$todos = [$todo];

		file_put_contents($filePath, serialize($todos));
	}
}

function listCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (!file_exists($filePath))
	{
		echo 'Nothing to do here';
		return;
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	if (empty($todos))
	{
		echo 'Nothing to do here';
		return;
	}

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

main($argv);