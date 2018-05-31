<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <?= $data['formHeader'] ?>
    </div>
    <div class="card-body" style="padding: 0px;">
        <form method="POST" action="" >
            <input class="form-control" type="hidden" name="contract[pasirasymo_data]"
                   value="<?= isset($data['contract']) ? $data['contract']['pasirasymo_data'] : $data['currentDate'] ?>"/>
            <input class="form-control" type="hidden" name="contract[sutarties_tipas]"
                   value="3"/>

            <div class="row" style="padding:20px;">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Sudarymo data</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="contract[sudarymo_data]"
                                   value="<?= isset($data['contract']) ? $data['contract']['sudarymo_data'] : $data['currentDate'] ?>" disabled/>
                            <input type="hidden" type="text" name="contract[sudarymo_data]"
                                   value="<?= isset($data['contract']) ? $data['contract']['sudarymo_data'] : $data['currentDate'] ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Turto savininkas</label>
                        <div class="col-sm-8">
                            <select name="contract[fk_Savininkoasmens_kodas]" class="custom-select">
                                <?php foreach ($data['sellers'] as $row) { ?>
                                    <option value="<?= $row['kodas'] ?>" <?= (isset($data['contract']) && $data['contract']['fk_Savininkoasmens_kodas'] == $row['kodas']) ? 'selected' : '' ?>><?= $row['vardas_pavarde'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Klientas</label>
                        <div class="col-sm-8">
                            <select name="contract[fk_Klientoasmens_kodas]" class="custom-select">
                                <?php foreach ($data['clients'] as $row) { ?>
                                    <option value="<?= $row['kodas'] ?>" <?= (isset($data['contract']) && $data['contract']['fk_Klientoasmens_kodas'] == $row['kodas']) ? 'selected' : '' ?>><?= $row['vardas_pavarde'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Parduodamas nekilnojamas turtas</label>
                        <div class="col-sm-8">
                            <select name="contract[fk_Nekilnojamas_turtasid_Nekilnojamas_turtas]" class="custom-select">
                                <?php foreach ($data['realty'] as $row) { ?>
                                    <option value="<?= $row['id_Nekilnojamas_turtas'] ?>" <?= (isset($data['contract']) && $data['contract']['fk_Nekilnojamas_turtasid_Nekilnojamas_turtas'] == $row['id_Nekilnojamas_turtas']) ? 'selected' : '' ?>><?= $row['id_Nekilnojamas_turtas'] . ': ' . $row['statybos_metai'] . ", " . $row['plotas'] . "m2, " . $row['turto_tipas_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Kaina</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.01" name="saleContract[kaina]"
                                   value="<?= isset($data['contract']) ? $data['contract']['kaina'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Avansas</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.01" name="saleContract[avansas]"
                                   value="<?= isset($data['contract']) ? $data['contract']['avansas'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Sutarties nutraukimo bauda</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" step="0.01" name="saleContract[sutarties_nutraukimo_bauda]"
                                   value="<?= isset($data['contract']) ? $data['contract']['sutarties_nutraukimo_bauda'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Sutarties būsena</label>
                        <div class="col-sm-8">
                            <select name="saleContract[fk_busena]" class="custom-select">
                                <?php foreach ($data['contractStatuses'] as $row) { ?>
                                    <option value="<?= $row['id_Sutarties_busena'] ?>" <?= (isset($data['contract']) && $data['contract']['fk_busena'] == $row['id_Sutarties_busena']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center" style="margin-left: 20px;">
                <input type="submit" class="btn btn-primary ml-md-2 mb-md-2">
            </div>
        </form>
    </div>
</div>