<?php

namespace App\Controllers;

use App\Lib\DB;
use App\Models\Produto;



class ProdutoController extends Controller
{
    private $app;
    public $isAuth;

    public function __construct($app)
    {
        $this->app = $app;

        self::setViewParam('nameController',$this->app->getNameController());

    }

    public function index()
    {

        $oListaProduto = Produto::listar();

        self::setViewParam('aListaProduto',$oListaProduto);

        $this->render('produto/index');

    }

    public function cadastrar()
    {

        self::setViewJs('/public/js/jquery.maskMoney.min.js');
        self::setViewJs('/public/js/jquery-ui.js');
        self::setViewJs('/public/js/main.datepicker.js');
        self::setViewJs('/public/js/main.mask.money.js');
        self::setViewCss('/public/css/jquery-ui.min.css');

        $this->render('produto/cadastrar');

    }

    public function salvar()
    {

        Produto::salvar($_POST);

        $this->redirect('produto/index');

    }

    public function atualizar()
    {

        Produto::atualizar($_POST);

        $this->redirect('produto/index');

    }

    public function editar()
    {

        self::setViewJs('/public/js/jquery.maskMoney.min.js');
        self::setViewJs('/public/js/jquery-ui.js');
        self::setViewJs('/public/js/main.datepicker.js');
        self::setViewJs('/public/js/main.mask.money.js');
        self::setViewCss('/public/css/jquery-ui.min.css');

        self::setViewParam('aProduto',Produto::listar($this->app->getParams()[0]));

        $this->render('produto/editar');

    }

    public function excluir($param)
    {
        $id = $param[0];

        Produto::excluir($id);

        $this->redirect('produto/index');

    }

}