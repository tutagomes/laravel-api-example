@include('common/Header')
<main style='width: 100%; text-align: center' id="app">
<div class="nes-table-responsive" style='padding: 20px; width: 100%'>
  <table class="nes-table is-bordered is-centered"style='width: 100%'>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Desconto</th>
        <th>Preço com Desconto</th>
        <th>Economia de</th>
        <th>Carrinho</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for='pdt in produtos' :key='pdt.id'>
        <td> @{{ pdt.title}}</td>
        <td> @{{ pdt.short_description}}</td>
        <td>R$ @{{ pdt.price}}</td>
        <td> @{{ pdt.discount}}%</td>
        <td>R$ @{{ calculaPrecoComDescontoProduto(pdt)}}</td>
        <td>R$ @{{ calculaEconomia(pdt)}}</td>
        <td style='text-align: center'><button type="button" @click='addToCarrinho(pdt)' class="nes-btn is-primary">+</button></td>
      </tr>    
</tbody>
  </table>
</div>
<div  v-if='carrinho.length > 0'>
<h3>Carrinho</h3>
<div class="nes-table-responsive" style='padding: 20px; width: 100%'>
  <table class="nes-table is-bordered is-centered"style='width: 100%'>
    <thead>
      <tr>
        <th>Nome</th>
        <th>Preço</th>
        <th>Quantidade</th>
        <th>Remover</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for='produto in carrinho' :key='produto ? produto.pdt.id : 0'>
        <td v-if='produto'> @{{ produto.pdt.title}}</td>
        <td v-if='produto'>R$ @{{ calculaPrecoComDescontoProduto(produto.pdt)}}</td>
        <td v-if='produto'> @{{ produto.qnt}}</td>
        <td style='text-align: center' v-if='produto'><button type="button" @click='removeCarrinho(produto)' class="nes-btn is-danger">x</button></td>
      </tr>    
</tbody>
  </table>
  Total do pedido: R$@{{totalPedido}}
</div>
</div>
</main>
<script>
const app = new Vue({
        el: '#app',
        data: {
         produtos: @json($produtos),
         carrinho: [],
         totalPedido: 0
       },
       methods: {
         calculaPrecoComDescontoProduto (pdt) {
           let preco = parseFloat(pdt.price)
           let desconto = parseFloat(pdt.discount)
           return (preco - preco*(desconto/100)).toFixed(2)
         },
         calculaEconomia (pdt) {
           let preco = parseFloat(pdt.price)
           let desconto = parseFloat(pdt.discount)
           return (preco*(desconto/100)).toFixed(2)
         },
         addToCarrinho(pdt) {
           let pedido = {}
           pedido.pdt = pdt
           if (!(pdt.id in this.carrinho)) {
             pedido.qnt = 1
             this.carrinho[pdt.id] = pedido
           } else {
             this.carrinho[pdt.id].qnt ++
           }
           this.$forceUpdate();
           this.calculaTotalPedido()
         },
         removeCarrinho(produto) {
           this.carrinho.splice(produto.pdt.id, 1)
         },
         calculaTotalPedido() {
          let total = 0
          for(let pdt of this.carrinho) {
            if (pdt) {
              total += pdt.pdt.price * pdt.qnt
            }
          }
          this.totalPedido = total.toFixed(2)
         }
       }
     });
</script>
@include('common/Footer')
