<?php

try {

    $db = new PDO('mysql:host=127.0.0.1:8889;dbname=hh', 'root', 'root');

} catch ( PDOException $d ) {

    print "Error!: " . $e->getMessage();
    die();

}


if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    foreach ( $_POST as $k => $v ) {

        $$k = trim(strip_tags($v));

    }

    $date = date("Y-m-d");

    $sql = "INSERT INTO comments (comment, name, email, date) VALUES (:comment, :name, :email, :date)";

    $stmt = $db->prepare($sql);

    if ( !$stmt->execute([
        ':comment' => $comment,
        ':name' => $name,
        ':email' => $email,
        ':date' => $date
    ]) ) {
        print_r($stmt->errorInfo());
    }

} else {

    $sql = "SELECT * FROM comments";

    $stmt = $db->query($sql);

    $comments = $stmt->fetchAll();


    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Complete Bootstrap 4 Website Layout</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
        <link
                rel="stylesheet"
                href="https://pro.fontawesome.com/releases/v6.0.0-beta1/css/all.css"
        >
        <link href="style.css" rel="stylesheet">

    </head>
    <div>

        <!-- NavBar -->
        <nav class="navbar navbar-dark top-menu d-flex justify-content-sm-center justify-content-md-start">
            <a class="navbar-brand" href="/">
                <img class="logo" src="img/logo.png">
            </a>
        </nav>
        <!-- End NavBar -->
        <!-- TopMenu -->
        <div class="container-fluid header">
            <div class="row justify-content-center">
                <div class="rounded-circle col d-flex justify-content-center">
                    <img class="mail image-fluid" src="img/mail.png">
                </div>
            </div>
            <form>
                <div class="row">
                    <div class="col-md-6 h-100">
                        <div class="col-12">
                            <div id="name-group" class="form-group">
                                <label id="name-label" class="label" for="name">
                                    Имя <i class="fal fa-xs fa-asterisk asterics" aria-hidden="true"></i>
                                </label>
                                <input type="text" class="form-control input" id="name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="email-group" class="form-group">
                                <label id="email-label" class="label" for="email">
                                    E-mail <i class="fal fa-xs fa-asterisk asterics" aria-hidden="true"></i>
                                </label>
                                <input type="email" class="form-control input" id="email">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 h-100">
                        <div class="col-12">
                            <div id="comment-group" class="form-group">
                                <label id="comment-label" class="label" for="comment">
                                    Комментарий <i class="fal fa-xs fa-asterisk asterics" aria-hidden="true"></i>
                                </label>
                                <textarea class="form-control textarea" id="comment"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 d-flex write justify-content-md-end justify-content-sm-center">
                        <input type="submit" id="submit" class="write-btn btn btn-danger" value="Записать" >
                    </div>
                </div>
            </form>
        </div>
        <!-- End TopMent -->
        <!-- Comments section -->
        <div class="container comments">
            <div class="row ">
                <div class="col">
                    <h3 class="comments-title display-6  text-center">
                        Выводим комментарии
                    </h3>
                </div>
            </div>
            <div class="row comments-list">
                <?php foreach ( $comments as $comment ): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2><?=$comment['name']?></h2>
                        </div>
                        <div class="card-body">
                            <div class="col-12 text-center">
                                <h4><?=$comment['email']?></h4>
                            </div>
                            <div class="col-12  text-center">
                                <p class="lead"><?=$comment['comment']?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- End Comments Section -->
        <!-- Footer -->
        <div class="wrapper footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-12 d-flex justify-content-center justify-content-md-start">
                        <a class="navbar-brand" href="/">
                            <img class="logo" src="img/logo.png">
                        </a>
                    </div>
                    <div class="col-md-5 col-12 icons d-flex justify-content-center">
                        <span class="icon"><i class="fb fab fa-circle-thin fa-facebook-f" aria-hidden="true"></i></span>
                        <span class="icon"><i class="vk fa-circle-thin fab fa-vk" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#submit').click(function (e) {

                $('#error').remove();

                var name = $('#name').val();
                var email = $('#email').val();
                var comment = $('#comment').val();

                if (name == "") {

                    var error = '<p id="error">Поле обязательно для заполнения!</p>';

                    $('#name-label').before(error);

                    return false;

                }
                if (email == "") {

                    var error = '<p id="error">Поле обязательно для заполнения!</p>';

                    $('#email-label').before(error);

                    return false;

                }
                if (comment == "") {

                    var error = '<p id="error">Поле обязательно для заполнения!</p>';

                    $('#comment-label').before(error);

                    return false;

                }
                alert('We are here' + name + email + comment);

                $.ajax({
                    type: "POST",
                    url: "",
                    data: {
                        email: email,
                        name: name,
                        comment: comment,
                    }
                }).done(function (msg) {
                    location.reload()

                });
                e.preventDefault()

            });

        });
    </script>
    </body>
    </html>
    <?php

}

