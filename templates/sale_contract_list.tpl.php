<div class="card" style="margin-top:20px;">
    <div class="card-header">
        Pirkimo-pardavimo sutartys
        <a class="btn btn-primary float-right" href="<?= URL('sale_contract','add') ?>"><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body" style="padding: 0px;">
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">Sudarymo data</th>
                <th scope="col">Klientas</th>
                <th scope="col">Pardavėjas</th>
                <th scope="col">Kaina</th>
                <th scope="col">Avansas</th>
                <th scope="col">Sutarties nutraukimo bauda</th>
                <th scope="col">Sutarties būsena</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($data as $row){ ?>
                <tr>
                    <th scope="row"><?= $row['sudarymo_data'] ?></th>
                    <td><?= $row['klientas'] ?></td>
                    <td><?= $row['pardavejas'] ?></td>
                    <td><?= $row['kaina'] ?></td>
                    <td><?= $row['avansas'] ?></td>
                    <td><?= $row['sutarties_nutraukimo_bauda'] ?></td>
                    <td><?= $row['sutarties_busena'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= URL('sale_contract', 'edit', ['id' => $row['id_Sutartis']]); ?>"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="<?= URL('sale_contract', 'delete', ['id' => $row['id_Sutartis']])?>"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
    // įtraukiame puslapių šabloną
    include 'templates/paging.tpl.php';
    ?>
</div>
