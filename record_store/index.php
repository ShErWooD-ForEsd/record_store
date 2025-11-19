<?php
include __DIR__ . "/data/db.php";
include __DIR__ . '/data/functions.php';

session_start();

$view = filter_input(INPUT_GET, 'view') ?: 'list';
$action = filter_input(INPUT_POST, 'action');

//This function makes sure that the user put in their credentials to be able to access private pages. It will keep redirecting them to the login page to put in their info.
function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: ?view=login');
        exit;
    }
}

$public_views = ['login', 'register'];
$public_actions = ['login', 'register'];

if ($action && !in_array($action, $public_views, true)) {
    require_login();
}

if (!$action && !in_array($view, $public_views, true)) {
    require_login();
}

switch ($action) {
//login in requires the user to put in their username & password to be able to access the side, while the register section lets a new user greate this information. It also confirms the password or tells the user that they need a different username to make them unique in the system.
    case 'login':
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');

        if ($username && $password) {
            $user = user_find_by_username($username);
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $view = 'list';
            } else {
                $login_error = "Invalid username or password.";
                $view = 'login';
            }
        } else {
            $login_error = "Enter both fields.";
            $view = 'login';
        }
        break;

    case 'logout':
        $_SESSION = [];
        session_destroy();
        session_start();
        $view = 'login';
        break;

    case 'register':
        $username  = trim((string)($_POST['username'] ?? ''));
        $full_name = trim((string)($_POST['full_name'] ?? ''));
        $password  = (string)($_POST['password'] ?? '');
        $confirm   = (string)($_POST['confirm_password'] ?? '');

        if ($username && $full_name && $password && $password === $confirm) {
            $existing = user_find_by_username($username);
            if ($existing) {
                $register_error = "That username already exists.";
                $view = 'register';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                user_create($username, $full_name, $hash);

                $user = user_find_by_username($username);
                $_SESSION['user_id'] = (int)$user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $view = 'list';
            }
        } else {
            $register_error = "Complete all fields and match passwords.";
            $view = 'register';
        }
        break;
//the record_id is kept during the user's session and put into their shopping cart. This will bring the record easily to the shopping cart for checkout purposes.
    case 'add_to_cart':
        require_login();
        $record_id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($record_id) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            $_SESSION['cart'][] = $record_id;
        }
        $view = 'list';
        break;

    case 'checkout':
        require_login();
        $cart_ids = $_SESSION['cart'] ?? [];

        if ($cart_ids) {
            foreach ($cart_ids as $rid) {
                purchase_create((int)$_SESSION['user_id'], (int)$rid);
            }
            $_SESSION['cart'] = [];
        }
        $view = 'checkout_success';
        break;

    case 'create':
        $title = trim((string)(filter_input(INPUT_POST, 'title') ?? ''));
        $artist = trim((string)(filter_input(INPUT_POST, 'artist') ?? ''));
        $price = (float)(filter_input(INPUT_POST, 'price') ?? 0);
        $format = (string)(filter_input(INPUT_POST, 'name') ?? 0);

        if ($title && $artist && $price && $format) {
            record_insert($title, $artist, $price, $format);
            $view = 'created';
        } else {
            $view = 'create';
        }
        // $view = "created";
        break;

    case 'delete':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $deleted = record_delete($id);
        }
        $view = 'deleted';
        break;

    case 'edit':
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $record = record_get($id);
        }
        $view = 'create';
        break;
}
if ($view === 'cart') {
    $cart_ids = $_SESSION['cart'] ?? [];
    $records_in_cart = records_by_ids($cart_ids);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Shop</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <?php require __DIR__ . "/components/nav.php" ?>
    <div>
        <?php
        if ($view === 'login') {
            include __DIR__ . '/partials/login-form.php';
        } elseif ($view === 'register') {
            include __DIR__ . '/partials/register-form.php';
        } elseif ($view === 'register') {
            include __DIR__ . '/partials/register-form.php';
        } elseif ($view === 'cart') {
            include __DIR__ . '/partials/cart.php';
        } elseif ($view === 'checkout_success') {
            include __DIR__ . 'partials/checkout-success.php';
        } elseif ($view === 'list') {
            include __DIR__ . '/partials/records-list.php';
        } elseif ($view === 'create') {
            include __DIR__ . '/partials/record-form.php';
        } elseif ($view === 'created') {
            include __DIR__ . '/partials/record-created.php';
        } elseif ($view === 'deleted') {
            include __DIR__ . '/partials/record-deleted.php';
        }
        ?>
    </div>

</body>

</html>