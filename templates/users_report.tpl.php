
<div class="card" style="margin-top:20px; margin-bottom:20px;">
    <div class="card-header">
        Vartotojų ataskaita
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
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
