<div class="row m-row--no-padding m-row--col-separator-xl">			
    <div class="col-xl-4">
        <!--begin:: Widgets/Stats2-1 -->
        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">Encartes Ativos</h3>
                        <span class="m-widget1__desc">Quantidade de encartes ativos</span>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-success">
                            <?php echo $encartes; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Stats2-1 -->			
    </div>
    <div class="col-xl-4">
        <!--begin:: Widgets/Stats2-1 -->
        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">À Vencer</h3>
                        <span class="m-widget1__desc">Encartes próximo* ao fim de veiculação</span>
                        <span class="m-widget1__desc"><small>* 2 dias</small></span>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-danger">
                            <?php echo $proxFim; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Stats2-1 -->			
    </div>
    <div class="col-xl-4">
        <!--begin:: Widgets/Stats2-1 -->
        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">Lojas</h3>
                        <span class="m-widget1__desc">Quantidade de lojas ativas</span>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-info">
                            <?php echo $lojasAtivas; ?>    
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Stats2-1 -->			
    </div>
</div>
<br>
<h3 class="m-subheader__title">
    Encartes Ativos
</h3>
<div>
    <table id="tb_encartes" class="table table-striped table-bordered m-table m-table--head-bg-success tb_encartes" role="grid" aria-describedby="datatable-buttons_info" width="100%">
        <thead class="thead-inverse">
            <tr>
                <th>ID</th>
                <th>PDF</th>
                <th>Observações</th>
                <th>Data Início</th>
                <th>Data Fim</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>