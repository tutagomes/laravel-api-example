<template>
  <q-page class="flex">
       <div class="row q-col-gutter-md full-width full-height" style='padding-top: 10px;'>
         <div class='col-3' v-for='pdt in produtos' :key='pdt.id' >
    <q-card style='height: 300px'>
      <q-card-section>
        {{pdt.title}}
      </q-card-section>
      <q-card-section>
        {{pdt.price}}
      </q-card-section>
    </q-card>
    </div>
       </div>
       <div class="row q-col-gutter-md full-width full-height" style='padding-top: 10px;'>
         <div class='col-3' v-for='pdd in pedidos' :key='pdd.id' >
    <q-card style='height: 300px'>
      <q-card-section>
        {{pdd.produtos}}
      </q-card-section>
      <q-card-section>
        {{pdd.user}}
      </q-card-section>
    </q-card>
    </div>
       </div>
  </q-page>
</template>

<script>
const API_URL = 'http://localhost:8000/api'
// axios.defaults.headers.common['Authorization'] = 'Bearer test';

export default {
  name: 'PageIndex',
  data () {
    return {
      produtos: [],
      pedidos: [],
      produto: {
        title: '',
        short_description: '',
        long_description: '',
        price: 0,
        inventory: 0,
        discount: 0
      },
      pedido: {
        produtos: [],
        status: 0
      }
    }
  },
  created () {
    this.carregaProdutos()
    this.carregaPedidos()
  },
  methods: {
    carregaProdutos () {
      this.$axios.get(API_URL + '/produtos').then(response => {
        this.produtos = response.data.data
      })
    },
    carregaPedidos () {
      this.$axios.get(API_URL + '/pedidos').then(response => {
        this.pedidos = response.data
      })
    }
  }
}
</script>
