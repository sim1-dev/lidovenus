<template>

    <div class="row">
        <div class="col-md-12">

        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row" style="width: 100%">

          <!-- Left col -->
          <div class="col-md-7">
            <!-- MAP & BOX PANE -->
            <div class="card" >
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">

                </div>
            </div>

            <div>
                <select class="form-control w-50 m-0 float-left" v-model="category_name">
                    <option value="">Tutti i prodotti</option>
                    <option v-for="cat in category" :value="cat.category">
                        {{ cat.category }}
                    </option>
                </select>
                <input v-model.lazy="search_product" class="form-control w-50 m-0 float-left" type="text" name="" placeholder="Cerca">
            </div>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>
                            <a href="#" @click.prevent="change_sort('name')" >Nome</a>
                            <span v-if="this.sort_field == 'name' && this.sort_direction == 'asc'">&uarr;</span>
                            <span v-if="this.sort_field == 'name' && this.sort_direction == 'desc'">&darr;</span>
                        </th>
                        <th>
                            <a>Categoria</a>
                        </th>
                        <th>
                            <a>Prezzo</a>
                        </th>
                        <th>
                            Quantità
                        </th>
                        <th>
                            <a>Azioni</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="prod in product.data">
                        <td>{{ prod.name.substring(0,15) }}</td>
                        <td>{{ prod.category }}</td>
                        <td>{{ prod.price }}€</td>
                        <td>{{ prod.quantitystock }}</td>
                        <td><button class="btn btn-primary" :value="prod.id" v-on:click="id => add_product_to_cart(id)">AGGIUNGI AL CARRELLO</button></td>
                    </tr>
                </tbody>
            </table>

            <pagination align="center" :data="product" @pagination-change-page="getResults"></pagination>

        </div>



    </div>
    <!-- /.col -->

    <div class="col-md-5">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ordine</h3><br>


            <input type="radio" name="dev" :checked="delivered == '0'" value="0" v-on:click="event => devornot(event)" >
            <label v-if="delivered == '0'">
              Non Consegnato [v]
          </label>
          <label v-else>
              Non Consegnato
          </label>



          <br>
          <input type="radio" name="dev" :checked="delivered == '1'" value="1" v-on:click="event => devornot(event)">
          <label v-if="delivered == '1'">
            Consegnato [v]
        </label>
        <label v-else>
            Consegnato
        </label>
        <br>



    </div>

    <!-- TABELLA CART -->
    <table class="table table-striped">
        <thead class="thead-light"  style="width: auto;">
            <tr>
                <th scope="col">Prodotto</th>
                <th scope="col">Quantità</th>
                <th scope="col">Prezzo</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in cartorder">
                <td>{{ item.name }}</td>
                <td>
                    <input type="number" class="form-control" :value="item.quantity" :name="item.id"v-on:change="event => AggQProduct(event)" placeholder="press enter to save">
                </td>
                <td>{{ item.price }}</td>
                <td><input type="submit" :name="item.id" v-on:click="event => DelProduct(event)" value="RIMUOVI" class="btn btn-danger"></td>
            </tr>
        </tbody>
    </table>
    <div class="card-footer text-center">
        Totale: <b>{{ cart_total }}&nbsp;€ </b><br>
        <a :href="'/admin/order/'+ orderid"class="btn btn-secondary">TORNA INDIETRO</a>
        <input type="submit" v-on:click="SaveCart()" value="SALVA" class="btn btn-primary">
    </div>


</div>

<div class="card">

</div>

</div>


</div>
</div>



</template>

<script>
export default {
    props:['orderid','token','delivered'],
    data(){
        return{
            product:{},
            category:{},
            category_name:'',
            sort_field:'name',
            sort_direction:'desc',
            search_product:'',
            cartorder:{},
            cart_total:'',
            selected: '',
            deliveredornot:'',
            quantityproducts:'',
        }
    },
    mounted(){
        axios.get('/api/product_category')
        .then(response => {
            this.category = response.data;
        });

        this.getResults();

        axios.get('/api/product').then(response => {
            this.product = response.data;
        });

        this.deliveredornot = this.delivered;

        this.loadCartConstruct();
        //this.loadCart();
    },
    watch:{
        category_name(value) {
            this.getResults();
        },
        search_product(value) {
            this.getResults();
        },

    },

    methods: {
        change_sort(field){
            if (this.sort_field === field) {
                this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc';
            } else{
                this.sort_field = field;
                this.sort_direction = 'asc';
            }
            this.getResults();
        },
        // Our method to GET results from a Laravel endpoint
        getResults(page = 1) {
            axios.get('/api/product?page=' + page
                + '&category_name=' + this.category_name
                + '&sort_field=' + this.sort_field
                + '&sort_direction=' + this.sort_direction
                + '&search_product=' + this.search_product
                )
            .then(response => {
                this.product = response.data;
            });
        },

        //create
        loadCartConstruct: function(){

            axios.get('/orderedit/create?orderid=' + this.orderid, {
            }).then(response => {
                this.cartorder = response.data.cart;
                this.cart_total = response.data.cart_total;
            }).catch(error => {
                console.log(error);

            });
        },

        //post store
        add_product_to_cart(id){
            axios.post('/orderedit', {
                product:id.target.value,



            }).then(response => {
                this.cartorder = response.data.cart;
                this.cart_total = response.data.cart_total;
                this.getResults();
            }).catch(function (error) {

                console.log(error)

            });
        },
        //update
        AggQProduct: function(event){

            axios.put('/orderedit/'+ event.target.name, {
                numberproduct:event.target.value,
                orderid:this.orderid,


            }).then(response => {
                console.log(response);
                this.cartorder = response.data.cart;
                this.cart_total = response.data.cart_total;
                this.getResults();
            }).catch(function (error) {

                console.log(error)

            });


        },

        //delete
        DelProduct:function(value){

            axios.post('/deleteproduct/'+ event.target.name, {
                orderid:this.orderid,
            }).then(response => {
                this.cartorder = response.data.cart;
                this.cart_total = response.data.cart_total;
                this.getResults();
            }).catch(function (error) {

                console.log(error)

            });

        },

        //savecart route Edit
        devornot:function(value){
            this.deliveredornot = event.target.value;
            console.log(this.deliveredornot);
        },


        SaveCart:function(value){

            axios.put('/saveCart/'+ this.orderid, {
                delivered:this.deliveredornot,

            }).then(response => {
                window.location.href = '/admin/order/'+this.orderid+'/edit';


            }).catch(function (error) {

                console.log(error)

            });

        },


    }
}
</script>
