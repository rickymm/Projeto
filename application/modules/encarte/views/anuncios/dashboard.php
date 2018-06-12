<!-- COMPONENT START -->
<div class="form-row">
    <div class="form-group col-md-3 col-xs-12">
        <label>Filtro</label>
        <select class="form-control opcao">
             <option value="loja" selected>por loja</option>
             <option value="regiao">por região</option>
             <option value="estado">por estado</option>
             <option value="cidade">por cidade</option>
        </select>
        
    </div>
    <div class="form-group col-md-3 col-xs-12">
        <label>Data início</label>
        <input type="text" name="data_ini" class="form-control calendario data_ini">
    </div>
    <div class="form-group col-md-3 col-xs-12">
        <label>Data fim</label>
        <input type="text" name="data_fim" class="form-control calendario data_fim">
    </div>
    <div class="form-group col-md-3 col-xs-12">
        <button style="float:left; margin-top:29px;" class="btn btn-primary" onclick="carregarRelatorio()">filtrar</button>
    </div>
    
</div>

