<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Blog</title>
</head>
<body>
<div class="container-fluid" id="vue-app">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Blogs</h5>
                    <div class="row">
                        <div class="col-md-4" v-for="blog in blogs" v-if="blog.published">
                            <div class="card">
                                <img :src="blog.preview_image" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{blog.title}}</h5>
                                    <div class="row">
                                        <div class="col-12">
                                            {{blog.description}}
                                        </div>
                                        <div class="col-12">
                                            Author: {{blog.author}}
                                        </div>
                                        <div class="col-12">
                                            Published On: {{blog.date}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary">Read More</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<!--Developement version vue js-->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!--Production version vue js-->
<!--<script src="https://cdn.jsdelivr.net/npm/vue"></script>-->
<script type="text/javascript">
    var app = new Vue({
        el: '#vue-app',
        data: {
            blogs: []
        },
        mounted: function () {
            var self = this;
            $.ajax({
                type: "GET",
                url: "blog_parser.php",
                dataType: "json",
                success: function (response) {
                    if (response) {
                        self.blogs = response;
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr);
                }
            });
        }
    });
</script>
</body>
</html>