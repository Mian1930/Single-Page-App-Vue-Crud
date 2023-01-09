<template>
    <div>
         <h3 class=""><b>Create Product</b></h3>
       
                    <div class="form-group">
                        <label>Name</label>
                <input type="text" class="form-control" v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label>Detail</label>
                        <input type="text" class="form-control" v-model="product.detail" >
                    </div>
                    <button type="submit"  @click.prevent="addProduct" method="POST" class="btn btn-primary mt-3" v-if="show == true">Create </button>
                     <button type="sumbit" @click="updateProduct(product.id)"  style="margin-left:20px"  v-if="!show" >Update </button> 
                    <button type="sumbit" @click="Cancel"   style="margin-left:20px" v-if="!show"  >Cancel </button>
        <h2 class=""><b>Products List</b></h2>
 
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in products" :key="item.id" >
                <td>{{ item.id }}</td>
                <td>{{ item.name }}</td>
                <td>{{ item.detail }}</td>
                <td>
                    <div class="btn-group" role="group" >
                         <button  class="btn btn-success" @click="editProduct(item.id)" :style="{marginRight:my}">Edit
                         </button>
                         
                        <button class="btn btn-danger" @click="deleteProduct(item.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <button @click="sendEmail">Send Email</button>
    </div>
</template>
<script>
import axios from 'axios';
    export default {
        name:"AllProduct",
        data() {
            return {
                product:{
                    // name:'',
                    // detail:''
                },
                products: [],
                my:"10px",
                show:true,
                
                
            }
        },
        mounted() {
            
                axios.get('/api/products/')
                .then(response => {
                    console.log(response)
                     this.products = response.data.products;
                    
                });
        },

        methods: {
           async deleteProduct(id) { 
            // using promises method AWAIT
             try {
      const response = await axios.delete(`/api/products/${id}`);
       let i = this.products.map(data => data.id).indexOf(id);
       this.products.splice(i, 1)
    } catch (error) {
      console.error(error);
    }
    // using axios and .then
                    // axios.delete(`/api/products/${id}`)
                    // .then(response => {
                    //     let i = this.products.map(data => data.id).indexOf(id);
                    //     this.products.splice(i, 1)
                    // });
            },
           async addProduct() {
            try {
      const response = await axios.get('/api/products', this.product);
      console.log(response)
      this.products.push(this.product)
    } catch (error) {
      console.error(error);
    }
            //       await axios.post('/api/products', this.product)
            //         // .then(response => {
            //         //     console.log(response),
            //         //     console.log(this.products,typeof this.products);
            //         //     console.log(Array.isArray(this.products))
            //    this.products.push(this.product),
            //             alert("product is created")
            // })
                    // .finally(() => this.loading = false)
            },
             async updateProduct(id) {
                try {
      const response = await axios.patch(`/api/products/${id}`, this.product);
      let i=this.products.map(data=>data.id).indexOf(id)
                       this.products.splice(i,1,this.product)
    } catch (error) {
      console.error(error);
    }
                    // axios.patch(`/api/products/${id} `, this.product,)
                    // .then((res) => {
                    //     let i=this.products.map(data=>data.id).indexOf(id)
                    //     this.products.splice(i,1,this.product)
                    //    console.log(res,'azan')
                    // });
            },
            async editProduct(id){
              console.log(this.products);
                this.show = false;
                const value = this.products.find (item=>item.id === id)
                  this.product = JSON.parse(JSON.stringify(value));
            },
           async Cancel(){
            this.product={}
            },
            sendEmail() {
      axios.post('/send-email')
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  
        }
    }
</script>
<style scoped>

</style>