<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="row">
                         <div class="col-xs-12">
                            <div class="box" style="padding-top: 30px">
                                <div class="dataTables_length" id="example1_length">
                                    <label style="display: inline-flex !important; ">
                                        <div style="width: 500px;"> مرتب سازی بر اساس نوع منبع یابی :</div>
                                        <select name="example1_length" aria-controls="example1" class="form-control input-sm" v-model="sort" @change="getSortedProduct">
                                            <option value="طلایی">طلایی</option>
                                            <option value="نقره ای">نقره ای</option>
                                            <option value="برنزی">برنزی</option>
                                        </select>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                sort : ''
            }
        },
        mounted() {
            getSortedProduct: function(){
                this.products =[];
                axios.get('/api/sort-products/' + this.category.id + '/' + this.sort+ '/' +'?page=' + pageNum).then(res => {
                    this.products = res.data.products
                }).catch(err =>{
                    console.log(err)
                })
            }
        }
    }
</script>
