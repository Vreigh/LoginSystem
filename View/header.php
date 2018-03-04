<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="public/css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="public/js/main.js"></script>
</head>

<body>
    <?php \Model\User::isAuth() ? print("<a href= \"" . \Helpers\UriManager::getUrl('users/logout') . "\">Wyloguj</a>") : "" ?>

