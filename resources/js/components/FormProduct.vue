<template>

    <div class="row">
        <div class="col-md-12">

        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row" style="width: 100%">

          <!-- Left col -->
          <div class="col-md-8">
            <!-- MAP & BOX PANE -->
            <div class="card" >
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">

                </div>
            </div>

            <div>
                <select v-model="category_name" style="width: 20%">
                    <option value="">All product</option>
                    <option v-for="cat in category" :value="cat.category">
                        {{ cat.category }}
                    </option>
                </select>
                <input v-model.lazy="search_product" style="width: 20%;" type="text" name="" placeholder="enter for search">
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <a href="#" @click.prevent="change_sort('name')" >Name</a>
                            <span v-if="this.sort_field == 'name' && this.sort_direction == 'asc'">&uarr;</span>
                            <span v-if="this.sort_field == 'name' && this.sort_direction == 'desc'">&darr;</span>
                        </th>
                        <th>
                            <a>category</a>
                        </th>
                        <th>
                            <a>price</a>
                        </th>
                        <th>
                            QuantityStock
                        </th>
                        <th>
                            <a>Action</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="prod in product.data">
                        <td>{{ prod.name.substring(0,15) }}</td>
                        <td>{{ prod.category }}</td>
                        <td>{{ prod.price }}€</td>
                        <td>{{ prod.quantitystock }}</td>
                        <td><button class="btn btn-primary" :value="prod.id" v-on:click="id => add_product_to_cart(id)">Add</button></td>
                    </tr>
                </tbody>
            </table>

            <pagination align="center" :data="product" @pagination-change-page="getResults"></pagination>

        </div>



    </div>
    <!-- /.col -->

    <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Cart Order</h3><br>


            <input type="radio" name="dev" :checked="delivered == '0'" value="0" v-on:click="event => devornot(event)" >
            <label v-if="delivered == '0'">
              Not Delivered [v]
          </label>
          <label v-else>
              Not Delivered
          </label>



          <br>
          <input type="radio" name="dev" :checked="delivered == '1'" value="1" v-on:click="event => devornot(event)">
          <label v-if="delivered == '1'">
            Delivered [v]
        </label>
        <label v-else>
            Delivered 
        </label>
        <br>
        


    </div>

    <!-- TABELLA CART -->
    <table class="table table-striped">
        <thead style="width: auto;">
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in cartorder">
                <td>{{ item.name }}</td>
                <td>
                    <input type="number" :value="item.quantity" :name="item.id"v-on:change="event => AggQProduct(event)" placeholder="press enter to save">
                </td>
                <td>{{ item.price }}</td>
                <td><input type="submit" :name="item.id" v-on:click="event => DelProduct(event)" value="Delete" class="btn btn-danger"></td>
            </tr>
        </tbody>
    </table>
    <div class="card-footer text-center">
        Total: {{ cart_total }}&nbsp;€ <br>
        <input type="submit" v-on:click="SaveCart()" value="Save Status" class="btn btn-primary">
        <a :href="'/admin/order/'+ orderid"class="btn btn-secondary">Back, dont save</a>
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
        //console.log(this.deliveredornot);

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
                //console.log(response);
                this.cartorder = response.data.cart;
                this.cart_total = response.data.cart_total;
            }).catch(error => {
                console.log(error);

            });
        },



        
        
         //index
        /*checkMaxQuantity: function(event){

            axios.get('/orderedit' + '&idproduct=' + event.target.id + '&productnumber=' + event.target.name {


            }).then(response => {
                console.log(response);
                
            }).catch(error => {
                console.log(error);

            });
        },*/

        

        //post store
        add_product_to_cart(id){
            //console.log(id.target.value);
            
            axios.post('/orderedit', {
                product:id.target.value,
                //orderid:this.orderid,


            }).then(response => {
                //console.log(response);
                this.cartorder = response.data.cart;
                this.cart_total = response.data.cart_total;
                this.getResults();
            }).catch(function (error) {

                console.log(error)

            });
        },
        //Update
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
                //console.log(response);
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
                //console.log(response);
                window.location.href = '/admin/order/'+this.orderid+'/edit';
                
                
            }).catch(function (error) {

                console.log(error)

            });

        },

        
    }
}
</script>
