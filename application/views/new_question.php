<div class="container">
    <h2>Ask Question</h2>

    <form id="new-question-form" class="form-horizontal" role="form">
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">Question Title</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="title" placeholder="Title of the Question">
            </div>
        </div>

        <div class="form-group">
            <label for="category" class="col-sm-2 control-label">Question Category</label>
            <div class="col-sm-9">
                <select id="category">
                    <?php
                    if ($categories) {
                        foreach ($categories as $category) {
                    ?>
                            <option value="<?= $category->name ?>"><?= $category->name ?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <!-- <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true"> Dropdown <span class="caret"></span> </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a> </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a> </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a> </li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a> </li>
                    </ul>
                </div> -->
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Question Description</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="description" placeholder="Write your Question Briefly"></textarea>
            </div>
        </div>

        <!-- <div class="form-group">
            <label for="tags" class="col-sm-1 control-label">Tags</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tags" placeholder="Tags">
            </div>
        </div> -->

        <div class="form-group">
            <div class="col-sm-offset-1 col-sm-10">
                <a id="post-btn" class="btn btn-primary">Post</a>
            </div>
        </div>
    </form>
</div>

<script>
    // Defining the Question model
    let Question = Backbone.Model.extend({
        // Defining the default attributes for a question
        defaults: {
            title: '',
            category: '',
            description: ''
        },

        // Defining the validation rules for the model
        validate: function(attributes) {
            if (!attributes.title) {
                return 'Title is required';
            }
        },

        // Defining the URL where the model should be sent
        url: '<?= base_url() ?>index.php/question/question'
    });

    // Defining the QuestionForm View
    let QuestionViewForm = Backbone.View.extend({
        el: '#new-question-form',

        // Defining the events for the view
        events: {
            'click #post-btn': 'postQuestion'
        },

        // Defining the submitQuestion function
        postQuestion: function() {
            let question = new Question({
                title: this.$('#title').val(),
                category: this.$('#category').val(),
                description: this.$('#description').val()
            });

            question.save({}, {
                success: function(model, response) {
                    let jsonResponse = JSON.parse(response);
                    if (jsonResponse.status === 'success') {
                        window.location.href = '<?= base_url() ?>index.php/question/question/id/' + jsonResponse.data.questionId;
                    }
                },
                error: function(model, response) {
                    let jsonResponse = JSON.parse(response.responseText);
                    console.log(jsonResponse.message);
                }
            });
        }
    });

    // Instantiating the QuestionForm View
    let questionViewForm = new QuestionViewForm();
</script>