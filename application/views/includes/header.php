<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<head>
    <script src="<?= base_url() ?>assets/js/jquery-3.6.3.min.js"></script>
    <script src="<?= base_url() ?>assets/js/underscore-umd-min.js"></script>
    <script src="<?= base_url() ?>assets/js/backbone-min.js"></script>
    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/techSo.css" /> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>TechSo</title></head>

<body>
<div class="header-bar">
    <div class="container">
        <div class="navbar-left">
            <a class="navbar-brand" href="<?= base_url() ?>index.php">Tech<b>So</b></a>
            <!-- <?php if (isset($isSignedIn) && $isSignedIn) { ?>
                <form class="form-inline" action="<?= base_url() ?>index.php/question/search">
                    <input class="form-control" id="keyword" type="text" name="keyword"  placeholder="Search for question">
                </form>
            <?php } ?> -->
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($isSignedIn) && $isSignedIn) { ?>
                <li>
                    <a id="show-notifications-btn" href="#"><span class="glyphicon glyphicon-envelope"></span>Notification</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>index.php/auth/userAccount"><span class="glyphicon glyphicon glyphicon-user"></span>Account</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>index.php/auth/signout">Logout</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="<?= base_url() ?>index.php/auth/signin">Login</a>
                </li>
                <li>
                    <a href="<?= base_url() ?>index.php">Register</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
    <!-- <div class="container">
        <div class="Filter" style="position: fixed; top: 15%; left: 0;  height: 10%; width: 100%; z-index: 100; background-color: #F2EAE8;">
            <?php if (isset($isSignedIn) && $isSignedIn) { ?>
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
        <?php if (isset($isSignedIn) && $isSignedIn) { ?>
            <div class="page-header" style="position: fixed; top: 0; left: 0;  height: 10%; width: 100%; z-index: 100; background-color: #e7e7e7;">
                <div class="btn-toolbar" style="justify-content: space-between; display: flex; padding-top: 20px;">
                    <div class="col-md-2" style='padding-left:120px'>
                        <a href="<?= base_url() ?>index.php/question/question" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span> All Questions</a>
                    </div>
                    <div class="col-md-7">
                        <?php if (isset($isSignedIn) && $isSignedIn) { ?>
                            <form class="form-inline" action="<?= base_url() ?>index.php/question/search">
                                <input class="form-control" id="keyword" type="text" name="keyword"  placeholder="Search for question">
                            </form>
                        <?php } ?>
                    </div>
                    <div class="col-md-1">
                        <a href="<?= base_url() ?>index.php/question/categories" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Categories</a>
                    </div>
                    <div class="col-md-2">
                        <a href="<?= base_url() ?>index.php/question/ask" class="btn btn-primary btn-md" style="margin-left: 20%"><span class="glyphicon glyphicon-hand-up" aria-hidden="true"></span> Ask New Question</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="modal" id="notification-modal" tabindex="-1" role="dialog" >
    <div class="modal-dialog" style="position: absolute; top: 3%; right: 3%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >Notifications</h4>
            </div>
            <div class="modal-body">
                <?php
                if ($notifications) {
                    foreach ($notifications as $notification) {
                ?>
                        <div class="notification">
                            <h5>New answer added</h5>
                            <p><strong>Question title:</strong> <?= $notification->questionTitle ?></p>
                            <p><strong>Question description:</strong> <?= $notification->questionDescription ?></p>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>No new notifications.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function(){
        console.log('dfddf')
        $('#show-notifications-btn').on('click', function(e) {
            e.preventDefault();
            console.log('working')
            $('#notification-modal').modal('show');
        });
    });
    </script>