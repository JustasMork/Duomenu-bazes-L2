<div class="card" style="margin-top:20px;">
<div class="card-header">
    Nekilnojamas turtas
    <a class="btn btn-primary float-right" href="<?= URL('realty','add') ?>"><i class="fas fa-plus"></i></a>
    <a class="btn btn-primary float-right" href="<?= URL('realty', 'report') ?>" style="    margin-right: 15px;padding: 2px 10px;">Formuoti ataskaitą</a>
</div>
<div class="card-body" style="padding: 0px;">
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Plotas</th>
            <th scope="col">Kambariai</th>
            <th scope="col">Statybos metai</th>
            <th scope="col">Turto tipas</th>
            <th scope="col">Statinio tipas</th>
            <th scope="col">Šildymo tipas</th>
            <th scope="col">Pastatas komercinis</th>
            <th scope="col">Yra garažas</th>
            <th scope="col">Yra rūsys</th>
            <th scope="col">Yra baseinas</th>
            <th scope="col">Yra parkavimas</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $row){ ?>
                <tr>
                    <th scope="row"><?= $row['id_Nekilnojamas_turtas'] ?></th>
                    <td><?= $row['plotas'] ?></td>
                    <td><?= $row['kambariai'] ?></td>
                    <td><?= $row['statybos_metai'] ?></td>
                    <td><?= $row['turto_tipas_name'] ?></td>
                    <td><?= $row['statinio_tipas_name'] ?></td>
                    <td><?= $row['sildymo_tipas_name'] ?></td>
                    <td class="text-center"><?php if($row['ar_komercinis'] == 1) { ?><i class="fas fa-check"></i><?php } ?></td>
                    <td class="text-center"><?php if($row['yra_garazas'] == 1) { ?><i class="fas fa-check"></i><?php } ?></td>
                    <td class="text-center"><?php if($row['yra_rusys'] == 1) { ?><i class="fas fa-check"></i> <?php } ?></td>
                    <td class="text-center"><?php if($row['yra_baseinas'] == 1) { ?><i class="fas fa-check"></i> <?php } ?></td>
                    <td class="text-center"><?php if($row['iskirtos_parkavimo_vietos'] > 0) { ?><i class="fas fa-check"></i> <?php } ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= URL('realty', 'edit', ['id' => $row['id_Nekilnojamas_turtas']]); ?>"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="<?= URL('realty', 'delete', ['id' => $row['id_Nekilnojamas_turtas']])?>"><i class="fas fa-trash-alt"></i></a>
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
