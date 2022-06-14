<div id="container">
    <?php
        $color = explode(",", $indicadores['paleta']);
    ?>
    <div id="header" style="background-color:<?php echo $color[3] ?>; color: #000;">
        <h3><a href="../">Inicio</a> > Objetivo:  <?php echo strtoupper($indicadores['dimension']) ?></h3>
    </div>
    <div id="subheader" style="background-color:<?php echo $color[2] ?>; color: #000;">
    <h4>Meta: <?php echo $indicadores['componente_largo'] ?></h4>
    </div>
    <div id="content">
        <div id="cont_map">
            <div id="btn_datos" class="dwn_button"><h4>Descargar datos</h4></div><div id="btn_ficha" class="dwn_button"><h4>Descargar ficha</h4></div>
            <div id="titulo_mapa" class="info_legend">
                <h3> <?php echo $indicadores['titulo_estatal_mapa'] ?> </h3>
            </div>
            <div id="map_est"> </div>
            <div id="map_mun"> </div>
            <p id="link_capa"><a href="http://geoinfo.iplaneg.net/layers/geonode:indicadores_estados_mexico">Descargar capa geográfica</a></p>

        </div>
        <div id="cont_text">
            <div id="btn_estatal" class="sel_button"><h4>Estatal</h4></div><div id="btn_municipal" class="sel_button"><h4>Municipal</h4></div>
            <div id="interpretacion" class="info_panel">
                <h3>Interpretación</h3>
                <p id="cont_interpretacion">
                    <?php echo $indicadores['interpretacion_estatal'] ?>
                </p>
            </div>
            <div id="descripcion" class="info_panel">
                <h3>Logros y avances</h3>
                <?php
                    switch( strtolower($indicadores['estatus']) ): 
                        case 'meta cumplida':
                            $indicadorcolor = '#0f0';
                            break;
                        case 'datos insuficientes':
                            $indicadorcolor = '#ffff00';
                            break;
                        case 'desempeño insuficiente':
                            $indicadorcolor = '#f00';
                            break;
                        default:
                            $indicadorcolor = '#00f';
                            break;
                    endswitch;
                ?>
                <div id="estatus" style="background-color: <?php echo $indicadorcolor ?>">
                    <h4><?php echo $indicadores['estatus'] ?></h4>
                </div>
                <br />
                <p id="metadatos"><a href="../metadatos/<?php echo $indicadores['clave'] ?>_metadato_e.pdf">Consultar metadatos del indicador</a></p>
            </div>
            <div id="historico_estatal" class="info_panel">
                <h3>Tendencia histórica: <?php echo $indicadores['titulo_serie_estatal'] ?></h3>
                <p id="tendencia_grafico"> <?php if ($indicadores['comportamiento'] == 'Descendente') { echo '(menos es mejor)'; } else { echo '(más es mejor)'; } ?> </p>
                <canvas id="graf_hist_est" width="350" height="200"></canvas>
                <div id="legend_hist" class="legend_graph"></div>
            </div>
        </div>
        <div id="grafico" class="info_panel">
            <h3 id="titulo_grafico"> <?php echo $indicadores['titulo_estatal_grafico'] ?> </h3>
            <p id="tendencia_grafico"> <?php if ($indicadores['comportamiento'] == 'Descendente') { echo '(menos es mejor)'; } else { echo '(más es mejor)'; } ?> </p>
            <canvas id="graf_est" width="870" height="280"></canvas>
            <canvas id="graf_mun" width="850" height="280"></canvas>
            <div id="legend_grafico" class="legend_graph"></div>
        </div>
        <div id="fuente_datos" >
            <p id="cont_fuente">
                <?php echo $indicadores['fuente_estatal'] ?>
            </p>
        </div>
    </div>
        <div id="cont_select">
        </div>
</div>

