<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'seguranca/conta/entrar';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['conta/sair'] = 'seguranca/conta/sair';
$route['conta/entrar'] = 'seguranca/conta/entrar';
$route['seguranca'] = 'seguranca/conta';
$route['crm'] = 'crm/cliente/consultar';
$route['marketing'] = 'marketing/campanha/consultar';
$route['wbs/loginwpc'] = 'seguranca/WbsIcatu/loginWPC';
$route['wbs/solicitaracesso'] = 'seguranca/WbsIcatu/solicitarAcesso';
$route['wbs/recuperarsenha'] = 'seguranca/WbsIcatu/recuperarSenha';
$route['wbs/consultardashboardwpc'] = 'seguranca/WbsIcatu/dashboardWPC';
$route['wbs/consultarproduto'] = 'seguranca/WbsIcatu/consultarProduto';
$route['wbs/consultarlojas'] = 'seguranca/WbsIcatu/consultarLojas';
$route['wbs/consultarpromotoresexclusivos'] = 'seguranca/WbsIcatu/consultarPromotoresExclusivos';
$route['wbs/consultarpromotorescompartilhados'] = 'seguranca/WbsIcatu/consultarPromotoresCompartilhados';
$route['wbs/consultarinformes'] = 'seguranca/WbsIcatu/consultarInformes';
$route['wbs/consultarfotos'] = 'seguranca/WbsIcatu/consultarFotos';
$route['wbs/consultarestado'] = 'seguranca/WbsIcatu/consultarEstado';
$route['wbs/consultarestadofiltrado'] = 'seguranca/WbsIcatu/consultarEstadoFiltrado';
$route['wbs/consultarregiao'] = 'seguranca/WbsIcatu/consultarRegiao';
$route['wbs/consultarregiaofiltrado'] = 'seguranca/WbsIcatu/consultarRegiaoFiltrado';
$route['wbs/consultarareanielsen'] = 'seguranca/WbsIcatu/consultarAreaNielsen';
$route['wbs/consultarrede'] = 'seguranca/WbsIcatu/consultarRede';
$route['wbs/consultarredefiltrado'] = 'seguranca/WbsIcatu/consultarRedeFiltrado';
$route['wbs/consultaroportunidades'] = 'seguranca/WbsIcatu/consultarOportunidades';
$route['wbs/consultaragenda'] = 'seguranca/WbsIcatu/consultarAgenda';
$route['wbs/consultarareaatuacao'] = 'seguranca/WbsIcatu/consultarareaatuacao';
$route['wbs/consultartipoinforme'] = 'seguranca/WbsIcatu/consultarTipoInforme';
$route['wbs/filtraregiao'] = 'seguranca/WbsIcatu/filtrarRegiao';
$route['wbs/filtrarede'] = 'seguranca/WbsIcatu/filtrarRede';
$route['wbs/filtrarloja'] = 'seguranca/WbsIcatu/filtrarLoja';
$route['wbs/solicitaratendimentocomercial'] = 'seguranca/WbsIcatu/solicitarAtendimentoComercial';
$route['wbs/exportarbookpowerpoint'] = 'seguranca/WbsIcatu/exportarBookPowerPoint';
$route['faturamento/faturalojaaprovacao/consultar/null/json/0'] = 'faturamento/faturaLojaAprovacao/consultar/null/json/0';
$route['wbs/newdashboardwpc'] = 'seguranca/WbsIcatu/NewDashboardWPC';
$route['wbs/dashboardoportunidades'] = 'seguranca/WbsIcatu/dashboardOportunidades';
$route['wbs/newconsultarinformes'] = 'seguranca/WbsIcatu/newConsultarInformes';
$route['wbs/newconsultarfotos'] = 'seguranca/WbsIcatu/newConsultarFotos';
$route['wbs/consultarlocais'] = 'seguranca/Wbs2018/consultarLocais';
$route['wbs/consultarmixpdv'] = 'seguranca/Wbs2018/consultarMixPDV';
$route['wbs/consultaritemmixpdv'] = 'seguranca/Wbs2018/consultarItemMixPDV';
$route['wbs/consultaritem'] = 'seguranca/Wbs2018/consultarItem';
$route['wbs/consultarCategoria'] = 'seguranca/Wbs2018/consultarCategoria';
$route['wbs/consultarFuncaoColaborador'] = 'seguranca/Wbs2018/consultarFuncaoColaborador';
$route['wbs/consultarEmpresas'] = 'seguranca/Wbs2018/consultarEmpresas';
$route['wbs/consultarAreaNielsen'] = 'seguranca/Wbs2018/consultarAreaNielsen';
$route['wbs/consultarClassificacaoLocal'] = 'seguranca/Wbs2018/consultarClassificacaoLocal';
$route['wbs/consultarAreaAbastecimento'] = 'seguranca/Wbs2018/consultarAreaAbastecimento';
$route['wbs/consultarSupervisor'] = 'seguranca/Wbs2018/consultarSupervisor';
$route['wbs/consultarCoordenador'] = 'seguranca/Wbs2018/consultarCoordenador';
$route['wbs/consultarRegiao'] = 'seguranca/Wbs2018/consultarRegiao';
$route['wbs/consultarMarca'] = 'seguranca/Wbs2018/consultarMarca';
$route['wbs/consultarTop'] = 'seguranca/Wbs2018/consultarTop';