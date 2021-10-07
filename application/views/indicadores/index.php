<div id="container">
    <div id="header">
        <h3>Objetivos de Desarrollo del Milenio</h3>
    </div>
    <div id="content">
        <div id="cont_menu">
            <?php
                foreach ($componentes as $componentes_item):
                    $html[$componentes_item['cve_dimension']][$componentes_item['clave']]['contenido'] = '';
                endforeach;

                foreach ($indicadores as $indicadores_item): 
                    $html[$indicadores_item['cve_dimension']][$indicadores_item['cve_componente']]['contenido'] .= '
                        <li><a href="indicadores/'.$indicadores_item["clave"].'">'.$indicadores_item["nombre_corto"].'</a></li>';
                endforeach;

                echo '<div id="menu">';
                $num = 0;
                foreach ($dimensiones as $dimensiones_item):
                    $color = explode(",", $dimensiones_item['paleta']);
                    $num = $num + 1;
                    echo '<div style="background-color:'. $color[3] .'" class="menu_section"><div style="float:left; width: 30%;"><img class="odm_icon" src="img/a'.$num.'.png" /></div><div style="float:left; width: 60%; margin: 0 0 0 5px;"><h3>'.$num.'. ' . $dimensiones_item['nombre'] . '</h3></div> </div>';
                    echo '<div class="menu_items">';
                    foreach ($componentes as $componentes_item):
                        if (!empty($html[$dimensiones_item['clave']][$componentes_item['clave']]['contenido'])){
                            echo '<div style="background-color:'. $color[2] .'" class="menu_component"><h4>' . $componentes_item['nombre_corto'] . '</h4></div>';
                            echo '<div class="menu_content"><h3>' . $html[$dimensiones_item['clave']][$componentes_item['clave']]['contenido'] . '</h3></div>';
                        }
                    endforeach;
                    echo '</div>';
                endforeach;
                echo '</div>';
            ?>
        </div>
        <div id="cont_descrip_menu">
            <img src="<?=base_url()?>img/odm.png" style="width:70%"/>
            <br />
            <br />
            <h2>Indicadores de los Objetivos del Milenio en el Estado de Guanajuato y sus Municipios</h2>
<p class="texto_principal">Los Objetivos de Desarrollo del Milenio son ocho propósitos de desarrollo humano fijados en el año 2000 y que los miembros de las  Naciones Unidas, entre ellos México acordaron alcanzar para el año 2015.</p>
<p class="texto_principal">El ejercicio que aquí se presenta, muestra los logros y avances que ha tenido el estado de Guanajuato y sus municipios en el esfuerzo mundial para erradicar la pobreza extrema y el hambre, lograr la enseñanza primaria universal, promover la igualdad de género y el empoderamiento de la mujer, reducir la mortalidad infantil y materna, mejorar la salud reproductiva, intensificar la lucha contra el VIH/SIDA, el paludismo y otras enfermedades, garantizar la sostenibilidad del medio ambiente y crear una alianza mundial para el desarrollo</p>
<br />
<!--
            <img src="<?=base_url()?>img/fondo.jpg" style="width:100%"/>
-->
        </div>
    </div>
</div>

