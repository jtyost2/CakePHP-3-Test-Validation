<?php
namespace Jtyost2\TestValidation;
require dirname(__FILE__) . "/vendor/autoload.php";
use Cake\Validation\Validator;
?>

<?php  if (!empty($_POST)): ?>
	<?php
	$validator = new Validator();
	$validator
		->requirePresence('name')
		->notEmpty('name', 'Name is required to be submitted.')

		->requirePresence('email')
		->add('email', 'email', [
			'rule' => 'email',
			'message' => 'E-mail must be valid'
		])
		->notEmpty('email', 'E-mail is required to be submitted.')

		->requirePresence('website')
		->add('website', 'url', [
			'rule' => 'url',
			'message' => 'Website must be valid'
		])
		->allowEmpty('email')

		->requirePresence('phone')
		->add('phone', 'url', [
			'rule' => function ($value, $context) {
				if (!preg_match('/^\(?(\d{3})\)?[-\. ]?(\d{3})[-\. ]?(\d{4})$/', $value)) {
					return false;
				} else {
					return true;
				}
    	},
			'message' => 'Phone must be valid'
		])
		->notEmpty('phone', 'Phone is required to be submitted.')

		->requirePresence('message')
		->notEmpty('message', 'Please submit a question or a comment.');

		$errors = $validator->errors($_POST);
		if (empty($errors)) {
			// submit form
		} else {
			var_dump($errors);
		}
	?>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Basic CakePHP Validation</title>
	</head>

	<body>
		<form id="contact" method="post" action="">
			<label for="name">Name</label>
			<input type="text" name="name">


			<label for="email">E-mail</label>
			<input type="email" name="email">

			<label for="phone">Phone</label>
			<input type="text" name="phone">

			<label for="website">Website</label>
			<input type="url" name="website">

			<label for="message">Question/Comment</label>
			<textarea name="message"></textarea>

			<input type="submit" name="submit" id="submit" value="Send Message" />
		</form>
	</body>
</html>
<?php endif; ?>
