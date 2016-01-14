<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
</head>
    <body>
        <div class="container">
            <table cellpadding=4 cellspacing=4 border=0 id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <?php
                        $count = array_keys($table[0]);
                        foreach($count as $name)
                        {
                            echo "<th>";
                            echo $name;
                            echo "</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($table as $tbl)
                        {
                            echo "<tr>";
                            foreach($tbl as $td)
                            {
                                echo "<td>";
                                echo $td;
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
        <script language="javascript">
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    </body>
</html>
