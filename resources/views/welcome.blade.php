<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <link href="<?= asset('css/app.css') ?>" rel="stylesheet">
        
    </head>
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
                 <?php

                        if(Session::has('Errmsg'))  echo '<p class="err">'.Session::get('Errmsg').'</p>';

                        ?>
                <form method="post" action='<?= route('post-login') ?>' id="loginForm">
                    {{ csrf_field() }}
                    <div class="err"></div>
                  <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username">
                  <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
                  <input type="submit" class="fadeIn fourth" value="Log In">
                </form>
            </div>
        </div>
    </body>
</html>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?= asset('js/app.js') ?>"></script>
