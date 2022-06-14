<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/base.css" />
        <script src="<?=base_url()?>/js/Chart.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@0.7.2/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@0.7.2/dist/leaflet.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<!--
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/cupertino/jquery-ui.css"/>
-->
        <script>
            $(function() {
                $( "#menu" ).accordion({
                    active: false,
                    collapsible: true
                });
            });
        </script>

    </head>
    <body>
