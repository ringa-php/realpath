<?php

namespace Leo;

/**
 * Retrieve canonical path, also works on non-exist paths.
 * @param  string $path Input path
 * @return string       Canonical path
 */
function realpath(string $path):string
{
	// If the path is empty, assume current working directory.
	if (strlen($path) == 0)
		return getcwd();

	// Canonicalize path separator.
	$path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);

	// If the path does not start with slash,
	// or a relative path,
	// prepend current working directory.
	if ($path[0] != DIRECTORY_SEPARATOR)
		$path = getcwd() . DIRECTORY_SEPARATOR . $path;

	$stack = explode(DIRECTORY_SEPARATOR, $path);
	$abs = [];

	foreach ($stack as $i) {
		// Ignore empty component or single dot (current directory)
		if ($i === '.' || $i === '')
			continue;
		// Pop stack on double dot (parent directory)
		elseif ($i === '..')
			array_pop($abs);
		// Push stack else
		else
			$abs[] = $i;
	}

	return DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $abs);
}

?>
