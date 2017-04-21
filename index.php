<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/paper/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
    <title>Filter</title>
</head>
<body>
<div id="app">
    <div class="container">
        <h1 class="text-center">Test sort</h1>
        <hr>
        <div class="row text-center">
            <div class="col-md-12">
                <form id="sort" action="/" method="get">
                    <label class="radio-inline">
                        <input v-on:click="getId" type="radio" name="sort" id="default" value="id" checked> default
                    </label>
                    <label class="radio-inline">
                        <input v-on:click="getDate" type="radio" name="sort" id="date" value="date"> date
                    </label>
                    <label class="radio-inline">
                        <input v-on:click="getPrice" type="radio" name="sort" id="price" value="price"> price
                    </label>
                    <label class="radio-inline">
                        <input v-on:click="getTitle" type="radio" name="sort" id="title" value="title"> title
                    </label>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <ess JSAnno"col-md-3 text-center" v-for="product in products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">{{ product.title }}</h2>
                    </div>
                    <div class="panel-body">
                        <h5 class="text-danger">{{ product.price }}</h5>
                        <button class="btn btn-success">More info</button>
                    </div>
                    <div class="panel-footer">
                        {{ product.date }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--suppress JSAnnotator -->
<script>
    var app = new Vue({
        el: '#app',
        data: {
            products: []
        },
        methods: {
            getId: function () {
                this.fetchResponce('id');
            },
            fetchResponce: function (sort) {
                this.$http.get('/getproducts.php?sort=' + sort).then(
                    responce => {
                        this.products = responce.body;
                    }, responce => {
                        console.log('error');
                    }
                );
            },
            getTitle: function () {
                this.fetchResponce('title');
            },
            getPrice: function () {
                this.fetchResponce('price');
            },
            getDate: function () {
                this.fetchResponce('date');
            }
        },
        created: function () {
            this.fetchResponce('id');
        }
    });
</script>

</body>
</html>