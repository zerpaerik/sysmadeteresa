<head>
    <style type="text/css">
      {
        margin: 0;
        padding: 0;
      }
      .table-main{
       margin-left:-55px;
       margin-right:-56px;
      }
      .truncate {
        width: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      @page {
        header: page-header;
        footer: page-footer;
      }
      footer {
        border:solid red;
      }
    </style>

    <meta charset="utf-8">

  </head>

    <body>

    <br><br>

    <div  style="font-size: 15px; text-align: center;margin-bottom:-60px;margin-top: -30px;">
		<p><strong>MADRE TERESA SAC- {{Session::get('sedeName')}}</strong></p>
		@if(Session::get('sedeName') == 'ZARATE')
		<p style="margin-top: -20px;"><strong>RUC: 20492126072</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20600971116</strong></p>
	    <p style="margin-top: -20px;"><strong>DIRECCIÒN: Av Gran Chimú 745 Zarate, San Juan de Lurigancho</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 940 314 839</strong></p>
		@else
		<p style="margin-top: -20px;"><strong>RUC: 20606283980</strong></p>
	    <p style="margin-top: -20px;"><strong>DIRECCIÒN: Av Próceres de la independencia 1781 3er piso SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono: 01 3764637</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 942 066 567</strong></p>
		@endif
	
	   <p style="margin-top: -20px;"><strong>NÚMERO DE RECIBO ELECTRÓNICO:{{ $ticket->id}}</strong></p>

	</div>
    <br><br>
    <br><br>


    <div  style="font-size: 15px; text-align: left;margin-bottom:-60px;margin-top: -30px;">
    <p><strong>FECHA:</strong> {{ date('d/m/Y h:i a', strtotime($ticket->created_at)) }} </p>
	<p><strong>PACIENTE:</strong> {{ $ticket->nombres}},{{ $ticket->apellidos}} DNI:{{$ticket->dni}}</p>
	
	</div>
  <br><br><br>

    <table width="100%" class="table-main">
      <thead>
        <tr>
          <th style="font-size: 15px; width=33px;"><center>Det.<center></th>
          <th style="font-size: 15px; width=33px;"><center>Monto.<center></th>
          <th style="font-size: 15px; width=33px;"><center>Abono.<center></th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td style="font-size: 13px; line-height: 30px;width=33px;margin-left:115px;" align="center">{{ $ticket->detalle}}</td>
            <td style="font-size: 15px; line-height: 30px;width=33px;margin-left:5px;" align="center">{{ $ticket->monto}}</td>
            <td style="font-size: 15px; line-height: 30px;width=33px;margin-left:5px;" align="center">{{ $ticket->abono}}</td>

          </tr>
      </tbody>
    </table>

    <br>

    <table width="100%">
      <tbody>
        <tr>
          <td style="width: 100%;">
            <table width="100%">
              <tbody>

			  <tr>
                      <td align="left" style="font-size: 15px">VALOR PENDIENTE</td>
                      <td align="right" style="font-size: 15px">{{ $ticket->pendiente}}</td>
                    </tr>
                   

                    <tr>
                      <td align="left" style="font-size: 15px">VALOR TOTAL</td>
                      <td align="right" style="font-size: 15px">{{ $ticket->monto}}</td>
                    </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

    

    </body>

