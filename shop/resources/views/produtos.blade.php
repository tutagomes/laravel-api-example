@include('common/Header')
<main style='width: 100%; text-align: center'>
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
@foreach ($produtos as $pdt)
      <tr>
        <td>{{$pdt->title}}</td>
        <td>{{$pdt->short_description}}</td>
        <td>R${{$pdt->price}}</td>
        <td>{{$pdt->discount}}%</td>
        <td>R${{$pdt->precoComDesconto()}}</td>
        <td>R${{$pdt->economiaDe()}}</td>
        <td style='text-align: center'><button type="button" class="nes-btn is-primary">+</button></td>
      </tr>    
@endforeach
</tbody>
  </table>
</div>
</main>
@include('common/Footer')
