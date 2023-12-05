<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Example 2</title>
    <style>
      @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 18cm;
  height: 29.7cm;
  margin: 0 auto;
  color: #555555;
  background: #FFFFFF;
  font-family: Arial, sans-serif;
  font-size: 14px;
  font-family: SourceSansPro;
}
body .right {
			float: right;
		}

header {
  padding: 10px 0;
  margin-bottom: 17px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #0087C3;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;
  font-weight: normal;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #57B223;
}

table .desc {
  text-align: left;
}

table .unit {
  background: #DDDDDD;
}

table .qty {
}

table .total {
  background: #57B223;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap;
  border-top: 1px solid #AAAAAA;
}

table tfoot tr:first-child td {
  border-top: none;
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223;

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img  src="" height="120px" width="120px">
      </div>

      <div class="data right">
        <h1 class="title">NO.{{$sale->number_sale}}</h1>
        <div class="date">
            Fecha: {{$sale->created_at}}
        </div>
    </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">Para:</div>
          <h2 class="name">{{$sale->client->name}}</h2>
          <div class="address">7227502365</div>
          <div class="email"><a href="{{$sale->client->email}}">{{$sale->client->email}}</a></div>
          <div class="address">Estatus:  @if ($sale->status == 'paid')
            <span class="badge badge-pill badge-success" >
              <i class="bg-success"></i> Pagado
            </span>
           @else
            <span class="badge badge-pill badge-danger" >
              <i class="bg-danger"></i> No pagado
           </span>
            @endif</div>
    </div>
        <div class="data right">
          <h2 class="name">Taco Santo</h2>
          <div>Ignacio Pérez 821,Vértice,50090,</div>
          <div>Toluca de Lerdo,Mexico</div>
          <div><a href="mailto:contacto@tacosanto.com">contacto@tacosanto.com</a></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">Producto</th>
            <th class="unit">Precio unitario</th>
            <th class="qty">Cantidad</th>
            <th class="total">Precio final</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($sale->products as $key => $sales)
          <tr>
            <td class="no">{{ $key+1 }}</td>
            <td class="desc"><h3>{{ $sales->product_name }}</h3></td>
            <td class="unit">{{ $sales->sale_price }}</td>
            <td class="qty">{{ $sales->pivot->quantity}}</td>
            <td class="total">${{ $sales->pivot->quantity * $sales->sale_price}}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>${{ $sale->total }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">IVA</td>
            <td>${{ $sale->iva_sale }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>${{ $sale->total_amount }}</td>
          </tr>
        </tfoot>
      </table>
      <!--
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
-->
  </body>
</html>
