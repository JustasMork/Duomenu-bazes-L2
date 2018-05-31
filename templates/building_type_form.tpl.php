<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <?  (!isset($data['types'])) ? 'Sukurti statinio tipus' : 'Redaguoti statinio tipą' ?>
    </div>
    <div class="card-body" style="padding: 0px;">
        <form method="POST" action="">
            <table class="table table-bordered" style="margin-bottom: 0px;">
                <thead class="thead-light">
                <th>Statinio tipas</th>
                <?php if (!isset($data['types'])) { ?>
                    <th class="text-right">Trinti</th>
                <?php } ?>
                </thead>
                <tbody>
                <?php if (!isset($data['types'])) { ?>

                    <tr id="lastRow">
                        <td colspan="2">
                            <button class="btn btn-primary float-right" onclick="addRow()"><i class="fas fa-plus"></i>
                            </button>
                        </td>
                    </tr>

                <?php } else { ?>
                    <tr>
                        <td><input class="form-control" type="text" name="name" value="<?= $data['types']['name'] ?>"
                                   required/></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn btn-primary">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<?php if (!isset($data['types'])) { ?>
    <script type="text/javascript">
        var num_rows = 0;

        function addRow() {
            var html = '<tr>';
            html += ' <td><input class="form-control" type="text" name="' + num_rows + '" required/></td>';
            html += ' <td><button class="btn btn-danger float-right" onclick="num_rows--;$(this).closest(\'tr\').remove();"><i class="fas fa-trash"></i></button></td>';
            html += '</tr>';
            num_rows++;
            $('#lastRow').before(html);
        }

    </script>
<?php } ?>