<script>
$(document).ready(function(){
    $("#btn_estatal").click(function(){
        $("#btn_estatal").css("background-color","#73e007");
        $("#btn_municipal").css("background-color","#5fb507");
        $("#cont_interpretacion").html('<?php echo trim(preg_replace('/\s+/', ' ', $indicadores['interpretacion_estatal'])) ?>');
        $("#descripcion_indicador").html('<?php echo trim(preg_replace('/\s+/', ' ', $indicadores['descripcion_estatal'])) ?>');
        $("#metadatos").html('<a href="../metadatos/<?php echo $indicadores['clave'] ?>_metadato_e.pdf">Consultar metadatos del indicador</a>');
        $("#titulo_mapa").html('<h3><?php echo trim(preg_replace('/\s+/', ' ', $indicadores['titulo_estatal_mapa'])) ?></h3>');
        $("#link_capa").html('<a href="http://geoinfo.iplaneg.net/layers/geonode:indicadores_estados_mexico">Descargar capa geográfica</a>');
        $("#cont_fuente").html('<?php echo trim(preg_replace('/\s+/', ' ', $indicadores['fuente_estatal'])) ?>');
        $("#titulo_grafico").html('<?php echo $indicadores["titulo_estatal_grafico"] ?>');
        $("#legend_grafico").html(leyenda_grafico_estatal);
        $("#map_mun").hide();
        $("#map_est").show();
        $("#graf_mun").hide();
        $("#graf_est").show();
        currentType = "e";
    });
    $("#btn_municipal").click(function(){
        $("#btn_estatal").css("background-color","#5fb507");
        $("#btn_municipal").css("background-color","#73e007");
        $("#cont_interpretacion").html('<?php echo trim(preg_replace('/\s+/', ' ', $indicadores['interpretacion_municipal'])) ?>');
        $("#descripcion_indicador").html('<?php echo trim(preg_replace('/\s+/', ' ', $indicadores['descripcion_municipal'])) ?>');
        $("#metadatos").html('<a href="../metadatos/<?php echo $indicadores['clave'] ?>_metadato_m.pdf">Consultar metadatos del indicador</a>');
        $("#titulo_mapa").html('<h3><?php echo trim(preg_replace('/\s+/', ' ', $indicadores['titulo_municipal_mapa'])) ?></h3>');
        $("#link_capa").html('<a href="http://geoinfo.iplaneg.net/layers/geonode:indicadores_municipios_guanajuato">Descargar capa geográfica</a>');
        $("#cont_fuente").html('<?php echo trim(preg_replace('/\s+/', ' ', $indicadores['fuente_municipal'])) ?>');
        $("#titulo_grafico").html('<?php echo $indicadores["titulo_municipal_grafico"] ?>');
        $("#legend_grafico").html(leyenda_grafico_municipal);
        $("#map_est").hide();
        $("#map_mun").show();
        $("#graf_est").hide();
        $("#graf_mun").show();
        currentType = "m";
    });
    $("#btn_estatal").click();
    $("#btn_ficha").click(function(){
        window.location.href = '../fichas/' + <?php echo $indicadores['clave'] ?> + '_' + currentType +'.pdf';
    });
    $("#btn_datos").click(function(){
        window.location.href = '../fichas/datos_descarga.xlsx';
    });
    if ('<?php echo $indicadores['rango_municipal'] ?>' == "") {
        $("#btn_municipal").removeClass("sel_button");
        $("#btn_municipal").addClass("sel_button_disabled");
        $("#btn_municipal").css("background-color", "#afafaf");
        $("#btn_municipal").off("click");
        $("#btn_estatal").removeClass("sel_button");
        $("#btn_estatal").addClass("sel_button_disabled");
        $("#btn_estatal").off("click");
    }
})
</script>

<script src="<?=base_url()?>js/municipios.geojson"></script>
<script src="<?=base_url()?>js/estados.geojson"></script>

