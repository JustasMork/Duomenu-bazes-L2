<form method="POST" action="">
    <div class="card" style="margin-top:20px;">
        <div class="card-header">
            <?= $data['formHeader'] ?>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6" style="margin-top:10px">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Asmens kodas</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="user[asmens_kodas]" max="999999999"
                                   value="<?= isset($data['user']) ? $data['user']['asmens_kodas'] : '' ?>"
                                   required <?= isset($data['user']) ? 'disabled' : '' ?>/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Vardas</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="user[vardas]"
                                   value="<?= isset($data['user']) ? $data['user']['vardas'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Pavardė</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="user[pavarde]"
                                   value="<?= isset($data['user']) ? $data['user']['pavarde'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">El. paštas</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="email" name="user[el_pastas]"
                                   value="<?= isset($data['user']) ? $data['user']['el_pastas'] : '' ?>" required/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="margin-top:10px">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Telefono numeris</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="number" name="user[telefono_nr]"
                                   value="<?= isset($data['user']) ? $data['user']['telefono_nr'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Gimimo data</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" placeholder="YYYY-MM-DD" name="user[gimimo_data]"
                                   pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))"
                                   value="<?= isset($data['user']) ? $data['user']['gimimo_data'] : '' ?>" required/>
                            <input type="hidden" name="user[registracijos_data]"
                                   value="<?php
                                   if (isset($data['user'])) {
                                       echo $data['user']['registracijos_data'];
                                   } else {
                                       $datetime = new DateTime();
                                       echo $datetime->format('Y-m-d');
                                   }
                                   ?>"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Banko sąskaita</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="user[banko_saskaita]"
                                   value="<?= isset($data['user']) ? $data['user']['banko_saskaita'] : '' ?>" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Vartotojo tipas</label>
                        <div class="col-sm-8">
                            <select class="custom-select" name="user[vartotojo_tipas]">
                                <?php foreach ($data['userTypes'] as $row) { ?>
                                    <option value="<?= $row['id_Vartotojo_tipas'] ?>" <?= (isset($data['user']) && $row['id_Vartotojo_tipas'] == $data['user']['vartotojo_tipas']) ? 'selected' : '' ?>><?= $row['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="margin-top:20px;">
        <div class="card-header">
            Adresas
            <button id="addRowBtn" onclick="addRow()" class="btn btn-primary float-right"><i class="fa fa-plus"></i> </button>
        </div>
        <div class="card-body" id="add-tpl">
            <?php if(isset($data['address'])){ ?>
                <?php foreach ($data['address'] as $index => $address){ ?>
                    <div class="card-body address-<?=$index?>">
                        <?= $index != 0 ? '<hr>' : ''?>
                        <div class="row">
                            <div class="col-md-6" style="margin-top:10px">
                                <input type="hidden" name="address[<?=$index?>][valstybe]" value="Lietuva">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Regionas</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="address[<?=$index?>][regionas]" value="<?=$address['regionas']?>" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Miestas</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="address[<?=$index?>][miestas]" value="<?=$address['miestas']?>" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Gatvė</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="address[<?=$index?>][gatve]" value="<?=$address['gatve']?>" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-top:10px">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Namo numeris</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" name="address[<?=$index?>][numeris]" value="<?=$address['numeris']?>" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Pašto kodas</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="number" name="address[<?=$index?>][pasto_kodas]" value="<?=$address['pasto_kodas']?>" required/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label">Adreso tipas</label>
                                    <div class="col-sm-8">
                                        <select class="custom-select" name="address[<?=$index?>][fk_adreso_tipas]">
                                            <?php foreach ($data['addressTypes'] as $addressType){ ?>
                                                <option value="<?= $addressType['id'] ?>" <?= ($addressType['id'] == $address['fk_adreso_tipas']) ? 'selected' : '' ?>><?= $addressType['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-danger float-right" onclick="removeRow(<?=$index?>);"><i class="fa fa-trash"></i> </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php  }?>
            <?php } ?>

        </div>
    </div>


        <div class="row mt-md-3">
            <div class="col-md-12 mb-md-3 mt-md-1" >
                <input type="submit" class="btn btn-primary">
            </div>
        </div>

    </div>
</form>

<div id="js-address-tpl" style="display: none;">

    <div class="card-body address-:row_nr:">
        <hr>
        <div class="row">
            <div class="col-md-6" style="margin-top:10px">
                <input type="hidden" name="address[:row_nr:][valstybe]" value="Lietuva">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Regionas</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="address[:row_nr:][regionas]" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Miestas</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="address[:row_nr:][miestas]" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Gatvė</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="address[:row_nr:][gatve]" required/>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="margin-top:10px">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Namo numeris</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="number" name="address[:row_nr:][numeris]" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Pašto kodas</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="number" name="address[:row_nr:][pasto_kodas]" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label">Adreso tipas</label>
                    <div class="col-sm-8">
                        <select class="custom-select" name="address[:row_nr:][fk_adreso_tipas]">
                            <?php foreach ($data['addressTypes'] as $addressType){ ?>
                                <option value="<?= $addressType['id'] ?>"><?= $addressType['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-danger float-right" onclick="removeRow(:row_nr:);"><i class="fa fa-trash"></i> </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    var row_nr = <?= isset($data['address'])? count($data['address']) : 0 ?>;

    function addRow() {
        var html = $('#js-address-tpl').html();
        html = html.replace(/:row_nr:/gm, row_nr);
        if(row_nr == 0)
            html = html.replace('<hr>', '');
        $('#add-tpl').append(html);
        row_nr++;
    }

    function removeRow(rowNr) {
        $('.address-'+rowNr).remove();
        row_nr--;
    }
</script>
