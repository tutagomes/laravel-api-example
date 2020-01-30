<template>
  <q-page class="">
      <q-card v-for='pdt in produtos' :key='pdt.id'>
          <q-card-section>{{pdt}}</q-card-section>
      </q-card>
    <q-dialog v-model="criaAnuncio" >
      <q-card style='width: 400px;'>
        <q-card-section>
          <div class="text-h6">Criar Anuncio</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-input v-model='lugar.titulo' label="Titulo"></q-input>
          <q-input v-model='lugar.descricao' label="Descrição"></q-input>
          <q-input v-model='lugar.endereco' label="Endereço"></q-input>
          <q-select filled v-model="lugar.user_id" :options="usersOptions" label="Usuario" />
          <q-input v-model='lugar.price' type='number' label="Preço"></q-input>
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="Criar" color="primary" @click='criarAnuncio()' v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
    <q-dialog v-model="criaRating">
      <q-card style='width: 400px;'>
        <q-card-section>
          <div class="text-h6">Avaliar Anúncio</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-rating
          v-model="review.rating"
        size="1.5em"
        icon="star"
      />
          <q-input v-model='review.descricao' label="Descrição"></q-input>
          <q-select filled v-model="review.user_id" :options="usersOptions" label="Usuario" />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Cancel" color="primary" v-close-popup />
          <q-btn flat label="OK" color="primary" @click='avaliarAnuncio()' v-close-popup />
        </q-card-actions>
      </q-card>
    </q-dialog>
     <div class="row q-col-gutter-md full-width full-height" style='padding-top: 10px; padding-right: 15px'>
         <div class='col-4' v-for='lg in lugares' :key='lg.id' >
           <q-card class="my-card">
      <img :src="imagem">
      <q-card-section>
        <div class="text-h6"> {{lg.titulo}}</div>
        <div class="text-subtitle2"> R$ {{lg.price}}<br>
        {{lg.rating}} <q-rating
        :value="parseInt(lg.rating)"
        size="1.5em"
        icon="star"
      /><q-btn round color="primary" flat icon="add" size='sm' @click="iniciaAvaliacao(lg.id)"/></div>
      </q-card-section>

      <q-card-section class="q-pt-none">
       {{lg.descricao}}
      </q-card-section>
      <q-card-actions>
        <q-list bordered separator v-if='reviews.length > 0' style='width: 100%'>
          <q-item clickable v-ripple v-for='rev in getLugarRatings(lg.id)' :key='rev.id'>
        <q-item-section>
          <q-item-label><div class="text-subtitle2">
        {{rev.rating}} <q-rating
        :value="parseInt(rev.rating)"
        size="1.5em"
        icon="star"
      /></div></q-item-label>
          <q-item-label caption>{{rev.descricao}}</q-item-label>
        </q-item-section>
      </q-item>
        </q-list>
      </q-card-actions>
    </q-card>
    </div>
       </div>
       <q-page-sticky position="bottom-right" :offset="[18, 18]">
            <q-btn round color="accent" icon="add" size='lg' @click='criaAnuncio=true'/>
          </q-page-sticky>
  </q-page>
</template>

<style>
  .my-card {
    min-height: 400px
  }
</style>
<script>
const imageURL = 'https://www.icehotel.com/sites/cb_icehotel/files/styles/image_column_large/public/Kaamos-Johan-Broberg.jpg?h=3c9275bd&itok=gHToh0qO'
const API_URL = 'http://localhost:9000/api'
export default {
  name: 'PageIndex',
  data () {
    return {
      criaAnuncio: false,
      criaRating: false,
      imagem: imageURL,
      reviews: [],
      lugares: [],
      produtos: [],
      users: [],
      review: {
        user_id: 0,
        lugar_id: 0,
        rating: 5,
        descricao: ''
      },
      lugar: {
        titulo: '',
        descricao: '',
        endereco: '',
        user_id: null,
        price: 0
      }
    }
  },
  computed: {
    usersOptions: function () {
      return this.users.map((user) => {
        return {
          value: user.id,
          label: user.email
        }
      })
    }
  },
  created () {
    this.carregaReviews()
    this.carregaLugares()
    this.carregaUsers()
    this.$axios.get('http://localhost:3000/sugestao').then(response => {
      this.produtos = response.data
    })
  },
  methods: {
    getLugarRatings (id) {
      console.log(id)
      return this.reviews.filter((review) => {
        console.log(id + ' - ' + review.lugar_id + ' - ' + (parseInt(review.lugar_id) === id))
        return parseInt(review.lugar_id) === id
      })
    },
    carregaReviews () {
      this.$axios.get(API_URL + '/avaliacoes').then(response => {
        this.reviews = response.data
      })
    },
    carregaLugares () {
      this.$axios.get(API_URL + '/lugares').then(response => {
        this.lugares = response.data
      })
    },
    carregaUsers () {
      this.$axios.get(API_URL + '/users').then(response => {
        this.users = response.data
      })
    },
    iniciaAvaliacao (lugarId) {
      this.review.lugar_id = lugarId
      this.criaRating = true
    },
    avaliarAnuncio () {
      this.review.user_id = this.review.user_id.value
      this.$axios.post(API_URL + '/avaliacoes', this.review).then(response => {
        this.review.descricao = ''
        this.review.rating = 5
        this.review.user_id = null
        this.review.lugar_id = null
        this.carregaLugares()
        this.carregaReviews()
      })
    },
    criarAnuncio () {
      this.lugar.user_id = this.lugar.user_id.value
      this.$axios.post(API_URL + '/lugares', this.lugar).then(response => {
        this.lugar.titulo = ''
        this.lugar.descricao = ''
        this.lugar.endereco = ''
        this.lugar.user_id = null
        this.lugar.price = 0
        this.carregaLugares()
      })
    }
  }
}
</script>
