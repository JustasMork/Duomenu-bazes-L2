
<?php
$allTotals = 0;
foreach($reportData as $groupName => $groupData ){ ?>
    <?php if(!empty($groupData)){ ?>
    <div class="card" style="margin-top:20px;">
        <div class="card-header">
            <?= $groupName ?>
        </div>
        <div class="card-body" style="padding: 0px;">
            <table class="table table-bordered" style="margin-bottom: 0px;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Plotas</th>
                    <th scope="col">Kambariai</th>
                    <th scope="col">Statybos metai</th>
                    <th scope="col">Sildymo tipas</th>
                    <th scope="col">Pastatas komercinis</th>
                    <th scope="col">Yra garažas</th>
                    <th scope="col">Yra rūsys</th>
                    <th scope="col">Yra baseinas</th>
                    <th scope="col">Yra parkavimas</th>
                    <th scope="col">Sutarčių suma</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $groupTotal = 0;
                    foreach($groupData as $element){
                        $groupTotal += floatval($element['sutarciu_suma']);
                        ?>
                    <?php// vd($element)
                        ?>
                    <tr>
                        <th scope="row"><?= $element['id_Nekilnojamas_turtas'] ?></th>
                        <td><?= $element['plotas'] ?></td>
                        <td><?= $element['kambariai'] ?></td>
                        <td><?= $element['statybos_metai'] ?></td>
                        <td><?= $element['sildymo_tipas'] ?></td>
                        <td class="text-center"><?php if($element['ar_komercinis'] == 1) { ?><i class="fas fa-check"></i><?php } ?></td>
                        <td class="text-center"><?php if($element['yra_garazas'] == 1) { ?><i class="fas fa-check"></i><?php } ?></td>
                        <td class="text-center"><?php if($element['yra_rusys'] == 1) { ?><i class="fas fa-check"></i> <?php } ?></td>
                        <td class="text-center"><?php if($element['yra_baseinas'] == 1) { ?><i class="fas fa-check"></i> <?php } ?></td>
                        <td class="text-center"><?php if($element['iskirtos_parkavimo_vietos'] > 0) { ?><i class="fas fa-check"></i> <?php } ?></td>
                        <td><?= $element['sutarciu_suma'] ?>€</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="10" class="text-right">Grupės bendra sutarčių suma:</td>
                    <td><?= Round($groupTotal, 2) ?>€</td>
                    <?php $allTotals += $groupTotal; ?>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php } ?>
<?php } ?>
<?php if($allTotals != 0){ ?>
    <div class="card" style="margin-top:20px; margin-bottom: 20px;">
        <div class="card-header text-right bg-warning">
            Bendra visų grupių sutarčių suma: <b><?= Round($allTotals, 2) ?>€</b>
        </div>
    </div>
<?php } ?>
