<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script src="<?= base_url() ?>assets/js/jquery-3.6.3.min.js"></script>
    <script src="<?= base_url() ?>assets/js/underscore-umd-min.js"></script>
    <script src="<?= base_url() ?>assets/js/backbone-min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/techSo.css" />
    <title>TechSo</title>
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #145A59;" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?= base_url() ?>index.php">Tech<b>So</b></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <?php if (isset($isLoggedIn) && $isLoggedIn) { ?>
                    <form class="navbar-form navbar-left" action="<?= base_url() ?>index.php/question/search">
                        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Search">
                    </form>
                <?php } ?>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($isLoggedIn) && $isLoggedIn) { ?>
                        <li>
                            <a href="<?= base_url() ?>index.php/auth/account" class="btn btn-primary btn-md"><span class="glyphicon glyphicon glyphicon-user" style="padding-right: 10%;" aria-hidden="true"></span>User</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>index.php/auth/logout">Sign Out</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?= base_url() ?>index.php">Sign up</a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>index.php/auth/login">Sign In</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- <div class="container">
        <div class="Filter" style="position: fixed; top: 15%; left: 0;  height: 10%; width: 100%; z-index: 100; background-color: #F2EAE8;">
            <?php if (isset($isLoggedIn) && $isLoggedIn) { ?>
                <div class="btn-toolbar" style="justify-content: center; display: flex; padding-top: 20px;">
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/question" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Questions</a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/categories" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Categories</a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/ask" class="btn btn-primary btn-md" style="margin-left: 20%"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span> Ask Question</a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div> -->

    <div class="container">
        <?php if (isset($isLoggedIn) && $isLoggedIn) { ?>
            <div class="page-header" style="position: fixed; top: 0; left: 0;  height: 10%; width: 100%; z-index: 100; background-color: #e7e7e7;">
                <div class="btn-toolbar" style="justify-content: center; display: flex; padding-top: 20px;">
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/question" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> Questions</a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/categories" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Categories</a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/ask" class="btn btn-primary btn-md" style="margin-left: 20%"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span> Ask Question</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>