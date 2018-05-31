<div class="card" style="margin-top:20px;">
    <div class="card-header">Formuoti vartotojų ataskaitą</div>
    <div class="card-body">
        <form id="filterForm" action="" method="GET">
            <input type="hidden" name="module" value="users">
            <input type="hidden" name="action" value="report">
            <div class="row">
                <div class="col-md-3 form-group">
                    <label class="col-form-label">Sutartčių vertė nuo:</label>
                    <input class="form-control" type="number" name="sutarciu_verte_min" required/>
                </div>
                <div class="col-md-3">
                    <label class="col-form-label">Sutarčių vertė iki</label>
                    <input class="form-control" type="number" name="sutarciu_verte_max" required/>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-primary" style="margin-top: 40px" onclick="$('#filterForm').submit()"><i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card" style="margin-top:20px;">
    <div class="card-header">
        Nekilnojamas turtas
        <a class="btn btn-primary float-right" href="<?= URL('user', 'add') ?>"><i class="fas fa-plus"></i></a>
    </div>
    <div class="card-body" style="padding: 0px;">
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th scope="col">Vardas</th>
                <th scope="col">Pavardė</th>
                <th scope="col">El.paštas</th>
                <th scope="col">Miestas</th>
                <th scope="col">Vartotojo tipas</th>
                <th scope="col">Adresai</th>
                <th scope="col">Sutartys</th>
                <th scope="col">Bendra sutarčių vertė</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['userData'] as $row) { ?>
                <tr>
                    <td><?= $row['vardas'] ?></td>
                    <td><?= $row['pavarde'] ?></td>
                    <td><?= $row['el_pastas'] ?></td>
                    <td><?= $row['miestas'] ?></td>
                    <td><?= $row['vartotojo_tipas'] ?></td>
                    <td><?= $row['adresu_kiekis'] ?></td>
                    <td><?= $row['sutarciu_kiekis'] ?></td>
                    <td><?= $row['sutarciu_verte'] ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?= URL('user', 'edit', ['id' => $row['asmens_kodas']]); ?>"><i
                                    class="fas fa-pencil-alt"></i></a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="<?= URL('user', 'delete', ['id' => $row['asmens_kodas']]) ?>"><i
                                    class="fas fa-trash-alt"></i></a>
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
