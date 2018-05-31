<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <?= $data['formHeader'] ?>
    </div>
    <div class="card-body" style="padding: 0px;">
        <form method="POST" action="">
            <div class="col-md-12" style="margin-top:10px">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Plotas</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="plotas" value="<?= isset($data['realty']) ? $data['realty']['plotas'] : '' ?>" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kambariai</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="kambariai" value="<?= isset($data['realty']) ? $data['realty']['kambariai'] : '' ?>" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Statybos metai</label>
                    <div class="col-sm-10">
                        <input class="form-control " type="number" name="statybos_metai" value="<?= isset($data['realty']) ? $data['realty']['statybos_metai'] : '' ?>" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Parkavimo vietos</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="number" name="iskirtos_parkavimo_vietos" value="<?= isset($data['realty']) ? $data['realty']['iskirtos_parkavimo_vietos'] : '' ?>" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Turto tipas</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="turto_tipas">
                            <?php foreach ($data['realtyTypes'] as $realtyType){ ?>
                                <option value="<?= $realtyType['id_Turto_tipas'] ?>" <?= (isset($data['realty']) && $data['realty']['turto_tipas'] == $realtyType['id_Turto_tipas']) ? 'selected' : '' ?>><?= $realtyType['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Statinio tipas</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="statinio_tipas">
                            <?php foreach ($data['buildingTypes'] as $row){ ?>
                                <option value="<?= $row['id_Statinio_tipas'] ?>" <?= (isset($data['realty']) && $data['realty']['statinio_tipas'] == $row['id_Statinio_tipas']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Įrengimo lygis</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="irengimo_lygis">
                            <?php foreach ($data['buildingState'] as $row){ ?>
                                <option value="<?= $row['id_Irengimo_lygis'] ?>" <?= (isset($data['realty']) && $data['realty']['irengimo_lygis'] == $row['id_Irengimo_lygis']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Šildymo tipas</label>
                    <div class="col-sm-10">
                        <select class="custom-select" name="sildymo_tipas">
                            <?php foreach ($data['heatingTypes'] as $row){ ?>
                                <option value="<?= $row['id_Sildymo_tipas'] ?>" <?= (isset($data['realty']) && $data['realty']['sildymo_tipas'] == $row['id_Sildymo_tipas']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="col-form-label">Ar komercinis</label>
                        <input class="js-checkbox-switch" type="checkbox" data-name="ar_komercinis" <?= (isset($data['realty']) && $data['realty']['ar_komercinis'] == 1) ? 'checked' : '' ?>/>
                        <input type="hidden" name="ar_komercinis" value="<?= (isset($data['realty'])) ? $data['realty']['ar_komercinis'] : '0' ?>"/>
                    </div>
                    <div class="col-sm-3">
                        <label class=" col-form-label">Yra garažas</label>
                        <input class="js-checkbox-switch " type="checkbox" data-name="yra_garazas" <?= (isset($data['realty']) && $data['realty']['yra_garazas'] == 1) ? 'checked' : '' ?>/>
                        <input type="hidden" name="yra_garazas" value="<?= (isset($data['realty'])) ? $data['realty']['yra_garazas'] : '0' ?>"/>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Yra rūsys</label>
                        <input class="js-checkbox-switch"  type="checkbox" data-name="yra_rusys" <?= (isset($data['realty']) && $data['realty']['yra_rusys'] == 1) ? 'checked' : '' ?>/>
                        <input type="hidden" name="yra_rusys" value="<?= (isset($data['realty'])) ? $data['realty']['yra_rusys'] : '0' ?>"/>
                    </div>
                    <div class="col-sm-3">
                        <label class="col-form-label">Yra baseinas</label>
                        <input class="js-checkbox-switch" type="checkbox" data-name="yra_baseinas" <?= (isset($data['realty']) && $data['realty']['yra_baseinas'] == 1) ? 'checked' : '' ?>/>
                        <input type="hidden" name="yra_baseinas" value="<?= (isset($data['realty'])) ? $data['realty']['yra_baseinas'] : '0' ?>"/>
                    </div>
                </div>
                <div class="row text-center">
                        <input type="submit" class="btn btn-primary ml-md-2 mb-md-2">
                </div>
            </div>
        </form>
    </div>
</div>