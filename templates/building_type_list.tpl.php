<div class="card" style="margin-top:20px;">
    <div class="card-header">
        Statinio tipai
        <a class="btn btn-primary float-right" href="<?= URL('building_type','add') ?>"><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body" style="padding: 0px;">
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Pavadinimas</th>
                <th></th>

            </tr>
            </thead>
            <tbody>
            <?php foreach($data as $row){ ?>
                <tr>
                    <th scope="row"><?= $row['id_Statinio_tipas'] ?></th>
                    <td><?= $row['name'] ?></td>
                    <td class="text-right">
                        <a class="btn btn-primary" href="<?= URL('building_type', 'edit', ['id' => $row['id_Statinio_tipas']]); ?>"><i class="fas fa-pencil-alt"></i></a>


                        <a class="btn btn-danger" href="<?= URL('building_type', 'delete', ['id' => $row['id_Statinio_tipas']])?>"><i class="fas fa-trash-alt"></i></a>
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