<script >
            function hexToRgb(hex) {
                var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex.trim());
                return result ? 
                    parseInt(result[1], 16).toString() + "," +
                    parseInt(result[2], 16).toString() + "," +
                    parseInt(result[3], 16).toString() 
                    : null;
            }

            currentType = "";
            indexGto = 0;
            Chart.defaults.global.animation = false;
            paletastr = '<?php echo $indicadores['paleta'] ?>' ;
            rango_estatalstr = '<?php echo $indicadores['rango_estatal'] ?>' ;
            rango_municipalstr = '<?php echo $indicadores['rango_municipal'] ?>' ;
            datos_estatal = JSON.parse( '<?php echo json_encode($datos_estatal) ?>' );
            paleta = paletastr.split(",");
            rango_estatal = rango_estatalstr.split(",");
            rango_municipal = rango_municipalstr.split(",");

            function onEachFeature_est(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight_est,
                    dblclick: zoomToFeature
                });
            }

            function onEachFeature_mun(feature, layer) {
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight_mun,
                    dblclick: zoomToFeature
                });
            }

            function zoomToFeature(e) {
                map.fitBounds(e.target.getBounds());
            }

            function getColor(d, rango) {
                for (var i = 1; i < rango.length; i++) {
                    if (d <= rango[i]) {
                        return paleta[i-1];
                        break;
                    }
                }
            }

            function highlightFeature(e) {
                var layer = e.target;

                layer.setStyle({
                    weight: 5,
                    color: '#9f4961',
                    dashArray: '',
                });

                if (!L.Browser.ie && !L.Browser.opera) {
                    layer.bringToFront();
                }

                info_est.update(layer.feature.properties);
                info_mun.update(layer.feature.properties);
            }

            var capa_estatal;
            var capa_municipal;

            function resetHighlight_est(e) {
                capa_estatal.resetStyle(e.target);
                info_est.update();
            }

            function resetHighlight_mun(e) {
                capa_municipal.resetStyle(e.target);
                info_mun.update();
            }

            function style_est(feature){
                return {
                    fillColor: getColor(feature.properties.<?php echo $indicadores['col_datos']; ?>, rango_estatal),
                    weight: 1,
                    opacity: 1,
                    color: '#b6b6b6',
                    fillOpacity: 0.9
                };
            }

            function style_mun(feature){
                return {
                    fillColor: getColor(feature.properties.<?php echo $indicadores['col_datos']; ?>, rango_municipal),
                    weight: 1,
                    opacity: 1,
                    color: '#b6b6b6',
                    fillOpacity: 0.9
                };
            }

            var tend_est_years = [];
            var tend_est_nal = [];
            var tend_est_gto = [];
            for (i=0; i < datos_estatal.length; i++) {
                if (datos_estatal[i]['cve_estado'] == "00") {
                    tend_est_years[tend_est_years.length] = datos_estatal[i]['year'];
                    tend_est_nal[tend_est_nal.length] = datos_estatal[i]['valor'];
                }else{
                    tend_est_gto[tend_est_gto.length] = datos_estatal[i]['valor'];
                }
            }

            /* --------------------
                * Capa estatal *
             ---------------------- */

            capa_estatal = L.geoJson(data_estatal, {
                style: style_est,
                onEachFeature: onEachFeature_est
            });

            // Obtener nombre de estados y valor de la columna de datos para gráfico del indicador
            var nomEstados = [];
            var dataEstados = [];
            capa_estatal.eachLayer(function (layer) {
                dato = layer.feature.properties.<?php echo $indicadores['col_datos']; ?>;
                dataEstados[dataEstados.length] = dato;
                nomEstados[nomEstados.length] = dato + "_" + layer.feature.properties.nombre;
            });

            // Ordenar datos y nombres de estados
            nomEstados = nomEstados.sort(function(a, b) {return Number(a.substr(0, a.search("_"))) - Number(b.substr(0, b.search("_")))});
            dataEstados = dataEstados.sort(function(a, b) {return a-b});
            // Formatear correctamente nombre de Estado
            for (i=0; i < nomEstados.length; i++){
                nomEstados[i] = nomEstados[i].substr(nomEstados[i].search("_")+1);
                if (nomEstados[i] == "Guanajuato"){
                    indexGto = i ;
                }
            }

            var legend_est = L.control({position: 'bottomright'});

            legend_est.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'info legend');

                div.innerHTML += '<h4>Rangos</h4>' ; 
                for (var i = 0; i < rango_estatal.length; i++) {
                    div.innerHTML +=
                        (rango_estatal[i + 1] ? '<i style="background:' + paleta[i] + '"></i> ' +
                         Number(rango_estatal[i]).toLocaleString() + ' &ndash; ' + Number(rango_estatal[i + 1]).toLocaleString() + '<br>' : '');
                }

                return div;
            };

            var info_est = L.control();

            info_est.onAdd = function(map) {
                this._div = L.DomUtil.create('div', 'info');
                this.update();
                return this._div;
            }

            info_est.update = function (props) {
                this._div.innerHTML = '<h4><?php echo $indicadores['unidad_estatal'] ?> </h4>' + (props ?
                    '<b>' + props.nombre + '</b><br />' + Number(props.<?php echo $indicadores['col_datos']; ?>).toLocaleString()
                        : 'Señale un estado');
            }


            // crear layer openstreetmap
            var backgUrl = '//{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            backgAttrib = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';

            var backg_est = L.tileLayer(backgUrl, {attribution: backgAttrib});

           // crear mapa en el div "map" y centrarlo en Guanajuato
            var map_est = L.map('map_est', {
                center: new L.LatLng(20.85304, -100.94788), 
                zoom: 4,
                layers: [backg_est, capa_estatal ]
            });

            info_est.addTo(map_est);
            legend_est.addTo(map_est);

            /* --------------------
                * Capa municipal *
             ---------------------- */

            capa_municipal = L.geoJson(data_municipal, {
                style: style_mun,
                onEachFeature: onEachFeature_mun
            });

            // Loop through the geojson features and extract bbox and name
            var nomMunis = [];
            var dataMunis = [];
            capa_municipal.eachLayer(function (layer) {
                dato = layer.feature.properties.<?php echo $indicadores['col_datos']; ?>;
                dataMunis[dataMunis.length] = dato;
                nomMunis[nomMunis.length] = dato + "_" + layer.feature.properties.nombre;
            });

            // Ordenar datos y nombres de municipios
            nomMunis = nomMunis.sort(function(a, b) {return Number(a.substr(0, a.search("_"))) - Number(b.substr(0, b.search("_")))});
            dataMunis = dataMunis.sort(function(a, b) {return a-b});
            // Formatear correctamente nombre de Estado
            for (i=0; i < nomMunis.length; i++){
                nomMunis[i] = nomMunis[i].substr(nomMunis[i].search("_")+1);
            }

            var legend_mun = L.control({position: 'bottomright'});

            legend_mun.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'info legend');

                div.innerHTML += '<h4>Rangos</h4>' ; 
                for (var i = 0; i < rango_municipal.length; i++) {
                    div.innerHTML +=
                        (rango_municipal[i + 1] ? '<i style="background:' + paleta[i] + '"></i> ' +
                         Number(rango_municipal[i]).toLocaleString() + ' &ndash; ' + Number(rango_municipal[i + 1]).toLocaleString() + '<br>' : '');
                }

                return div;
            };

            var info_mun = L.control();

            info_mun.onAdd = function(map) {
                this._div = L.DomUtil.create('div', 'info');
                this.update();
                return this._div;
            }

            info_mun.update = function (props) {
                this._div.innerHTML = '<h4><?php echo $indicadores['unidad_municipal'] ?> </h4>' + (props ?
                    '<b>' + props.nombre + '</b><br />' + Number(props.<?php echo $indicadores['col_datos']; ?>).toLocaleString()
                        : 'Señale un municipio');
            }

             // add a MapQuest OpenStreetMap tile layer

            var backg_mun = L.tileLayer(backgUrl, {attribution: backgAttrib});

           // crear mapa en el div "map" y centrarlo en Guanajuato
            var map_mun = L.map('map_mun', {
                center: new L.LatLng(20.85304, -100.94788), 
                zoom: 8,
                layers: [backg_mun, capa_municipal ]
            });

            info_mun.addTo(map_mun);
            legend_mun.addTo(map_mun);

            /* Grafico estatal */
            maxnum = Math.max.apply(null, dataEstados);
            maxnum = maxnum + (maxnum * 0.1);
            minnum = Math.min.apply(null, dataEstados);
            if (minnum > 0) { minnum = 0 }
            sumEstados = dataEstados.reduce( function(total, num) { return total + num });
            promEstados = Number((sumEstados / dataEstados.length).toFixed(2));
            arrPromEstados = Array.apply(null, new Array(dataEstados.length)).map(Number.prototype.valueOf, promEstados);
            if (maxnum < 7) {
                tam = (maxnum - minnum) / 5;
                tam = tam.toFixed(2);
            } else {
                tam = Math.round(maxnum / 5);
            }
            var dataGrafEst = {
                labels : nomEstados,
                datasets : [
                {
                    type: "bar",
                    fillColor : "rgba(" + hexToRgb(paleta[3]) + ",0.7)",
                    strokeColor : paleta[3],
                    highlightFill : "rgba(" + hexToRgb("#c8d7fb") + ",0.7)",
                    highlightStroke : paleta[3],
                    data : dataEstados,
                },
                {
                    label: "Promedio nacional",
                    type: "line",
                    strokeColor : "rgba(100,100,100,0.7)",
                    pointColor : "rgba(100,100,100,0.7)",
                    data : arrPromEstados
                },
                ]
            }
            var graf_est = document.getElementById('graf_est').getContext('2d');
            window.GraphEst = new Chart(graf_est).Overlay(dataGrafEst, {
                scaleLabel : "<%= Number(value).toLocaleString() %>",
                tooltipTemplate: "<%= Number(value).toLocaleString() %>",
                multiTooltipTemplate: "<%= Number(value).toLocaleString() %>",
                scaleOverride: true,
                    scaleSteps: 5,
                    scaleStepWidth: tam,
                    scaleStartValue: minnum,
                    pointDot: false,
                    datasetFill : false,
                    pointHitDetectionRadius : 0,
                    pointDotRadius: 0,
                    legendTemplate : "<% for (var i=0; i<datasets.length; i++){%><%if(datasets[i].label){%><div class=\"legend_marker\" style=\"background-color:<%=datasets[i].strokeColor%>; \"></div><span class=\"legend_label\"><%=datasets[i].label%></span><%}%><%}%>"
            } );
            var leyenda_grafico_estatal = GraphEst.generateLegend();
            $("#legend_grafico").html(leyenda_grafico_estatal);
            GraphEst.datasets[0].bars[indexGto].fillColor = "rgba(" + hexToRgb("#c8d7fb") + ",0.7)";
            GraphEst.datasets[0].bars[indexGto].strokeColor = paleta[3];
            GraphEst.datasets[0].bars[indexGto].highlightFill = "rgba(" + hexToRgb("#327eab") + ",0.7)";
            GraphEst.update();


            /* Grafico municipal */
            maxnum = Math.max.apply(null, dataMunis);
            maxnum = maxnum + (maxnum * 0.1);
            minnum = Math.min.apply(null, dataMunis);
            if (minnum > 0) { minnum = 0 }
            sumMunis = dataMunis.reduce( function(total, num) { return total + num });
            promMunis = Number((sumMunis / dataMunis.length).toFixed(2));
            arrPromMunis = Array.apply(null, new Array(dataMunis.length)).map(Number.prototype.valueOf, promMunis);
            if (maxnum < 5) {
                tam = (maxnum - minnum) / 5;
                tam = tam.toFixed(2);
            } else {
                tam = Math.round(maxnum / 5);
            }
            var dataGrafMun = {
                labels : nomMunis,
                datasets : [
                    {
                        label: "Promedio estatal",
                            type: "line",
                            strokeColor : "rgba(100,100,100,0.7)",
                            pointColor : "rgba(100,100,100,0.7)",
                            data : arrPromMunis
                    },
                    {
                            type: "bar",
                            fillColor : "rgba(" + hexToRgb(paleta[3]) + ",0.7)",
                            strokeColor : paleta[3],
                            highlightFill : "rgba(" + hexToRgb("#c8d7fb") + ",0.7)",
                            highlightStroke : paleta[3],
                            data : dataMunis,
                    },
                    ]
            }
            var graf_mun = document.getElementById('graf_mun').getContext('2d');
            window.GraphMun = new Chart(graf_mun).Overlay(dataGrafMun, {
                scaleLabel : "<%= Number(value).toLocaleString() %>",
                tooltipTemplate: "<%= Number(value).toLocaleString() %>",
                multiTooltipTemplate: "<%= Number(value).toLocaleString() %>",
                scaleOverride: true,
                    scaleSteps: 5,
                    scaleStepWidth: tam,
                    scaleStartValue: minnum,
                    pointDot: false,
                    datasetFill : false,
                    pointHitDetectionRadius : 0,
                    pointDotRadius: 0,
                    legendTemplate : "<% for (var i=0; i<datasets.length; i++){%><%if(datasets[i].label){%><div class=\"legend_marker\" style=\"background-color:<%=datasets[i].strokeColor%>; \"></div><span class=\"legend_label\"><%=datasets[i].label%></span><%}%><%}%>"
            } );
            var leyenda_grafico_municipal = GraphMun.generateLegend();
            $("#legend_grafico").html(leyenda_grafico_municipal);


            /* Grafico tendencia historica */
            var dataGrafHistEst = {
                labels : tend_est_years,
                datasets : [
                {
                    fillColor : "rgba(6,6,6,0)",
                    strokeColor : "rgba(100,100,100,0.7)",
                    pointColor : "rgba(100,100,100,0.7)",
                    data : tend_est_nal,
                    label: "Nacional",
                },
                {
                    fillColor : "rgba(6,6,6,0)",
                    strokeColor : paleta[3],
                    pointColor : paleta[3],
                    data : tend_est_gto,
                    label: "Guanajuato"
                }
                ]
            }
            var graf_hist_est = document.getElementById('graf_hist_est').getContext('2d');
            window.myhistest = new Chart(graf_hist_est).Line(dataGrafHistEst, {
                scaleLabel : "<%= Number(value).toLocaleString() %>",
                tooltipTemplate: "<%= Number(value).toLocaleString() %>",
                multiTooltipTemplate: "<%= Number(value).toLocaleString() %>",
                legendTemplate : "<% for (var i=0; i<datasets.length; i++){%><div class=\"legend_marker\" style=\"background-color:<%=datasets[i].pointColor%>; \"></div><%if(datasets[i].label){%><span class=\"legend_label\"><%=datasets[i].label%></span><%}%><%}%>"

            });
            var legend = myhistest.generateLegend();
            $("#legend_hist").html(legend);

</script>
