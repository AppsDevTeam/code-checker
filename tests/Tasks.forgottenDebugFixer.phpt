<?php

use Nette\CodeChecker\Tasks;
use Nette\CodeChecker\Result;
use Tester\Assert;

require __DIR__ . '/bootstrap.php';


test(function () {
	$result = new Result;
	$content = "<?php
bd('aaa');
echo 'bbb'";
	Tasks::forgottenDebugFixer($content, $result);
	Assert::count(1, $result->getMessages());
	Assert::same("<?php
echo 'bbb'", $content);
});

test(function () {
	$result = new Result;
	$content = "<?php echo('aaa') ?>";
	Tasks::forgottenDebugFixer($content, $result);
	Assert::same([], $result->getMessages());
	Assert::same("<?php echo('aaa') ?>", $content);
});

