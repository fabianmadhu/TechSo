<style>
    .box {
        border: 1px solid #ccc;
        margin-bottom: 15px;
        border-radius: 6px;
        border-color: #007bff;
        background-color: #f8f9fa;
    }

    .box-higher,
    .box-lower {
        padding: 10px;
    }

    .box-content{
        padding: 15px;
    }

    /* Adding space between the cards */
    .col-md-4 {
        padding-right: 15px;
        padding-left: 15px;
    }

    .label-hover:hover {
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }
</style>

<div class="container">
    <div class="row">
        <h2 style="padding-left: 20px">Available Categories </h2>

        <?php if ($categories) {
            

            foreach ($categories as $category) {
                 ?>

                <div class="col-md-10">
                    <div class="box" >
                        <a href="<?= base_url() ?>index.php/question/question/category/<?= $category->name ?>">
                            <div class="box-higher">
                                <span class="label label-primary label-hover">
                                    <?= $category->name ?>
                                </span>
                            </div>
                        </a>

                        <div class="box-content">
                            <?= $category->description ?>
                        </div>

                        <div class="box-lower">
                            <?= $category->questionCount ?> questions available
                        </div>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</div>