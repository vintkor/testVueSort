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
                        <input v-on:click="sort('default')" type="radio" name="sort" checked> default
                    </label>
                    <label class="radio-inline">
                        <input v-on:click="sort('date')" type="radio" name="sort"> date
                    </label>
                    <label class="radio-inline">
                        <input v-on:click="sort('price')" type="radio" name="sort"> price
                    </label>
                    <label class="radio-inline">
                        <input v-on:click="sort('title')" type="radio" name="sort"> title
                    </label>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 text-center" v-for="product in products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">{{ product.title }}</h2>
                    </div>
                    <div class="panel-body">
                        <h5 class="text-danger">{{ product.price }}</h5>
                        <button class="btn btn-success" @click="moreInfo(product.id)">More info</button>
                    </div>
                    <div class="panel-footer">
                        {{ product.date }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-wrapper" v-if="showMoreInfo">
        <div class="modal-content">
            <div class="modal-close text-right">
                <button class="btn btn-danger" @click="modalClose">Close</button>
            </div>
            <div class="modal-header text-center">
                <h1>{{ singleProduct.title }}</h1>
            </div>
            <div class="modal-body text-center">
                <h1 class="price text-danger">{{ singleProduct.price }}</h1>
            </div>
            <div class="modal-footer text-center">
                <p class="date">{{ singleProduct.date }}</p>
            </div>
        </div>
    </div>

</div>



<!--suppress JSAnnotator -->
<script>


    var app = new Vue({
        el: '#app',
        data: {
            products: [],
            showMoreInfo: false,
            singleProduct: {}
        },
        methods: {
            sort: function (sortMethod) {
                this.$http.get('/getproducts.php?sort=' + sortMethod).then(
                    function(success){
                        this.products = success.body;
                    },
                    function(error){
                        console.log(error);
                    }
                );
            },
            moreInfo: function (id) {
                this.getSingleProduct(id);
                this.showMoreInfo = !this.showMoreInfo;
            },
            modalClose: function () {
                this.singleProduct = null;
                this.showMoreInfo = !this.showMoreInfo;
            },
            getSingleProduct: function (id) {
                this.$http.get('/getproducts.php?id=' + id).then(
                    function (success) {
                        this.singleProduct = success.body;
                    },
                    function (error) {
                        console.log(error);
                    }
                );
            }
        },
        created: function () {
            this.sort('id');
        }
    });
</script>

<style>
    .btn,
    .btn:focus,
    .btn:active {
        outline: none;
    }
    .modal-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,.5);
        padding: 10em;
    }
    .modal-content {
        background: #fff;
        width: 100%;
        height: 100%;
        position: relative;
        padding: 2em;
    }
</style>

</body>
</html>