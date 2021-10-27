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
            width: 15cm;  
            height: 29.7cm; 
            margin: 0 auto; 
            color: #555555;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 14px; 
            font-family: SourceSansPro;
            }

            header {
            padding: 10px 0;
            margin-bottom: 15px;
            border-bottom: 1px  solid #AAAAAA;
            border-bottom-width: 1px;
            }

            #logo {
            float: left;
            margin-top: 8px;
            
            }

            #logo img {
            height: 70px;
            }

            #company {
           
            text-align: right;
            }


            #details {
            margin-bottom: 25px;
            }

            #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            text-align: left;
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

            table td{
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            }

            table th{
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
            }

            
            table td{
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

            .tabla {
                background: #FFFFFF;
                align-content: left;
                margin: 0px;
                
                
            }

            .columna {
                align-items: left;
                text-align: left;
            }


    </style>

  </head>
  <body>
        <!--Encabezado-->
    <header class="clearfix">
        <!--Logo-->  
        <div id="logo">
            <img src="C:\Users\Usuario\Desktop\Trabajo Final\5_Sistema\sistSport\public\img\edificios.jpeg" alt="Logo">
        </div>
        <!--Empresa-->
        <div id="company">
            <h2 class="name">Nombre Empresa: </h2>
            <div>Direccion:</div>
            <div>Telefono:</div>
            <div>Correo:</div>
        </div>
        
    </header>

    <main>
       <div class="clearfix">
            <div id="logo" >
                <div>Generado por:  {{$nombre ?? Auth::user()->name}}</div>
                <div>Fecha:         {{$fecha ?? now()->format('d/m/Y')}}</div>
                <div>Hora:          {{$Hora ?? now()->format(' H:i:s')}}</div>
            </div> 
    
            <div id="company">
                <h2  class="name">Filtro de Categoria</h2>
                <div class="date">Fecha Desde: 01/06/2014</div>
                <div class="date">Fecha Hasta: 30/06/2014</div>
            </div>
       </div>
                    
          
           
     
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">Nombre</th>
        <!--
            <th class="unit">UNIT PRICE</th>
            <th class="qty">QUANTITY</th>
            <th class="total">TOTAL</th>
          </tr>
        -->
        </thead>
        <tbody>
            @foreach ($categorias as $i => $cat)
            <tr>
                <td >{{$i+1}}</td>
                <td class="desc">{{$cat->nombre}}</td>
            </tr>
            @endforeach
        </tbody>
        
      </table>
    </main>
    <script type="text/php">
        if (isset($pdf)) {
            $text = "página {PAGE_NUM} de {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("Arial");
            $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
            $x = ($pdf->get_width() - $width);
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $text, $font, $size);
            
        }
    </script>

  </body>
</html>