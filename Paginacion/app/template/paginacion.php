<!doctype html>
<html>
    <head>
        <title>Paginacion</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <div class="navbar navbar-inverse">
            
        </div>
        <div class="content">
            <div class="row" style="margin: 0">
                <div class="col-sm-12">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <label class="col-sm-12 control-label text-left">Consulta</label>
                        <div class="col-sm-12">
                            <table class="table table-striped table-hover ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Estatus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysql_fetch_array($datos)):?>
                                    <tr>
                                        <td><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["nombre"]; ?></td>
                                        <td><?php echo $row["apellido"]; ?></td>
                                        <td><?php echo $row["estatus"]; ?></td>
                                    </tr>    
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-12" >
                            <?php $pagi->print_paginator(); ?>
                        </div>    
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </div>
        </div>
    </body>
    <script   src="https://code.jquery.com/jquery-2.2.3.js"   integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4="   crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</html>
