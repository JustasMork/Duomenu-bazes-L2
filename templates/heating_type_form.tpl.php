<div class="card" style="margin-top:20px;">
    <div class="card-header">
        Pridėti šildymo tipą
    </div>
    <div class="card-body" style="padding: 0px;">
        <form method="POST" action="">
            <div class="col-md-12" style="margin-top:10px">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pavadinimas</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" required/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Efektyvumas</label>
                    <div class="col-sm-10">
                        <input class="form-control"  type="number" step="0.01" max="100" name="efektyvumas" required/>
                    </div>
                </div>
                <div class="row text-center">
                    <input type="submit" class="btn btn-primary ml-md-2 mb-md-2">
                </div>
            </div>
        </form>
    </div>
</div>