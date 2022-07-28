<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>test</title>
</head>
<body>
	@if ($message)
	<h1>{{ $message }}</h1>
	@elseif ($recipe)
	<div>{{ $recipe }}</div>

</body>
</html>