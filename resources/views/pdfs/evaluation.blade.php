<style>
    * {
        font-family: Helvetica;
    }

    table {
        border-collapse: collapse;
    }

    td {
        padding: 3px;
    }

    table,
    td {
        border: 1px solid black;
    }

    .page_break {
        page-break-before: always;
    }

    body {
        margin-left: 50px;
        margin-top: 120px;
        margin-bottom: 55px;
    }

    .header {
        position: fixed;
        top: -10px;
        left: 0px;
        right: 0px;
        margin-bottom: 10em;
        /* height: 50px; */

        /** Extra personal styles **/
        /* background-color: #03a9f4; */
        /* color: white; */
        text-align: center;
        /* line-height: 35px; */
    }

    thead {
        display: table-row-group;
    }

    /* footer {
        position: fixed;
        bottom: 40px;
        text-align: center;
        font-size: 11px;
        font-weight: bold;
    } */

    footer {
        position: fixed;
        bottom: -20px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        /* background-color: #03a9f4; */
        /* color: white; */
        text-align: center;
        line-height: 35px;
        font-size: 11px;
        font-weight: bold;
    }

    div {
        font-size: 14px;
        width: 90%;
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="header">
    <img width="80%"
        src="data:image/png;base64,' . {{ base64_encode( file_get_contents( url('images/banner_peru.png') ) ) }} " /><br />
</div>

<footer>
    Calle Chinchón No. 867 – San Isidro<br />
    Teléfono (511) 399 0030<br />
</footer>

<body>
    <div align="center" style="margin-top: 12em; position: absolute">
        <img src="{{asset('images/alicia_logo.jpg')}}" /> <br />
        <br />REPOSITORIO NACIONAL DIGITAL<br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br />EVALUACI&Oacute;N PRELIMINAR DEL REPOSITORIO {{strtoupper($repository->name)}}
        <br />
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        LIMA<br /><br />
        ABRIL 2020<br /><br /><br /><br /><br /><br />
    </div>
    <div class="page_break" syu></div>
    {{-- <div style="margin-top: 10em; text-align:justify;"> --}}
    <br><br>
    1. Presentaci&oacute;n<br /><br />
    El presente informe tiene por objetivo remitirle el resultado de la evaluaci&oacute;n preliminar que se
    realiz&oacute; al repositorio de su instituci&oacute;n.<br /><br />
    Cabe mencionar que para la evaluaci&oacute;n completa esperaremos que se cumpla el tiempo de 6 meses de
    adaptaci&oacute;n posteriores a la promulgaci&oacute;n de las nuevas Directrices de ALICIA, que esperamos se
    concrete a la brevedad una vez que se supere algunas demoras administrativas.<br /><br />
    Dicha evaluaci&oacute;n fue hecha el 29/1/2020; en la URL:<br />
    <a
        href="http://www.repositorioacademico.usmp.edu.pe/">http://www.repositorioacademico.usmp.edu.pe/</a><br /><br /><br />
    2. &Aacute;reas consideradas<br /><br />
    Las &aacute;reas consideradas en esta evaluaci&oacute;n preliminar han sido las siguientes:<br />
    Disponibilidad, Difusi&oacute;n, Pol&iacute;ticas, Estad&iacute;sticas de acceso y Directorios
    Internacionales.<br /><br />
    En la evaluaci&oacute;n general mencionado en el primer punto se proceder&aacute; a evaluar todos los criterios
    que est&eacute;n mencionados en las nuevas Directrices de Alicia, pasado los 6 meses de
    adaptaci&oacute;n.<br /><br /><br />
    3. Resultado de la evaluaci&oacute;n preliminar<br /><br />
    A continuaci&oacute;n se presenta los criterios evaluados del repositorio institucional:<br /><br />


    @foreach ($categories as $category)
    <div>
        <h4>
            {{$category->name}}
        </h4>

        <table width="110%" class="table table-striped table-sm">
            @foreach ($subcategories as $subcategory)
            {{-- @if ($subcategory->questions->pluck('answers')->flatten()->count()) --}}
            <thead>
                <tr>
                    <td width="70%" align="left"><b>{{$subcategory->name}}</b></td>
                    <td width="10%" align="center"><b>Resultado</b></td>
                    <td width="30%" align="left"><b>Observaciones</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategory->questions->where('category_id',$category->id)->all() as $question)
                <tr>
                    <td>{{$question->description}}</td>
                    <td>
                        {{$question->answers->first() && $question->answers->first()->choice ? $question->answers->first()->choice->description : 'N/A'}}
                    </td>
                        <td>
                            {{$question->answers->first() && $question->answers->first()->observation ? $question->answers->first()->observation->description : ''}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{-- @endif --}}
            @endforeach
        </table>

    </div>
    @endforeach

    <br /><br />
    3.5. DIRECTORIOS INTERNACIONALES<br />
    {{-- El repositorio ha sido registrado en los siguientes directorios:<br /> --}}
    {{-- <br /><br /> --}}
    {{-- <table width="100%">' . '$tabla_dir' . '</table> --}}
    {{-- <br /> --}}
    Sin otro particular, expreso a usted mi especial consideración.<br /><br />
    Atentamente,
    </div>
</body>