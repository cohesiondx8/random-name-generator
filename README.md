# Random Name Generator

## Default usage

```
$generator = new \CohRNG\Generator();

// Jaded-Slim-Charcoal-Tortoise
echo $generator->generate();
```

### Choose your Adjectives and delimiter

```
$generator = new \CohRNG\Generator([
	'adjectives' => ['color', 'size'], 
	'delimiter' => ', '
]);

// Petite, Rouge, Koala
echo $generator->generate();
```
