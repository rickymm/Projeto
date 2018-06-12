<div class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="titulo-azul"><span><?php echo $this->lang->line("encarte_informacoes_comerciais") ?></span></h1>
            </div>
        </div>
    </div>
</div>
<form action="<?php echo base_url('encarte/inscricao/formContato'); ?>" method="POST">
    <div class="container" style="margin-bottom: 2%">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <h2 class="titulo-section">O que fazemos</h2>
                    <p class="texto"s>Mais de 90% dos nossos usuários são responsáveis de aquisição, número difícil de ser atingido por outras formas de publicidade. Nos baseamos no perfil dos nossos usuários, que dessa forma recebem informações sobre o que realmente lhes interessam, possuindo todas as informações necessárias para a realização de suas compras.
                        <br><br>Acompanhando o consumidor até os últimos metros entre planejamento e aquisição, AondeConvem influencia fortemente o fluxo de clientes nas lojas para a realização de suas compras (96% daqueles que utilizam os nossos serviços se dirigem às lojas depois de acessar nosso site ou aplicativo e 87% mudam de idéia sobre a escolha da loja. Além de influenciar de maneira decisiva a intenção de compra de produtos, que aumenta em até 25% nos usuários que utilizam nossa plataforma (fonte: Nielsen 2013-2014).
                        <br><br>Os serviços da AondeConvem estão disponíveis em todas as principais plataformas móveis (Android, iOS, Windows Phone, Windows 8, Blackberry Amazon) e nos sites dos respectivos países.
                        <br><br>Os serviços da AondeConvem estão disponíveis em todas as principais plataformas móveis (Android, iOS, Windows Phone, Windows 8, Blackberry Amazon) e nos sites dos respectivos países.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="titulo-section margem"><?php echo $this->lang->line("encarte_ficou_com_duvida") ?></h2>
                <label for="nome"><?php echo $this->lang->line("encarte_nome") ?></label>
                <input type="text" class="form-control nome" name="nome" id="nome" required>
                <label for="email"><?php echo $this->lang->line("encarte_email") ?></label>
                <input type="email" class="form-control email" name="email" id="email" required="">
                <label for="telefone"><?php echo $this->lang->line("encarte_telefone") ?></label>  
                <input type="text" class="form-control telefone" name="telefone" id="telefone" required="">
                <label for="empresa"><?php echo $this->lang->line("encarte_empresa") ?></label>
                <input type="text" class="form-control empresa" name="empresa" id="empresa" required>
                <label for="assunto"><?php echo $this->lang->line("encarte_assunto") ?></label>
                <input type="text" class="form-control assunto" name="assunto" id="assunto" required="">
                <label for="mensagem"><?php echo $this->lang->line("encarte_mensagem") ?></label>
                <textarea type="textarea" class="form-control mensagem" name="mensagem" id="mensagem" required></textarea>
                <small><?php echo $this->lang->line("encarte_autorizo") ?></small>
                <button type="submit" class="btn btn-primary enviar"><?php echo $this->lang->line("encarte_enviar") ?></button>
            </div>
        </div>
    </div>
</form>
