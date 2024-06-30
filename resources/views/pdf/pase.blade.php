<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pase Boda</title>
    <style>
        @page { margin: 0px; }

        @font-face {
            font-family: 'GreatVibes';
            src: url({{ storage_path('fonts/GreatVibes-Regular.ttf') }});
        }

        @font-face {
            font-family: 'Cinzel';
            src: url({{ storage_path('fonts/Cinzel.ttf') }});
        }

        body {
            position: relative;
            margin: 0px;
            background-image: url("{{ asset('images/boda-pase.jpg') }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: 0 0;
            width: 100%;
            height: 100%;
        }

        .nombre-novios {
            font-family: 'GreatVibes';
            text-align: center;
            color: #F9A9AC;
            font-size: 80px;
            font-weight: 400;
            line-height: 0.8;
        }

        .container {
            display: table;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
        .center {
            margin-left: auto;
            margin-right: auto;
        }
        .contenido {
            margin-top: 200px;
        }

        .gral-text {
            font-family: 'Cinzel';
            font-weight: 600;
            text-transform: uppercase;
            color: #6D6E60;
            font-size: 20px
        }

        .texto-invita {
            font-size: 15px;
            line-height: 0.7;
        }

        .fecha {
            margin-top: 0px;
        }

        .nombre-semana {
            font-size: 30px;
        }

        .dia {
            font-size: 50px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .mes, .anio {
            padding-left: 10px;
            padding-right: 10px;
        }

        .mes {
            border-right: 2px solid #6D6E60;
        }

        .anio {
            border-left: 2px solid #6D6E60;
        }
        .lugar {
            line-height: 1.2;
            font-size: 17px;
        }
        .text-leyenda {
            font-size: 15px;
            line-height: 0.5;
            /* padding-top: 8px; */
        }
        strong {
            font-weight: bold!important;
            font-size: 25px;
        }

        div.card {
            font-size: 15px;
            border: 1px solid #F9A9AC;
            border-left: 0.5rem solid #F9A9AC;
            /* rgb(242, 241, 228); */
            border-radius: 0px 10px 10px 0px;
            /* rgb(242, 241, 228); */
            padding: 5px 10px;
        }
        .cita {
            position: relative;
            padding-left: 180px!important;
            padding-right: 180px!important;
            text-transform: none!important;
        }
    </style>
</head>
<body>
    <div class="text-center contenido">
        <table class="center" border="0">
            <tr>
                <td class="text-center gral-text" style="padding-bottom: 15px;">Nuestra boda</td>
            </tr>
            <tr>
                <td class="nombre-novios">{{ $dynamicData['NOMBRE_NOVIA'] }}</td>
            </tr>
            <tr>
                <td class="text-center gral-text">&</td>
            </tr>
            <tr>
                <td class="nombre-novios">{{ $dynamicData['NOMBRE_NOVIO'] }}</td>
            </tr>
            <tr>
                <td class="text-center gral-text texto-invita">
                    <p>{{ $nombreInvitado }}, acompañennos a celebrar</p>
                    <p>nuestra unión</p>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="center fecha" border="0">
                        <tr>
                            <td class="gral-text nombre-semana text-center">{{ $dynamicData['NOMBRE_DIA'] }}</td>
                        </tr>
                        <tr>
                            <td>
                                <table border="0">
                                    <tr>
                                        <td class="gral-text mes">{{ $dynamicData['MES_BODA'] }}</td>
                                        <td class="gral-text dia">{{ $dynamicData['DIA_BODA'] }}</td>
                                        <td class="gral-text anio">{{ $dynamicData['ANIO_BODA'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="gral-text text-center lugar">
                    <p>{{ $dynamicData['HORA_BODA'] }}<br/>
                    "JARDÍN CHACAHUA"<br/>ATLACOMULCO, JIUTEPEC, MORELOS.</p>
                </td>
            </tr>
            <tr>
                <td class="gral-text text-center text-leyenda">
                    <p>¡Disfruta este día especial con nosotros!</p>
                    <p>
                        Este pase es válido para hasta <strong>{{ $cantidadInvitados }}</strong> personas.
                    </p>
                </td>
            </tr>
            <tr class="tr-cita">
                <td class="gral-text text-center cita">
                    <div class="card">
                        <q>
                            ...y lleven una vida de amor, así como Cristo nos amó y se entregó por nosotros como ofrenda y sacrificio fragante para Dios
                        </q><br/>
                        <span>- Efesios 5:2</span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
